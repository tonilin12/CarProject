@extends('layouts.layout')

@section('content')

    <!-- jQuery and jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- Date Range Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <form method="POST" action="{{ route('carbooking.store') }}">
        @csrf
        <label for="daterange">Select Date Range:</label>
        <input type="text" id="daterange" name="daterange">

        <!-- Hidden fields to store start and end dates -->
        <input type="hidden" id="start_date" name="start_date">
        <input type="hidden" id="end_date" name="end_date">

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            var today = moment().startOf('day');
            $("#daterange").daterangepicker({
                startDate: today,
                minDate: today,
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                // Update hidden fields with selected dates
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection
