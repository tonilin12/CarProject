<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;


class ReservationController extends Controller
{
    public function showReservation(Request $request, $car_id)
    {
        // Retrieve the start and end dates from the request (query parameters)
        $startDate = $request->query('start_date');
        $deadline = $request->query('end_date');

        // Validate the presence of start_date and end_date
        if (!$startDate || !$deadline) {
            return redirect()->back()->withErrors('Start date or deadline missing');
        }

        // Parse the dates
        $startDate = Carbon::parse($startDate);
        $deadline = Carbon::parse($deadline);

        // Calculate the number of days
        $maxDays = $startDate->diffInDays($deadline) + 1;

        // Retrieve car details
        $car = Car::findOrFail($car_id);

        // Return the view with the necessary data
        return view('webpages.reservation', [
            'car_id' => $car_id,
            'car' => $car,
            'start_date' => $startDate,
            'deadline' => $deadline,
            'maxDays' => $maxDays,
        ]);
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id', // Ensure car_id is validated
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'start_date' => 'required|date',
            'deadline' => 'required|date',

        ]);
    
        // Retrieve the car details using car_id
        $car = Car::findOrFail($validatedData['car_id']);
    
        // Retrieve the user by email
        $user = User::where('email', $validatedData['email'])->first();
    
        // Optionally, handle the case where the user does not exist
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found']);
        }
    
        // Store start_date in a variable
        $startDate = Carbon::parse($validatedData['start_date']);
    
        // Calculate the endDate by adding the number of days to the startDate
        $endDate = Carbon::parse($validatedData['deadline']);
        // Create the booking
        $booking = Booking::create([
            'car_id' => $car->id,
            'user_id' => $user->id,
            'start_date' => $startDate,
            'deadline' => $endDate,
        ]);
    
        // Redirect or respond
        return redirect()->route('report.show', ['id' => $booking->id]);
    }
    

}
