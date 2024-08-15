<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cars = Car::all(); // Retrieve all cars from the database
        return view('cars.index', compact('cars')); // Pass the cars data to the view
    }
}
