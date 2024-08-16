@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Booking Report</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking ID: {{ $booking->id }}</h5>
                    <p><strong>Car ID:</strong> {{ $booking->car_id }}</p>
                    <p><strong>User ID:</strong> {{ $booking->user_id }}</p>
                    <p><strong>Start Date:</strong> {{ $booking->start_date->format('Y-m-d') }}</p>
                    <p><strong>Deadline:</strong> {{ $booking->deadline->format('Y-m-d') }}</p>
                </div>
            </div>
        @endif
    </div>
@endsection
