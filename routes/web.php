<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarBookingController;

use App\Http\Controllers\ReservationController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use App\Models\Car;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route to display all cars


Route::get('/carbooking', function () {
    return view('webpages.carbooking');
})->name('carbooking');
require __DIR__.'/auth.php';

Route::post('/carbooking', [CarBookingController::class, 'store'])->name('carbooking.store');


Route::get('/reservation/{car_id}', [ReservationController::class, 'showReservation'])->name('reservation');

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

Route::get('/', function () {
    return view('welcome'); // Adjust this to the view you want as the homepage
})->name('home');




Route::get('/report/{id}', [BookingController::class, 'show'])
    ->name('report.show');

Route::get('/admin/login', function () {
    return view('webpages.adminfolder.login');
})->name('admin.login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login');



Route::get('/admin-page', function () {
        return view('webpages.adminfolder.page');
})->name('admin.page');

 Route::get('/admin/bookings', function () {
        // Fetch all bookings with related users and cars, sorted by car_id
        $bookings = \App\Models\Booking::with(['user', 'car'])->orderBy('car_id')->get();
    
        // Return the view with the bookings data
        return view('webpages.adminfolder.bookings', compact('bookings'));
})->name('admin.bookings');

Route::get('/edit-cars', function () {
        return view('webpages.adminfolder.editcars');
})->name('edit-cars');


Route::post('/cars/{car}/change-status', function (Car $car, Request $request) {
    // Toggle the is_active status
    $car->is_active = !$car->is_active;
    $car->save();

    // Redirect back to the edit cars page with a success message
    return redirect()->route('edit-cars')->with('status', 'Car status updated successfully!');
})->name('cars.changeStatus');


Route::post('/car/store', function () {
    // Create a new car using a factory
    Car::factory()->create();

    // Redirect back to the previous page
    return redirect()->back();
})->name('car.store');