<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table("users")
		->insert([["name"=>"Athene","email"=>"mutyambiziathene@gmail.com",
		"password"=>bcrypt("P@ssword2012!@#"),"created_at" => \Carbon\Carbon::now() ]
		]
		);
    }
}
