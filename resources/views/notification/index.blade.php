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
        <div class="row ">
            <div class="col-lg-12 right">
                <div class="box shadow-sm rounded bg-dark mb-3">
                    <div class="box-body p-0" id="notifications-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
