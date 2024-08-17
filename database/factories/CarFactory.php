<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        // Define the directory where the images are stored
        $directory = public_path('kepek');

        // Scan the directory for image files (jpg, jpeg, png) and filter out non-image files
        $images = array_filter(
            scandir($directory),
            function ($file) use ($directory) {
                return is_file($directory . '/' . $file) && in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']);
            }
        );

        // If there are no images, set the image to null
        $randomImage = count($images) > 0 ? $images[array_rand($images)] : null;

        // Generate the full URL for the image or null if no images found
        $imageUrl = $randomImage ?('kepek/' . $randomImage) : null;

        return [

            'reg_num' => strtoupper($this->faker->unique()->bothify('??-###')), // Example: AB-123
            'img' => $imageUrl, // Store the full URL of the image or null
            'daily_price' => $this->faker->numberBetween(5, 15) * 1000,
        ];
    }
}
