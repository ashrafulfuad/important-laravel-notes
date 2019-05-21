<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use Carbon\Carbon;

class ProductController extends Controller
{
    function addproduct()
    {
      $deleted_products = Product::orderBy('deleted_at', 'desc')->onlyTrashed()->get();
      $products = Product::orderBy('id', 'desc')->paginate(5);
      $colors = Color::all();
      return view('product/view', compact('products', 'deleted_products', 'colors'));
    }
    function productinsert(Request $request)
    {
      $request->validate([
        'product_name' => 'required',
        'product_price' => 'required|numeric',
        'product_size' => 'required',
      ]);
      $color_collection = collect([]);
      foreach ($request->color_id as $key => $value_of_color) {
        $color_collection->put('color_id'.$key, $value_of_color);
      }
      Product::insert([
        'product_name' =>$request->product_name,
        'product_price' =>$request->product_price,
        'product_color' =>$color_collection,
        'product_size' =>$request->product_size,
        'created_at' =>Carbon::now(),
      ]);
      return back()->with('status', 'Product Successfully Inserted');
    }
    function productdelete($product_id)
    {
      Product::findOrFail($product_id)->delete();
      return back()->with('deleted_status' , 'Product Deleted Successfully!');
    }
    function productrestore($product_id)
    {
      Product::withTrashed()->findOrFail($product_id)->restore();
      return back()->with('restore_status', 'Product Restored Successfully!');
    }
    function productedit($product_id)
    {
      $edit_products = Product::findOrFail($product_id);
      $edit_colors = Color::all();
      return view('product/edit', compact('edit_products', 'edit_colors'));
    }
    function editproductinsert(Request $request)
    {
      $color_collection = collect([]);
      foreach ($request->color_id as $key => $value_of_color) {
        $color_collection->put('color_id'.$key, $value_of_color);
      }
      Product::findOrFail($request->product_id)->update([
        'product_name' =>$request->product_name,
        'product_price' =>$request->product_price,
        'product_color' =>$color_collection,
        'product_size' =>$request->product_size,
      ]);
      return back()->with('edit_status', 'Product Successfully Edited!');
    }
}
