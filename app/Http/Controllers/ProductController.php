<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function view_product()
    {
        $categories = category::all();
        return view('admin.addProduct',compact('categories'));
    }
    function add_product(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'quantity' => 'required | min:0',
            'description' => 'required',
            'category' => 'required',

        ]);
        $input = $request->all();
        //storing image into laravel folder
        $fileNameWithExtention = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExtention, PATHINFO_FILENAME);
        $fileExtention = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtention;
        $request->image->move(public_path('Product-images/'), $fileNameToStore);
        // $gallery = new image;
        $input['image'] = $fileNameToStore;
        $add = product::create($input);

        if ($add) {

            return redirect()->back()->with('success', 'New Product added Sucessfully');
        } else {
            return redirect()->back()->with('Fail', 'An error occured');
        }
    }

    function show_product(){
        $products = product::all();
        return view('admin.showProduct',compact('products'));
    }
    function delete_product(product $product){
        $delete = $product->delete();
        if ($delete) {

            return redirect('/show_product')->with('success', 'Product deleted Sucessfully');
        } else {
            return redirect('/show_product')->with('Fail', 'An error occured');
        }
    }
    function edit_product(product $product){
       return view('admin.updateProduct',compact('product'));
    }
    function update_product(Request $request,product $product){
        $request->validate([

            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required | min:0',
            'description' => 'required',
            'category' => 'required',


        ]);
        // $UpdateEvent = event::find($id);
        if (!is_null($product)) {
            $input = $request->all();
            if ($image = $request->file('image')) {
                $fileNameWithExtention = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtention, PATHINFO_FILENAME);
                $fileExtention = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtention;
                $request->image->move(public_path('Product-images/'), $fileNameToStore);
                $input['image'] = $fileNameToStore;
            } else {
                unset($input['image']);
            }
        }

        $update = $product->update($input);
        if ($update) {

            return redirect('/show_product')->with('success', 'Product Updated  Sucessfully');
        } else {
            return redirect('/show_product')->with('Fail', 'An error occured');
        }
    }
}
