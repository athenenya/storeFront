<?php

namespace App\Http\Controllers;
use App\Product;
use App\Bid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$max_bids = Bid::join('products','products.id','=','bids.product_id')
		->groupBy("bids.product_id")->groupBy("products.name")->select(DB::raw('max(bids.ammount) as maxAmmount,products.name'))->get();
		
        return view('home',['max_bids'=>$max_bids]);
		
    }
	
	public function getData()
    {
		$data_lw = array();
		$dates_lws = array();
		$dates_lw = array();
		
		$days_ago = date("N")+ 6; 
		for($n=0;$n<=6;$n++){
		array_push($dates_lw,  date("Y-m-d",strtotime(($days_ago-$n)." days ago")));
	    }
		
		for($n=0;$n<=6;$n++){
		array_push($dates_lws,  ["d"=>date("j",strtotime($dates_lw[$n])),"m"=>date("m",strtotime($dates_lw[$n])), "y"=>date("Y",strtotime($dates_lw[$n]))]);
	    }
		
	
		foreach($dates_lw as $date_lw){
	
        $end_of_day = $date_lw." 23:59:59";	
		
	    $bids_stats = Bid::join('products','products.id','=','bids.product_id')
		->where("bids.created_at",">=",$date_lw)
		->where("bids.created_at","<=",$end_of_day)
		->groupBy("bids.product_id")->select(DB::raw('count(bids.id) as totalBids'))->get();
			
		if(sizeof($bids_stats)==0)	{	
	    array_push($data_lw, 0);		

		}else{
			
         array_push($data_lw, $bids_stats[0]->totalBids);	
		 
		}		
				
        }
		
		return json_encode(["values"=>$data_lw]);
		
    }
	
}
