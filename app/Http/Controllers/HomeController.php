<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\comment;
use App\Models\order;
use App\Models\product;
use App\Models\reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Stripe;


class HomeController extends Controller
{
    function redirect()
    {
        $userRole = Auth::user()->user_role;
        if ($userRole == '1') {
            $productCount = product::all()->count();
            $userCount = User::where('user_role', '=', 0)->count();
            $orderCount = order::all()->count();
            $orders = order::all();
            $totalRevenue = 0;
            foreach ($orders as $order) {
                $totalRevenue = $totalRevenue + $order->price;
            }
            $orderDelivered = order::where('delivery_status', '=', 'delivered')->count();
            $orderprocessing = order::where('delivery_status', '=', 'processing')->count();
            return view('admin.home', compact('productCount', 'userCount', 'orderCount', 'totalRevenue', 'orderprocessing', 'orderDelivered'));
        } else {
            $products = product::paginate(6);
            $comments = comment::orderby('id', 'desc')->get();
            //getting comment in descending order
            $replies = reply::all();
            return view('user.index', compact('products', 'comments', 'replies'));
        }
    }
    function index()
    {
        $products = product::paginate(6);
        $comments = comment::orderby('id', 'desc')->get();
        //getting comment in descending order
        $replies = reply::all();
        return view('user.index', compact('products', 'comments', 'replies'));
    }
    function product_details(product $product)
    {
        return view('user.productDetails', compact('product'));
    }
    function add_cart(Request $request, product $product)
    {
        // print_r($request->quantity);
        // die;

        // $request->validate([

        // ]);
        $user = Auth::user();
        $cart = new cart();
        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->address = $user->address;
        $cart->phone = $user->phone;
        $cart->quantity = $request->quantity;
        $cart->product_title = $product->title;

        //    Saving discount if product has otherwise save actual price
        if ($product->discount_price != null) {
            $cart->price = $product->discount_price * $request->quantity;
        } else {
            $cart->price = $product->price * $request->quantity;
        }
        $cart->image = $product->image;
        $cart->product_id = $product->id;
        $cart->user_id = $user->id;
        $cart->save();
        return redirect()->back();
    }
    function show_cart()
    {
        $id = Auth::user()->id;
        // fetching data frm cart table on id based specific condition
        // getch all records where user_id column of cart table is equal to $id variable of logged in user
        $carts = cart::where('user_id', '=', $id)->get();
        return view('user.showCart', compact('carts'));
    }
    function remove_cart(cart $cart)
    {
        $delete = $cart->delete();
        if ($delete) {

            return redirect('/show_cart')->with('success', 'Product removed Sucessfully');
        } else {
            return redirect('/show_cart')->with('Fail', 'An error occured');
        }
    }

    function cash_order()
    {
        $user = Auth::user();
        $id = $user->id;
        $datas = cart::where('user_id', '=', $id)->get();
        foreach ($datas as $data) {
            //saving cart data into order table
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->delivery_status = 'Processing';
            $order->payment_status = 'Cash On Delivery';

            $order->save();

            //deleting cart table data after the order has been made by user

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        return redirect('/show_cart')->with('success', 'Order Placed Sucessfully.Our team will connect with you soon..');
    }


    function stripe($totalPrice)
    {
        return view('user.stripe', compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for Payment"
        ]);

        // Session::flash('success', 'Payment successful!');

        // return back()->with('success', 'Payment Successful');
        $user = Auth::user();
        $id = $user->id;
        $datas = cart::where('user_id', '=', $id)->get();
        foreach ($datas as $data) {
            //saving cart data into order table
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->delivery_status = 'Processing';
            $order->payment_status = 'Paid using card';

            $order->save();

            //deleting cart table data after the order has been made by user

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        return redirect('/show_cart')->with('success', 'Order placed and Payment is Successful using card');
    }

    function show_order()
    {
        $orders = order::where('user_id', '=', Auth::user()->id)->get();
        return view('user.order', compact('orders'));
    }
    function cancel_order(order $order)
    {
        if ($order->delivery_status == "Processing") {

            $order->delivery_status = "Canceled";
            $order->update();
            return redirect('/show_order')->with('success', 'Orderd Canceled Successfully');
        } else {
            return redirect('/show_order')->with('Fail', 'You cannot cancel the order Now');
        }
    }

    function add_comment(Request $request)
    {
        $comment = new comment();
        $comment['name'] = Auth::user()->name;
        $comment['user_id'] = Auth::user()->id;
        $comment['comment'] = $request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'Comment added Successfully');
    }
    function add_reply(Request $request)
    {
        $comment = new reply();
        $comment['name'] = Auth::user()->name;
        $comment['user_id'] = Auth::user()->id;
        $comment['comment_id'] = $request->commentId;
        $comment['reply'] = $request->reply;
        $comment->save();
        return redirect()->back()->with('success', 'Reply added Successfully');
    }
}
