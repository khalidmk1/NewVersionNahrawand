@extends('layouts.master')

@section('header')
    Edit Profile Page
@endsection

@section('page')
    @if ($user->hasRole('Admin'))
        View administrators
    @elseif($user->hasRole(['Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier']))
        View Speakers
    @else
        View Managers
    @endif
@endsection

@section('link')
    @if ($user->hasRole('Admin'))
        {{ route('index.admin') }}
    @elseif($user->hasRole(['Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier']))
        {{ route('index.speaker') }}
    @else
        {{ route('index.manager') }}
    @endif
@endsection

@section('content')
    @include('profile.partials.update-user-password-form')
    <!-- Main content -->
    <div class="row ">
        <!-- left column -->
        <div class="col-md-8 m-auto">
            <!-- general form elements -->
            <div class="card card-primary card-outline">
                @include('profile.partials.update-profile-information-form')
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
