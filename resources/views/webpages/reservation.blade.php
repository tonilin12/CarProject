@extends('layouts.layout')

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
                        @endphp
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $user ? $user->id : 'Unknown' }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->deadline }}</td>
                            <td>{{ $booking->car_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
