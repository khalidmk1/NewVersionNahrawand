@extends('layouts.master')

@section('header')
    Manage Speaker Page
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
                    <h3 class="card-title">Create Sperkers</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{ route('index.speaker') }}" class="btn btn-block btn-default w-25">
                        View Speakers
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="roleSpeaker" hidden>
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
                        <label for="Cover">Cover</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="Cover">
                                <label class="custom-file-label" for="Cover">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group clearfix text-center col-4">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="isPopulaire" id="isPopulaire">
                            <label for="isPopulaire">
                                Popular
                            </label>
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
                        <label>biography</label>
                        <textarea class="form-control" name="biographie" rows="3" placeholder="Enter biographie ..."></textarea>
                    </div>



                    <div class="form-group">
                        <label>Speaker Type</label>
                        <select class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;">
                            @foreach ($roleSpeakers as $roleSpeaker)
                                <option value="{{ $roleSpeaker->name }}">{{ $roleSpeaker->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                            id="exampleInputEmail1" placeholder="Enter email ...">
                    </div>

                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="url" value="{{ old('facebook') }}" class="form-control" name="facebook"
                            id="facebook" placeholder="Enter Facebook URL ...">
                    </div>
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="url" value="{{ old('linkedin') }}" class="form-control" name="linkedin"
                            id="linkedin" placeholder="Enter Linkedin URL ...">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="url" value="{{ old('instagram') }}" class="form-control" name="instagram"
                            id="instagram" placeholder="Enter Instagram URL ...">
                    </div>

                </div>

                <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Create</button>

            </form>

        </div>
    </div>



    @include('components.jQuery')
@endsection
