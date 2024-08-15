@extends('layouts.layout')

@php
use App\Models\Car;

$cars = Car::whereNull('user_id')->get();
@endphp

@section('content')
    <div class="container">
        <h1>All Cars</h1>
        <div class="row">
            @foreach ($cars as $car)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Car ID: {{ $car->id }}</h5>
                            <p class="card-text"><strong>Registration Number:</strong> {{ $car->reg_num }}</p>
                            <p class="card-text">
                                <strong>Image:</strong>
                                <img src="{{($car->img) }}" alt="{{ $car->reg_num }}" style="max-width: 100px; max-height: 100px;">
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
