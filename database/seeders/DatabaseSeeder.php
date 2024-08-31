<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'user1@user.com',
            'password' => bcrypt('password'),
        ]);

        Feature::factory()->create([
            'id' => (string) Str::uuid(),
            'image' => 'https://i.pinimg.com/564x/47/26/13/472613fcb8d829260838a2632dcdb17e.jpg',
            'route_name' => 'feature1.index',
            'name' => 'Sum it uppp!',
            'description' => 'Sum feature',
            'required_credits' => 3,
            'active' => true,
        ]);

        Feature::factory()->create([
            'id' => (string) Str::uuid(),
            'image' => 'https://i.pinimg.com/736x/1c/27/1b/1c271b8a08ac05ff3c8579019b77f560.jpg',
            'route_name' => 'feature2.index',
            'name' => 'Ask anything to qwen2 ᕙ( •̀ ᗜ •́ )ᕗ',
            'description' => 'LLM feature',
            'required_credits' => 8,
            'active' => true,
        ]);

        Package::create([
            'name' => 'Basic',
            'price' => 10.99,
            'credits' => 50,
            'description' => 'You just want to try some more ( ╹ -╹)?'
        ]);

        Package::create([
            'name' => 'Golden',
            'price' => 30.99,
            'credits' => 100,
            'description' => 'Already a loyal customer ⋆✴︎˚｡⋆'
        ]);

        Package::create([
            'name' => 'Ultimate',
            'price' => 55.99,
            'credits' => 500,
            'description' => 'SUPEERヾ(｡✪ω✪｡)ｼ'
        ]);
    }
}
