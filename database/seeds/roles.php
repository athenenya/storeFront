<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table("roles")
		->insert([["name"=>"guest","description"=>"Default account",
		"created_at" => \Carbon\Carbon::now() ],
		["name"=>"user","description"=>"Registered user",
		"created_at" => \Carbon\Carbon::now() ],
		["name"=>"administrator","description"=>"Administration team",
		"created_at" => \Carbon\Carbon::now() ]
		]
		);
    }
}
