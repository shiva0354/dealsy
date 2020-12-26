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
            ['Autos(Cars & Suvs)','autos'],
            ['Properties', 'properties'],
            ['Mobiles', 'mobiles'],
            ['Jobs', 'jobs'],
            ['Bikes', 'bikes'],
            ['Electronics & Appliances', 'electronics-appliances'],
            ['Commercial Vehicle', 'commercial-vehicles'],
            ['Furnitures', 'furnitures'],
            ['Fashion', 'fashions'],
            ['Books', 'books'],
            ['Sports & hobbies', 'sports-hobbies'],
            ['Pets', 'pets'],
            ['Services', 'services'],
            ['Matrimony', 'matrimonies'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'category' => $category[0],
                'slug' => $category[1],
            ]);
        }
    }
}
