@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Booking Form</h1>

        <h5 class="card-title">Car ID: {{ $car_id }}</h5>
        <p><strong>Start Date:</strong> {{ $start_date->format('Y-m-d') }}</p>
        <p><strong>End Date:</strong> {{ $deadline->format('Y-m-d') }}</p>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-light">
                    <div class="card-body p-4">
                        <form action="{{ route('reserve.store') }}" method="POST">
                            @csrf

                            <!-- Hidden inputs for car_id, start_date, and deadline -->
                            <input type="hidden" name="car_id" value="{{ $car_id }}">
                            <input type="hidden" name="start_date" value="{{ $start_date->format('Y-m-d') }}">
                            <input type="hidden" name="deadline" value="{{ $deadline->format('Y-m-d') }}">

                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="example@example.com" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="123 Main St, City, Country" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone Number:</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="(123) 456-7890" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="days">Number of Days to Book:</label>
                                <select id="days" name="days" class="form-control" required onchange="updateTotalPrice()">
                                    @for ($i = 1; $i <= $maxDays; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <p><strong>Total Price:</strong> <span id="total-price">0.00</span> HUF</p>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript to update the total price -->
    <script>
        // Assume dailyPrice is provided as a Blade variable
        const dailyPrice = {{ $car->daily_price }};

        function updateTotalPrice() {
            const days = parseInt(document.getElementById('days').value, 10);
            const totalPrice = dailyPrice * days;
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }

        // Initialize the total price on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateTotalPrice();
        });
    </script>
@endsection
