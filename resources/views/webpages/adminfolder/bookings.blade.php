@extends('layouts.layout')

@php
    use App\Models\Booking;
    use App\Models\User;
    use App\Models\Car;

    // Fetch all bookings with related users and cars, sorted by car_id
    $bookings = Booking::with(['user', 'car'])->orderBy('car_id')->get();
@endphp

@section('content')
    <div class="container mt-5">

        @if ($bookings->isEmpty())
            <p>No reservations found.</p>
        @else
            <!-- Add table-responsive class to make the table scrollable on small screens -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User Name</th>
                            <th>Start Date</th>
                            <th>Deadline</th>
                            <th>Car Registration Number</th>
                            <th>Car ID</th> <!-- Added column for Car ID -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            @php
                                // Format dates
                                $startDateFormatted = \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d');
                                $deadlineFormatted = \Carbon\Carbon::parse($booking->deadline)->format('Y-m-d');
                            @endphp
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name ?? 'Unknown' }}</td>
                                <td>{{ $startDateFormatted }}</td>
                                <td>{{ $deadlineFormatted }}</td>
                                <td>{{ $booking->car->reg_num ?? 'Unknown' }}</td>
                                <td>{{ $booking->car->id ?? 'Unknown' }}</td> <!-- Display Car ID -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
