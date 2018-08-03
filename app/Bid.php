<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
	protected $table = "bids";
	protected $fillable = ["user_id","product_id","ammount"];
	
	public function users(){
		return $this->belongsTo("App\User");
	}
	
	public function products(){
		return $this->belongsTo("App\Products");
	}
}
