<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bid;
use App\User;
use App\Event\ProductSelected;


class AdministrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
	
	
	public function products_index(){
		
    $products = Product::all();
    return view('products',['products'=>$products]);
		
	}
	
	public function products_view($product_id){
	
	$product = Product::where("id","=",$product_id)->first();
	$bids = Product::find($product_id)->bids;
	$max_bid = Bid::where("product_id","=",$product_id)->max("ammount");
	
    return view('products_view',['product'=>$product,"bids"=>$bids,"max_bid"=>(float)$max_bid]);
	}
	
	public function products_edit(Request $request){
	session(["success"=>""]);
	
	$validatedData  = $request->validate([
	"sku" => "required",
	"description" => "required",
	"name" => "required",
	"price" => "numeric",
	]);	
	
	$name = $request->input("name");
	$product_id = $request->input("product_id");
	$price = $request->input("price");
	$sku = $request->input("sku");

	
    if($product_id == 0){
		
	  $product = new Product();
	  $product->name = $name;
	  $product->product_id = $product_id;
	  $product->price = $ammount;
	  $product->sku = $sku;
	  $product->created_at = \Carbon\Carbon::now();
	  $product->save();
	  	

    }else{
	  
	 Product::find($product_id)->update([	 
	  "name" => $name,
	  "product_id" => $product_id,
	  "price" => $price,
	  "sku" => $sku,
	  "updated_at" => \Carbon\Carbon::now()
	  
	]);
	}	
	session(["success"=>"Product Saved"]);
	return redirect()->action('AdministrationController@products_index');
	
	}
	
	public function products_delete($product_id){
		$product = Product::where($product_id);
		$product->delete();
		session(["success"=>"Product Deleted"]);
		 return redirect()->action('AdministrationController@products_index');
		
	}
}
