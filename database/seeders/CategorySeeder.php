<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Men',
            'slug' => 'men',
            'created_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Women',
            'slug' => 'women',
            'created_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Child',
            'slug' => 'child',
            'created_at' => Carbon::now()
        ]);
    }
}
