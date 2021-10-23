<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Shiva',
            'email' => 'adminshiva@gmail.com',
            'role' => 'SUPER ADMIN',
            'password' => Hash::make('password'),
            'mobile' => '8676901392',
        ]);
    }
}
