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

        $(document).on('submit', '.deleteNotification', function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                url: $form.attr('action').replace('http://', 'https://'),,
                method: $form.attr('method'),
                data: $form.serialize(), 
                success: function(response) {
                    console.log(response);
                    fetchIndexNotifications();
                },
                error: function(error) {
                    console.log("Error deleting notification:", error);
                }
            });
        });

        // Handle Mark as Read Form Submission
        $(document).on('submit', '.markAsRead', function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                url: $form.attr('action').replace('http://', 'https://'),,
                method: $form.attr('method'),
                data: $form.serialize(), 
                success: function(response) {
                    console.log(response);
                    fetchIndexNotifications();
                },
                error: function(error) {
                    console.log("Error marking notification as read:", error);
                }
            });
        });

        // Fetch notifications on page load
        $(document).ready(function() {
            fetchIndexNotifications();
        });
    </script>
@endsection
