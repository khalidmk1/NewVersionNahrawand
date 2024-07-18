@extends('layouts.guest')

@section('model-title')
    Update Pasword
@endsection

@section('model-content')
    <form action="{{ route('password.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">

            <div class="form-group">
                <label for="current_password"> Current password</label>
                <input type="password" class="form-control" id="current_password" placeholder="Entre Current password"
                    name="current_password">
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" placeholder="Entre New Password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="Entre Confirm Password"
                    name="password_confirmation">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>

        </div>
    </form>
@endsection
