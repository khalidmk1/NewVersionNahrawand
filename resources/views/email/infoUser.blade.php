@extends('layouts.email')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            margin: 20px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 15px 0;
        }

        .content .highlight {
            background-color: #f9f9f9;
            border-left: 4px solid #4CAF50;
            padding: 10px;
            margin: 20px 0;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #999;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
    <div class="container">
        <div class="header">
            <h1>Welcome, {{ $fullName }}</h1>
        </div>
        <div class="content">
            <p>Your account has been created. Here are your login details:</p>
            <div class="highlight">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>
            <p>Thank you for registering!</p>
        </div>
        <div class="footer">
            <p>© 2024 Nahrawand Academy. All rights reserved.</p>
            <p><a href="https://ba.nahrawandacademy.ma/">Visit our website</a></p>
        </div>
    </div>
@endsection
