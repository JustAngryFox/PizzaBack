<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\orders;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\OrderRequest;

class ProductController extends Controller
{
    public function upload_product(ProductsRequest $request){
    $products=new products;
	$products->name=$request->input('name');
	$products->image=$request->input('image');
	$products->price=$request->input('price');
	$products->description=$request->input('description');
	$products->save();
 
	
	}
	
	public function upload_order(OrderRequest $request){
    $orders=new orders;
	$orders->name=$request->input('name');
	$orders->image=$tel->input('tel');
	$orders->email=$request->input('email');
	$orders->save();		
	}
	
}
