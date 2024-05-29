{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.master')

@section('header')
Edit Profile Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    
@endsection

@section('content')

        @include('profile.partials.update-password-form')

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
