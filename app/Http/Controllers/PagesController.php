<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Product;
use Session;

use Illuminate\Http\Request;

class PagesController extends Controller
{
      //
      public function home(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        // get data from table
        // $products = DB::table('products')->get();

        // $products = Product::orderBy('product_name', 'desc')->get();

        // $products = Product::InRandomOrder()->paginate(1);

        
        $products = Product::orderBy('product_name', 'desc')->paginate(3);

            return view('pages.services')->with('products', $products);
            // return '<h2>My name is '. $name .'and i have id  '.$id .'</h2>';
            // return view('pages.service');
      
            
    }

    public function show($id) {
       /* $product = DB::table('products')
                       ->where('id', $id)
                       ->first(); */

        $product = Product::find($id);

        return view('pages.show')->with('product', $product);
    }

    public function create(){
        return view('pages.create');
    }

    public function saveproduct(Request $request){

        //validate input
       $validate_data = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
        ]);

        // using eloquent ORM
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        $product->save(); 

        // using query builder
       /* $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;

        DB::table('products')
            ->insert($data); */
       
        Session::put('success', 'Product Added Successfuly!');

        return redirect('/create');
        // print('Create Product');
    }


    public function editproduct($id){

        $product = Product::find($id);

        return view('pages.editproduct')->with('product', $product);
    }

        public function updateproduct(Request $request){

        $product = Product::find($request->input('id'));

        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');
        
        $product->update();

        // update data using query builder
       /* $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;

        DB::table('products')
            ->where('id', $request->input('id'))
            ->update($data); */

        Session::put('success', 'The '.$request->input('product_name').' has been updated Successfuly!');

        return redirect('/services');
    }

    public function deleteproduct($id){

        $product = Product::find($id);
        $product->delete();

        /* $product = DB::table('products')->where('id', $id)->first(); */
        /* DB::table('products')->where('id', $id)->delete(); */

        Session::put('success', 'The '.$product->product_name.' has been deleted Successfuly!');

        return redirect('/services');
    }
}
