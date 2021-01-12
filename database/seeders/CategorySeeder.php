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
            ['Autos(Cars & Suvs)', null, 'autos', 'fas fa-car'],
            ['Properties', null, 'properties', 'fas fa-home'],
            ['Mobiles', null, 'mobiles', 'fas fa-mobile-alt'],
            ['Jobs', null, 'jobs', 'fab fa-black-tie'],
            ['Bikes', null, 'bikes', 'fas fa-motorcycle'],
            ['Electronics & Appliances', null, 'electronics-appliances', 'fas fa-laptop'],
            ['Commercial Vehicle', null, 'commercial-vehicles', 'fas fa-truck-pickup'],
            ['Furnitures', null, 'furnitures', 'fas fa-couch'],
            ['Fashion', null, 'fashions', 'fas fa-tshirt'],
            ['Books', null, 'books', 'fas fa-book'],
            ['Sports & hobbies', null, 'sports-hobbies', 'fas fa-futbol'],
            ['Pets', null, 'pets', 'fas fa-cat'],
            ['Services', null, 'services', 'fas fa-cogs'],
            ['Matrimony', null, 'matrimonies', 'fas fa-user-friends'],
            ['Cars', 1, 'cars'],
            ['Suvs', 1, 'suvs'],
            ['For Sale: Houses & Apartments', 2, 'for-sale-houses-apartments'],
            ['For Rent: Houses & Apartments', 2, 'for-rent-house-apartments'],
            ['Lands & Plots', 2, 'lands-plots'],
            ['For Rent: Shops & Offices', 2, 'for-rent-shops-offices'],
            ['For Sale: Shops & Offices', 2, 'for-sale-shops-offices'],
            ['PG', 2, 'paying-guest-pg'],
            ['Guest Houses', 2, 'guest-houses'],
            ['Mobile Phones', 3, 'mobile-phones'],
            ['Mobile Accessories', 3, 'mobile-accessories'],
            ['Tablets', 3, 'tablets'],
            ['Iphone', 3, 'iphone'],
            ['Samsung', 3, 'samsung'],
            ['Realme', 3, 'realme'],
            ['Oppo', 3, 'oppo'],
            ['Vivo', 3, 'vivo'],
            ['Xiaomi', 3, 'mi'],
            ['Micromax', 3, 'micromax'],
            ['Htc', 3, 'htc'],
            ['Lenovo', 3, 'lenovo'],
            ['Oneplus', 3, 'oneplus'],
            ['Huawei', 3, 'huawei'],
            ['Infinix', 3, 'infinix'],
            ['Intex', 3, 'intex'],
            ['Karbon', 3, 'karbon'],
            ['Lava', 3, 'lava'],
            ['LG', 3, 'lg'],
            ['Nokia', 3, 'nokia'],
            ['Sony', 3, 'sony'],
            ['Motorola', 3, 'motorola'],
            ['Data Entry & Back Office', 4, 'data-entry-back-office'],
            ['Sales & Marketing', 4, 'sales-marketing'],
            ['BPO & Telecaller', 4, 'bpo-telecaller'],
            ['Driver', 4, 'driver'],
            ['Office Assistant', 4, 'office-assistant'],
            ['Delivery & Collection', 4, 'delivery-collection'],
            ['Teacher', 4, 'teacher'],
            ['Cook', 4, 'cook'],
            ['Receptionist & Front Office', 4, 'receptionists-front-office'],
            ['Operator & Technician', 4, 'operator-technicians'],
            ['IT Engineer & Developer', 4, 'it-engineers-developer'],
            ['Hotel & Travel Executive', 4, 'hotels-travel-executives'],
            ['Accountant', 4, 'accountant'],
            ['Designer', 4, 'designers'],
            ['Other Jobs', 4, 'other-jobs'],
            ['Motorcyles', 5, 'motorcyles'],
            ['Scooters', 5, 'scooters'],
            ['Sports Bike', 5, 'sports-bikes'],
            ['Spare Parts', 5, 'spare-parts'],
            ['Bicycle', 5, 'bicycle'],
            ['Electronics & Computers', 6, 'electronics-computers'],
            ['TVs', 6, 'tvs'],
            ['Kitchen & Other Appliances', 6, 'kitchens-other-appliances'],
            ['Computers & Laptops', 6, 'computers-laptops'],
            ['Cameras & Lenses', 6, 'cameras-lenses'],
            ['Games & Entertainment', 6, 'games-entertainment'],
            ['Fridges', 6, 'fridges'],
            ['Computers Accessories', 6, 'computers-accessories'],
            ['Hard Disks', 6, 'hard-disks'],
            ['Printers', 6, 'printers'],
            ['Monitors', 6, 'monitors'],
            ['Acs', 6, 'acs'],
            ['Washing Machines', 6, 'washing-machines'],
            // ['Commercial Vehicles', 7, 'commercial-vehicles'],
            ['Vehicle Spare Parts', 7, 'vehicles-parts'],
            ['Sofa & Dining', 8, 'sofa-dining'],
            ['Beds & Wardrobes', 8, 'beds-wardrobes'],
            ['Home Decor & Garden', 8, 'home-decors-garden'],
            ['Kids Furniture', 8, 'kids-furniture'],
            ['Other Households Items', 8, 'other-household-items'],
            ['Men Fashions', 9, 'men-fashions'],
            ['Women Fashions', 9, 'women-fashions'],
            ['Kids Fashions', 9, 'kids-fashions'],
            ['Action & Adventure Books', 10, 'actions-adventure-books'],
            ['Comic Books', 10, 'comic-books'],
            ['Horror Books', 10, 'horror-books'],
            ['Science Fiction', 10, 'science-fictions'],
            ['Fantasy Books', 10, 'fantasy-books'],
            ['Historical Fiction', 10, 'historical-fiction'],
            ['Short Stories', 10, 'short-stories'],
            ['Suspense & Thrillers', 10, 'suspense-thrillers'],
            ['Biographies & Autobiographies', 10, 'biographies-autobiographies'],
            ['Cookbooks', 10, 'cookbooks'],
            ['Gym & Fitness', 11, 'gym-fitness'],
            ['Musical Instruments', 11, 'musical-instruments'],
            ['Sports Equipments', 11, 'sports-equipments'],
            ['Other Hobbies', 11, 'other-hobbies'],
            ['Fishes & Aquarium', 12, 'fishes-aquarium'],
            ['Pet Food & Accessories', 12, 'pet-foods-accessories'],
            ['Dogs', 12, 'dogs'],
            ['Cats', 12, 'cats'],
            ['Other Pets', 12, 'other-pets'],
            ['Education & Classes', 13, 'education-classes'],
            ['Drivers & Taxi', 13, 'drivers-taxi'],
            ['Health & Beauty', 13, 'health-beauty'],
            ['Other Services', 13, 'other-services'],
            ['Brides', 14, 'brides'],
            ['Grooms', 14, 'grooms'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category[0],
                'parent_id' => $category[1],
                'slug' => $category[2],
                'icon' => $category[3] ?? '',
            ]);
        }

        // foreach ($categories as $category) {
        //     $cat = Category::where('slug', $category[2]);
        //     $cat->update([
        //         'name' => $category[0],
        //         'parent_id' => $category[1],
        //         'slug' => $category[2],
        //         // 'icon' => $category[3],
        //     ]);
        // }
    }
}
