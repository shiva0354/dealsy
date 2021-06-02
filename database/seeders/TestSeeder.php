<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Hash;
use Str;

class TestSeeder extends Seeder
{

    private $faker;


    public function __construct()
    {
        $this->faker = Factory::create('en_IN');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     CategorySeeder::class,
        //     LocationSeeder::class,
        //     AdminSeeder::class,
        // ]);
        // $this->createUsers(500);
        // $this->createCity(500);
        $this->createposts(60000);
    }

    private function createUsers(int $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $mobile = 9865986589 + $i;
            $name = $this->faker->firstNameMale . " " . $this->faker->lastName;
            $user = User::create([
                'name' => $name,
                'mobile' => $mobile,
                'email' => $this->faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
        echo "Created $i Users" . PHP_EOL;
    }

    private function createCity($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $state = Location::whereNull('parent_id')->inRandomOrder()->first();
            $name = $this->faker->city;
            $city = Location::create([
                'name' => $name,
                'slug' => strtolower(str_replace(" ", "_", $name)),
                'parent_id' => $state->id,
            ]);
        }
        echo "Created $i Cities" . PHP_EOL;
    }

    private function createposts($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $user = User::inRandomOrder()->first();
            $category = Category::inRandomOrder()->first();
            $city = Location::whereNotNull('parent_id')->inRandomOrder()->first();
            $state = $city->state;

            $post = Post::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => $this->faker->jobTitle,
                'detail' => $this->faker->paragraph(),
                'status' => $this->faker->randomElement(['PENDING', 'ACTIVE', 'REJECTED']),
                'price' => mt_rand(00, 999999),
                'last_renewed_on' => null,
                'locality' => $this->faker->streetName,
                'city_id' => $city->id,
                'state_id' => $state->id,
            ]);

            $post->saveImage($this->faker->regexify('[A-Za-z0-9]{20}'));
            if ($i % 100 == 0) echo "Created $i posts" . PHP_EOL;
        }
        echo "Created $i posts" . PHP_EOL;
    }
}
