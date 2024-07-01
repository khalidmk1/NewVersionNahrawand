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
            var notificationUrl = '{{ route('notification.all') }}';
            if (notificationUrl.startsWith('http://')) {
                notificationUrl = notificationUrl.replace('http://', 'https://');
            }
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


        $('.deleteNotification').on('submit', function(e) {
            e.preventDefault();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },

                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log(error);


                }
            });
        })
        $('.markAsRead').on('submit', function(e) {
            e.preventDefault();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },

                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log(error);


                }
            });
        })

        // Fetch notifications on page load
        $(document).ready(function() {
            fetchIndexNotifications();
        });
    </script>
@endsection
