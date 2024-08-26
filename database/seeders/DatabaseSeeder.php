<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Package;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'lol@lol.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('yuta'),
        ]);

        Feature::factory()->create([
            'image' => 'https://i.pinimg.com/564x/47/26/13/472613fcb8d829260838a2632dcdb17e.jpg',
            'route_name' => 'feature1.index',
            'name' => 'whatever',
            'description' => 'LOL',
            'required_credits' => 4,
            'active' => true,
        ]);

        Feature::factory()->create([
            'image' => 'https://i.pinimg.com/736x/1c/27/1b/1c271b8a08ac05ff3c8579019b77f560.jpg',
            'route_name' => 'feature2.index',
            'name' => 'check the cats go',
            'description' => 'LOL',
            'required_credits' => 3,
            'active' => true,
        ]);

        Package::create([
            'name' => 'Basic',
            'price' => 10.99,
            'credits' => 50
        ]);

        Package::create([
            'name' => 'Golden',
            'price' => 30.99,
            'credits' => 100
        ]);

        Package::create([
            'name' => 'Goffy',
            'price' => 55.99,
            'credits' => 500
        ]);
    }
}
