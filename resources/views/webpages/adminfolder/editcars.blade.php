@extends('layouts.layout')

@php
    use App\Models\Car;
    use App\Models\Booking;
    use Carbon\Carbon;

    // Fetch all cars
    $cars = Car::all();
@endphp

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Cars</h1>
        <br><br>
        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('car.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn" style="background-color: #cc5500; border-color: #cc5500; color: white; padding: 15px 30px; font-size: 18px; min-width: 200px;">
                    Add New Car
                </button>
            </form>
        </div>
        <br><br>

        <div class="row">
            @foreach ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light">
                        <img src="{{ $car->img }}" alt="{{ $car->reg_num }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Car ID: {{ $car->id }}</h5>
                            <p class="card-text"><strong>Registration Number:</strong> {{ $car->reg_num }}</p>
                            <p class="card-text">
                                <strong>Status:</strong>
                                <span class="badge {{ $car->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $car->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('cars.changeStatus', $car) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn" style="background-color: #003366; border-color: #003366; color: white;">
                                        Change Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
