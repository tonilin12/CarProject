@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Booking Form</h1>

        <h5 class="card-title">Car ID: {{ $car_id }}</h5>
        <p><strong>Start Date:</strong> {{ $start_date->format('Y-m-d') }}</p>
        <p><strong>End Date:</strong> <span id="end-date">{{ $deadline->format('Y-m-d') }}</span></p>

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
                            <input type="hidden" id="deadline" name="deadline" value="{{ $deadline->format('Y-m-d') }}">
                            <input type="hidden" id="days-hidden" name="days" value="1">

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
                                <select id="days" class="form-control" required onchange="updateTotalPriceAndEndDate()">
                                    @for ($i = $maxDays; $i > 0; $i--)
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

    <!-- Include JavaScript to update the total price and end date -->
    <script>
        // Assume dailyPrice is provided as a Blade variable
        const dailyPrice = {{ $car->daily_price }};
        const startDate = new Date('{{ $start_date->format('Y-m-d') }}'); // Convert to JavaScript Date

        function updateTotalPriceAndEndDate() {
            const days = parseInt(document.getElementById('days').value, 10);

            // Calculate the total price
            const totalPrice = dailyPrice * days;
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);

            // Calculate the new end date
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + days - 1); // Subtract 1 to get the correct end date

            // Format the date as YYYY-MM-DD
            const formattedEndDate = endDate.toISOString().split('T')[0];

            // Update the hidden deadline input and the displayed end date
            document.getElementById('deadline').value = formattedEndDate;
            document.getElementById('end-date').innerText = formattedEndDate;

            // Update hidden days input
            document.getElementById('days-hidden').value = days;
        }

        // Initialize theffffffffff total price and end date on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateTotalPriceAndEndDate();
        });
    </script>
@endsection
