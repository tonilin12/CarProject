<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;

class BookingController extends Controller
{
    //
    
    public function show($id)
    {
        // Try to find the booking by ID
        $booking = Booking::find($id);

        // If booking not found, redirect to home with error message
        if (!$booking) {
            return redirect()->route('home')->withErrors(['error' => 'Booking not found.']);
        }

        // Pass the booking to the view
        return view('webpages.report1')->with('booking', $booking);
    }
}
