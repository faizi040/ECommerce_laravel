<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\order;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use PDF;
use Notification;
// use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    function view_category(){
        $categories = category::all();
        return view('admin.category',compact('categories'));
    }
    function add_category(Request $request){
        $request->validate([
           'name'=>'required'
        ]);
        $add = category::create($request->all());

        if ($add) {

            return redirect()->back()->with('success', 'New Category added Sucessfully');
        } else {
            return redirect()->back()->with('Fail', 'An error occured');
        }
    }

    function delete_category(category $category){
        $delete = $category->delete();
        if ($delete) {

            return redirect()->back()->with('success', 'Category deleted Sucessfully');
        } else {
            return redirect()->back()->with('Fail', 'An error occured');
        }

    }

    function order(){
        $orders = order::all();
        return view('admin.order',compact('orders'));
    }

    function devilered(order $order){
        $order->delivery_status="delivered";
        if($order->payment_status =="Cash On Delivery"){

            $order->payment_status="Paid on delivery";
        }
        $order->update();
        return redirect()->back();
    }

    //pdf download ----this is not an error
    function download_pdf(order $order){


      
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        // upper red line is not an error
        return $pdf->download('order_details.pdf');
    }

    function send_email(order $order){
        return view('admin.email',compact('order'));
    }
    function send_user_email(Request $request,order $order){

        $request->validate([
           'greeting'=>'required',
           'firstline'=>'required',
           'body'=>'required',
           'button'=>'required',
           'url'=>'required',
           'lastline'=>'required',
        ]);
       $details = [

        // this part is also done customly without form data if you want to send all users same email data  e.g.   'greeting' => 'Assalam-o-alaikum'
             'greeting'=>$request->greeting,
             'firstline'=>$request->firstline,
             'body'=>$request->body,
             'button'=>$request->button,
             'url'=>$request->url,
             'lastline'=>$request->lastline,
       ];
       Notification::send($order,new SendEmailNotification($details));
       return redirect()->back()->with('success', 'E-mail Notification send Successfully');
    }

    function searchData(Request $request){

        $searchText = $request->search;
        // Serach by name,phone or product title
        $orders = order::where('name','LIKE',"%$searchText%")->orwhere('phone','LIKE',"%$searchText%")->orwhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.order',compact('orders'));

    }
}
