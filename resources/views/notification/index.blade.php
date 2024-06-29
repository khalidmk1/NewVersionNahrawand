@extends('layouts.master')


@section('header')
    Manage Notification Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <div class="container">
        <div class="row " id="notifications_container">
        </div>
    </div>

    @include('components.jQuery')
    <script>
        function fetchIndexNotifications() {
            var notificationUrl = '{{ route('notification.all', [], true) }}';
            $.ajax({
                url: notificationUrl,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#notifications_container').html(response);
                },
                error: function(error) {
                    console.log("Error fetching notifications:",
                        error);
                }
            });
        }

        // Fetch notifications on page load
        $(document).ready(function() {
            fetchIndexNotifications();
        });
    </script>
@endsection
