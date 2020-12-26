<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'name'=>'Kumar Shiva',
            'email'=>'shiva@gmail.com',
            'mobile'=>'8676901392',
            'password'=>Hash::make('password')
        ]);
    }
}
