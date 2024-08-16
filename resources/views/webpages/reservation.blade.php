@extends('layouts.layout')

@php
    use App\Models\Booking;
    use App\Models\User;

    // Fetch all bookings sorted by car_id
    $bookings = Booking::orderBy('car_id')->get();
@endphp

@section('content')
    <div class="container">

        @if ($bookings->isEmpty())
            <p>No reservations found for this car.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User ID</th>
                        <th>Start Date</th>
                        <th>Deadline</th>
                        <th>Car ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        @php
                            // Fetch user data for each booking
                            $user = User::find($booking->user_id);

                            // Format dates
                            $startDateFormatted = \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d');
                            $deadlineFormatted = \Carbon\Carbon::parse($booking->deadline)->format('Y-m-d');
                        @endphp
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $user ? $user->id : 'Unknown' }}</td>
                            <td>{{ $startDateFormatted }}</td>
                            <td>{{ $deadlineFormatted }}</td>
                            <td>{{ $booking->car_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
