<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::query(
            "INSERT INTO `nominal`.`categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES (1, 'Vehicles', 'vehicles', NULL, NULL),
            (2, 'properties', 'properties', NULL, NULL),
            (3, 'Mobiles', 'mobiles', NULL, NULL),
            (4, 'Jobs', 'jobs', NULL, NULL),
            (5, 'Bikes', 'bikes', NULL, NULL),
            (6, 'Electronics & Appliances', 'electronics-appliances', NULL, NULL),
            (7, 'Commercial Vehicles', 'commercial-vehicles', NULL, NULL),
            (8, 'Furnitures', 'furnitures', NULL, NULL),
            (9, 'Fashion', 'fashion', NULL, NULL),
            (10, 'Books', 'books', NULL, NULL),
            (11, 'Sports & Hobbies', 'sports-hobbies', NULL, NULL),
            (12, 'Pets', 'pets', NULL, NULL),
            (13, 'Services', 'services', NULL, NULL),
            (14, 'Matrimony', 'matrimony', NULL, NULL);"
        );
    }
}
