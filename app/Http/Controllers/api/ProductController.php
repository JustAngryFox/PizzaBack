<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\orders;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function upload_product(ProductsRequest $request){
		
	$file = $request->file('image');
    $upload_folder = 'images';
	$filename = date('Y-m-d-h-i-s').'-img.jpg'; // image.jpg

    Storage::putFileAs($upload_folder, $file, $filename);	
		
    $products=new products;
	$products->name=$request->input('name');
	$products->image=$filename;
	$products->price=$request->input('price');
	$products->description=$request->input('description');
	$products->save();
 
	return response()->json(['success'=>'ok']);
	}
	
	public function upload_order(OrderRequest $request){
    $orders=new orders;
	$orders->name=$request->input('name');
	$orders->image=$tel->input('tel');
	$orders->email=$request->input('email');
	$orders->save();		
	}
	
	public function get_products(Request $dates){
    $products=new products;
	return response()->json([$products->all()]);	
	}
	
}
