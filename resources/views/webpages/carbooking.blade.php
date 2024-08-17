@extends('layouts.layout')

@php
    use App\Models\Car;
    use App\Models\Booking;
    use Carbon\Carbon;

    // Fetch all cars
    $cars = Car::all();

    // Retrieve the start and end dates from the session
    $startDate = session('start_date');
    $deadline = session('end_date');

    // Ensure startDate and deadline are valid dates
    $startDate = Carbon::parse($startDate);
    $deadline = Carbon::parse($deadline);

    // Retrieve bookings that overlap with the provided date range
    $overlappingBookings = Booking::where(function ($query) use ($startDate, $deadline) {
        $query->whereBetween('start_date', [$startDate, $deadline])
            ->orWhereBetween('end_date', [$startDate, $deadline])
            ->orWhere(function ($query) use ($startDate, $deadline) {
                $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $deadline);
            });
    })->get();

    // Get car IDs for overlapping bookings
    $overlappingCarIds = $overlappingBookings->pluck('car_id')->toArray();

    // Filter out cars that are booked during the specified date range
    $availableCars = $cars->filter(function ($car) use ($overlappingCarIds) {
        return $car->is_active && !in_array($car->id, $overlappingCarIds);
    });
@endphp

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Available Cars</h1>

        <!-- Print current startDate and deadline -->
        <div class="alert alert-info">
            <strong>Start Date:</strong> {{ $startDate->format('Y-m-d') }}<br>
            <strong>End Date:</strong> {{ $deadline->format('Y-m-d') }}
        </div>

        <!-- Print all overlapping bookings -->
        <div class="alert alert-info">
            <strong>Overlapping Bookings:</strong>
            @if ($overlappingBookings->isEmpty())
                <p>No overlapping bookings found.</p>
            @else
                <ul>
                    @foreach ($overlappingBookings as $booking)
                        <li>
                            Booking ID: {{ $booking->id }} | Car ID: {{ $booking->car_id }} | Start Date: {{ $booking->start_date->format('Y-m-d') }} | End Date: {{ $booking->deadline->format('Y-m-d') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if ($cars->isEmpty())
            <div class="alert alert-warning">
                <strong>No cars are available at the moment.</strong>
            </div>
        @else
            <div class="row">
                @foreach ($availableCars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light">
                            <img src="{{ $car->img }}" alt="{{ $car->reg_num }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Car ID: {{ $car->id }}</h5>
                                <p class="card-text"><strong>Registration Number:</strong> {{ $car->reg_num }}</p>
                                <p class="card-text"><strong>Daily Price:</strong> {{ number_format($car->daily_price, 0) }} HUF</p>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('reservation', ['car_id' => $car->id]) }}?start_date={{ $startDate->format('Y-m-d') }}&end_date={{ $deadline->format('Y-m-d') }}" class="btn btn-primary">
                                        Make Reservation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
