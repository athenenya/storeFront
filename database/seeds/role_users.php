<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table("role_users")
		->insert([["role_id"=>"3","user_id"=>"1","created_at" => \Carbon\Carbon::now() ]
		]
		);
    }
}
