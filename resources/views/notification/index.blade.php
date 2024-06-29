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


        /* // Event listeners for marking as read and deleting notifications
        $(document).on('click', '.markAsRead', function() {
            var notificationId = $(this).data('id');
            markNotificationAsRead(notificationId);
        });

        $(document).on('click', '.notificationDelete', function() {
            var notificationId = $(this).data('id');
            deleteNotification(notificationId);
        });

        // Function to mark notification as read via AJAX
        function markNotificationAsRead(notificationId) {
            var notificationUrl = '{{ route('notification.read', ['notificationId' => ':notificationId']) }}';
            notificationUrl = notificationUrl.replace(':notificationId', notificationId);

            if (notificationUrl.startsWith('http://')) {
                notificationUrl = notificationUrl.replace('http://', 'https://');
            }

            $.ajax({
                url: notificationUrl,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Handle success, e.g., update UI
                    console.log('Notification marked as read successfully.');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.log(error);
                }
            });
        }

        // Function to delete notification via AJAX
        function deleteNotification(notificationId) {
            var notificationUrl = '{{ route('notification.delete', ['notificationId' => ':notificationId']) }}';
            notificationUrl = notificationUrl.replace(':notificationId', notificationId);
            if (notificationUrl.startsWith('http://')) {
                notificationUrl = notificationUrl.replace('http://', 'https://');
            }
            $.ajax({
                url: notificationUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success, e.g., update UI
                    console.log('Notification deleted successfully.');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.log(error);
                }
            });
        } */

        // Fetch notifications on page load
        $(document).ready(function() {
            fetchIndexNotifications();
        });
    </script>
@endsection
