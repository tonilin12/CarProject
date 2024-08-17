@extends('layouts.layout')

@php
    use App\Models\Booking;
    use App\Models\User;
    use App\Models\Car;

    // Fetch all bookings with related users and cars, sorted by car_id
    $bookings = Booking::with(['user', 'car'])->orderBy('car_id')->get();
@endphp

@section('content')
  <!-- Welcome Message -->
    <div class="text-center mb-5">
        <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="lead">Here’s a quick overview of your bookings and car management options.</p>
    </div>

    <!-- Navigation Links -->
    <div class="d-flex justify-content-center mb-5">
        <a class="btn btn-lg btn-primary mx-2" href="{{ route('admin.bookings') }}">List Bookings</a>

        <a class="btn btn-lg btn-secondary mx-2" href="{{ route('home') }}">Edit Cars</a>
    </div>
@endsection
