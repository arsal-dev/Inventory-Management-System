<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.all', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all('id','name');
        return view('products.add', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'image' => $this->storeImage($request),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category
        ]);

        return redirect('/products')->with('message', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        $allData = [
            'product' => $product,
            'categories' => $categories
        ];

        return view('products.edit', ['product' => $allData]);
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
        if($request->image){
            $product = Product::find($id);
            File::delete(public_path().'/images/product-images/'.$product->image);
            
            Product::where('id',$id)->update([
                'name' => $request->name,
                'image' => $this->storeImage($request),
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category' => $request->category
            ]);
        }
        else {
            Product::where('id',$id)->update($request->except('_token', '_method'));
        }

        return redirect('/products')->with('message', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $product = Product::find($id);
        File::delete(public_path().'/images/product-images/'.$product->image);
        Product::destroy($id);
        return redirect('products')->with('error', 'Product Deleted Successfully');
    }

    // Add image to public folder
    private function storeImage($request){
        $imgNewName = uniqid() . '-' . $request->name . '.' . $request->image->extension();
        $path = public_path() . '/images/product-images';
        $request->image->move($path, $imgNewName);
        return $imgNewName;
    }
}
