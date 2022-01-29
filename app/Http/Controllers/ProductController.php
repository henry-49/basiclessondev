<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Product;
use Session;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $products = Product::orderBy('product_name', 'desc')->paginate(3);

            return view('products.services')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //validate input
       $validateData = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_image' => 'image|nullable|mimes:jpg,jpeg,png|max:1999',

        ]);

    //    print('This image is '.$request->file('product_image'));

    // store uploaded image in $brand_image
    $productImage = $request->file('product_image');
    //create unique name and get the file extension
    $filename = $productImage->getClientOriginalName();
    $fileNamePath = pathinfo($filename, PATHINFO_FILENAME).'_'.date('YmdHi');
     // get image extension jpg, jpeg, png 
    $img_ext = strtolower($productImage->getClientOriginalExtension());
    $fileNameToStore = $fileNamePath.'.'.$img_ext;

    print($fileNameToStore);

        // using eloquent ORM
        // $product = new Product();
        // $product->product_name = $request->product_name;
        // $product->product_price = $request->product_price;
        // $product->product_description = $request->product_description;
        // $product->save(); 

        // using query builder
       /* $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;

        DB::table('products')
            ->insert($data); */
       
        // Session::put('success', 'Product Added Successfuly!');

        // return redirect('/products');
        // print('Create Product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        /* $product = DB::table('products')
                       ->where('id', $id)
                       ->first(); */

        $product = Product::find($id);

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);

        return view('products.editproduct')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $product = Product::find($id);

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

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $product = Product::find($id);
        $product->delete();

        /* $product = DB::table('products')->where('id', $id)->first(); */
        /* DB::table('products')->where('id', $id)->delete(); */

        Session::put('success', 'The '.$product->product_name.' has been deleted Successfuly!');

        return redirect('/products');
    }
}
