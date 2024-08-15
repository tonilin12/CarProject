<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'AdminUser', // Example name
            'email' => 'admin@example.com', // Example email
            'admin' => true, // Set admin to true
            'email_verified_at' => now(), // Set to current time or null
            'password' => Hash::make('adminpassword'), // Example hashed password
            'phone_number' => '123-456-7890', // Example phone number
            'address' => '123 Admin St, Admin City, AC 12345', // Example address
            'remember_token' => Str::random(10), // Random token
        ]);
        // Create 50 users with random data
        $rand = rand(1, 20);
        User::factory($rand)->create();
    }
}
