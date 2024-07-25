<?php

namespace Database\Seeders;
use App\Models\Website;
use App\Models\Category;
use App\Models\User;
use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = Category::all();
        $User = User::first();

        for ($i = 0; $i < 10; $i++) {
            $website = Website::create([
                'url' => $faker->url,
                'description' => $faker->paragraph(),
                'submitted_by' => $User->getKey(), // Replace with an actual user ID
            ]);

            $website->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
