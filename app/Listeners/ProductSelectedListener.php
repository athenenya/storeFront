<?php

namespace App\Listeners;

use App\Event\ProductSelected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Product;

class ProductSelectedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductSelected  $event
     * @return void
     */
    public function handle(ProductSelected $event)
    { 
	
	
        //save product views
		DB::table("product_views")->insert(["product_id"=>$event->product->id,
		"session_id"=> 0,
		"created_at"=>\Carbon\Carbon::now(),
		]);
		
    }
}
