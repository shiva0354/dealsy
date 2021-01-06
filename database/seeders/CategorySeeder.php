<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Category::reguard();
        $categories = [
            ['Autos(Cars & Suvs)', 'autos', 'fas fa-car'],
            ['Properties', 'properties','fas fa-home'],
            ['Mobiles', 'mobiles', 'fas fa-mobile-alt'],
            ['Jobs', 'jobs','fab fa-black-tie'],
            ['Bikes', 'bikes','fas fa-motorcycle'],
            ['Electronics & Appliances', 'electronics-appliances','fas fa-laptop'],
            ['Commercial Vehicle', 'commercial-vehicles', 'fas fa-truck-pickup'],
            ['Furnitures', 'furnitures','fas fa-couch'],
            ['Fashion', 'fashions','fas fa-tshirt'],
            ['Books', 'books','fas fa-book'],
            ['Sports & hobbies', 'sports-hobbies','fas fa-futbol'],
            ['Pets', 'pets','fas fa-cat'],
            ['Services', 'services','fas fa-cogs'],
            ['Matrimony', 'matrimonies','fas fa-user-friends'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category[0],
                'slug' => $category[1],
                'icon' => $category[2],
            ]);
        }
    }
}
