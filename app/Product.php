<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	protected $table = "products";
	
	protected $fillable = ["name","sku","price","description"];
	
	public function bids(){
		return $this->hasMany("App\Bid");
	}
}
