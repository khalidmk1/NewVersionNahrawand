<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('components.style-links')
</head>

<body class="hold-transition login-page ">
    @include('components.erreur-handle')
    @yield('content')

    @include('components.scripts')
</body>

</html>
