@extends('layouts.layout')

@php
use App\Models\Car;
use Carbon\Carbon;

// Fetch all cars
$cars = Car::all();
@endphp

@section('content')
    <div class="container mt-5">
        @if (session()->has('start_date') && session()->has('end_date'))
            <div class="alert alert-info">
                <strong>Booking Dates:</strong><br>
                Start Date: {{ session('start_date') }}<br>
                End Date: {{ session('end_date') }}
            </div>
        @else
            <div class="alert alert-warning">
                <strong>No booking dates are set.</strong>
            </div>
        @endif

        <h1 class="mb-4 text-center">Available Cars</h1>
        
        @if ($cars->isEmpty())
            <div class="alert alert-warning">
                <strong>No cars are available at the moment.</strong>
            </div>
        @else
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light">
                            <img src="{{ $car->img }}" alt="{{ $car->reg_num }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Car ID: {{ $car->id }}</h5>
                                <p class="card-text"><strong>Registration Number:</strong> {{ $car->reg_num }}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('reservation', ['car_id' => $car->id]) }}" class="btn btn-primary">
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
