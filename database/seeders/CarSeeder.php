<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get a random 3 users
        $users = User::inRandomOrder()->limit(3)->get();

        foreach ($users as $user) {
            $startDate = $faker->dateTimeBetween('now', '+3 months');
            $endDate = $faker->dateTimeBetween($startDate, (clone $startDate)->modify('+3 months'));

            Car::factory()->create([
                'user_id' => $user->id,
                'booking_startdate' => $startDate,
                'booking_deadline' => $endDate,
            ]);
        }
    }
}
