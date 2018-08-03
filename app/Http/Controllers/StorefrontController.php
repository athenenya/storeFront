<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Bid;
use App\User;
use App\Event\ProductSelected;


class StorefrontController extends Controller
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
		$products = Product::all();
    return view('welcome',['products'=>$products]);
    }
	
	public function details($product_id)
    {
	$product = Product::where("id","=",$product_id)->first();
	$bids = Product::find($product_id)->bids;
	$max_bid = Bid::where("product_id","=",$product_id)->max("ammount");
	
	event(new ProductSelected($product));
	
    return view('details',['product'=>$product,"bids"=>$bids,"max_bid"=>(float)$max_bid]);
    }
	
	public function bid($product_id)
    {
	$max_bid = Product::where("product_id","=",$product_id)->select("max(ammount)");
	$bids = Product::where("product_id","=",$product_id)->bids();
	
	
    return view('welcome',['products'=>$products]);
    }
	
	public function save_bid(Request $request){
	session(["success"=>""]);
	
    $validatedData  = $request->validate([
	"email" => "E-Mail",
	"ammount" => "numeric",
	"product_id" => "",
	]);	
	
	$email = $request->input("email");
	$product_id = $request->input("product_id");
	$ammount = $request->input("ammount");
	
	$user_id = $this->checkIfExists($email);
	
	$bids = Bid::where("user_id","=",$user_id)
	         ->where("product_id","=",$product_id)->first();
	
    if(sizeof($bids) == 0){
		
	  $bid = new Bid();
	  $bid->user_id = $user_id;
	  $bid->product_id = $product_id;
	  $bid->ammount = $ammount;
	  $bid->created_at = \Carbon\Carbon::now();
	  $bid->save();
	  	

    }else{
	  
	 Bid::find($bids->id)->update([	 
	  "user_id" => $user_id,
	  "product_id" => $product_id,
	  "ammount" => $ammount,
	  "updated_at" => \Carbon\Carbon::now()
	  
	]);
	}	
	
	$product = Product::where("id","=",$product_id)->first();
	$bids = Product::find($product_id)->bids;
	$max_bid = Bid::where("product_id","=",$product_id)->max("ammount");
	
	
	
	session(["email"=> $request->input("email")]);
	
	session(["success"=>"Bid submitted"]);
    return view('details',['product'=>$product,"bids"=>$bids,"max_bid"=>(float)$max_bid]);	
	
	
	
	
    
	}
	
	public function checkIfExists($email){
	
    $users = User::where("email","=",$email)->first();	
	
	if(sizeof($users) == 0){
	  $user = new User();
	  $user->name = " ";
	  $user->email = $email;
	  $user->password = " ";
	  
	  $user->save();
	  
	  $users = User::where("email","=",$email)->first();	
		
	}
	
	return $users->id;	
	 
	}
	
	
	
	
	
}
