<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarBookingController extends Controller
{
    /**
     * Show the form for booking a car.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('carbooking');
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
       
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Store the dates in the session
        session(['start_date' => $startDate, 'end_date' => $endDate]);
    
        // Redirect back to the carbooking page
        return redirect()->route('carbooking');
    }
    
}