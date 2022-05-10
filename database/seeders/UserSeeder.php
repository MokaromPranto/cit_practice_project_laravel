<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('users')->insert([
        'name' => 'Mokarom',
        'email' => 'mokarom@gmail.com',
        'password' => Hash::make('mokarom@gmail.com'),
        'created_at' => Carbon::now()
    ]);

    }
}
