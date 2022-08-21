<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\orders;
use App\Models\products_order;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
	$orders->tel=$request->input('tel');
	$orders->email=$request->input('email');
	$orders->save();		
	
	$order_id=$orders->id;
	$products_id=explode('|',$request->products_id);
	
	for ($i=0;$i<count($products_id)-1;$i++){
		$dates[]=[
		'product_id'=>$products_id[$i],
		'order_id'=>$order_id
		];
	}
	$products_order=new products_order;	
	$products_order->insert($dates);
	
	return response()->json(['success'=>'ok']);
	
	}
	
	
	
	
	public function get_products(){
	return response()->json([products::all()]);	
	}
	
	
	public function get_orders(){
	return response()->json([orders::all()]);	
	}
	
	
	public function get_product_orders(Request $request){
	return response()->json([
	DB::table('products_orders')
	->select('products_orders.product_id','products_orders.order_id','products.name','products.price','products.image')
	->join('products','products_orders.product_id','=','products.id')
	->where('products_orders.order_id','=',$request->input('order_id'))
	->get()
]);
	}
	
	
}
