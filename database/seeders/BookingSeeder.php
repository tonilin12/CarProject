<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use Faker\Factory as Faker;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and cars
        $users = User::all();
        $cars = Car::all();

        // Check if there are any users and cars
        if ($users->isEmpty() || $cars->isEmpty()) {
            $this->command->info('No users or cars found, make sure to seed users and cars first.');
            return;
        }

        // Instantiate Faker
        $faker = Faker::create();

        // Create 20 booking records
        foreach (range(1, 20) as $index) {

            // Randomly select a car
            $car = $cars->random();

            $car = $cars->random();

            // Fetch bookings only for the selected car and sort them by start_date
            $sortedBookings = Booking::where('car_id', $car->id)
                ->orderBy('start_date')
                ->get();            
                
            $startDate = null;
            $deadline = null;
            
            if ($sortedBookings->isEmpty()) {
                // If no existing bookings, generate random start and deadline dates
                $startDate = $faker->dateTimeBetween('now', '+3 months');
                $deadline = $faker->dateTimeBetween($startDate, (clone $startDate)->modify('+3 months'));
            } else {
                $elem1 = $sortedBookings->random();
                $firstElement = $sortedBookings->first();
                $lastElement = $sortedBookings->last();
                
                if ($elem1 === $lastElement) {
                    $date0 = new Carbon($elem1->deadline);
                    $startDate = $faker->dateTimeBetween($date0, (clone $date0)->modify('+3 months'));
                    $deadline = $faker->dateTimeBetween($startDate, (clone $date0)->modify('+3 months'));
                } elseif ($elem1 === $firstElement) {
                    $date0 = new Carbon($elem1->start_date);
                    $date3MonthsBefore = (clone $date0)->modify('-3 months');
                    $startDate = $faker->dateTimeBetween($date3MonthsBefore, $date0);
                    $deadline = $faker->dateTimeBetween($startDate, $date0);
                } else {
                    // Get the element after $elem1
                    $index = $sortedBookings->search($elem1);
                    $elem2 = $sortedBookings->slice($index + 1, 1)->first();

                    if ($elem2) {
                        $date1 = new Carbon($elem1->start_date);
                        $date2 = new Carbon($elem2->start_date);

                        $startDate = $faker->dateTimeBetween($date1, $date2);
                        $deadline = $faker->dateTimeBetween($startDate, $date2);
                    } else {
                        // If there is no next element, fallback to a random date range
                        $startDate = $faker->dateTimeBetween($elem1->start_date, '+3 months');
                        $deadline = $faker->dateTimeBetween($startDate, (clone $startDate)->modify('+3 months'));
                    }
                }
            }
            
            // Create a new booking record
            Booking::create([
                'user_id' => $users->random()->id,
                'car_id' => $car->id,
                'start_date' => $startDate,
                'deadline' => $deadline,
            ]);
        }
    }
}
