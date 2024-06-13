@extends('layouts.master')

@section('header')
    Manage Manager Page
@endsection

@section('page')
    View Profiles
@endsection

@section('link')
    {{ Route('role.index') }}
@endsection

@section('content')
    <div class="row">
        <div class="card card-default col-12">
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">Create an Managers</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{ route('index.manager') }}" class="btn btn-block btn-default w-25">
                        View Managers
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="roleManager" hidden>
                <div class="card-body">
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                <label class="custom-file-label" for="avatar">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" value="{{ old('firstName') }}" class="form-control" name="firstName"
                            id="firstName" placeholder="Enter First Name ...">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" value="{{ old('lastName') }}" class="form-control" name="lastName"
                            id="lastName" placeholder="Enter Last name ...">
                    </div>

                    <div class="form-group">
                        <label>Roles</label>
                        <select name="role[]" class="form-control select2" style="width: 100%;">
                            @foreach ($roleManagers as $roleManager)
                                <option value="{{ $roleManager->name }}">{{ $roleManager->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                            id="exampleInputEmail1" placeholder="Enter email ...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Password ...">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm the password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            placeholder="Enter Confirm the password ...">
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Create</button>

            </form>

        </div>
    </div>



    @include('components.jQuery')
@endsection
