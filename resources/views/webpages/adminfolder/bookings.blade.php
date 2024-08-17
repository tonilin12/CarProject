@extends('layouts.layout')

@php
    use App\Models\Booking;
    use App\Models\User;
    use App\Models\Car;

    // Fetch all bookings with related users and cars, sorted by car_id
    $bookings = Booking::with(['user', 'car'])->orderBy('car_id')->get();
@endphp

@section('content')
   <h1>adminpage</h1>
@endsection
