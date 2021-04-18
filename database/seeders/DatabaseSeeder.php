<?php

namespace Database\Seeders;

use App\Models\Admin;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            LocationSeeder::class,
        ]);

        Admin::create([
            'name' => 'Shiva',
            'email' => 'adminshiva@gmail.com',
            'mobile' => 8676901392,
            'role' => 'ADMIN',
            'password' => Hash::make('password'),
        ]);

    }
}
