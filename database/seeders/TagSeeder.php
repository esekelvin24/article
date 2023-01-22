<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tag')->insert(
            ['name' => 'Sports'],

        );

        DB::table('tag')->insert(

            ['name' => 'News'],

        );
        DB::table('tag')->insert(

            ['name' => 'Entertainments'],

        );
    }
}
