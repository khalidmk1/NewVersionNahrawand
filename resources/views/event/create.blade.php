@extends('layouts.master')

@section('header')
    Create Event Page
@endsection

@section('page')
    View Events
@endsection

@section('link')
    {{ route('report.index') }}
@endsection


@section('content')
    <div class="row">
        <div class="card card-default col-12">
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">Create Event.</h3>
                </div>

                <div class="col-6 d-flex justify-content-end">
                    <a href="{{route('event.index')}}" class="btn btn-block btn-default w-25">
                        View Events
                    </a>
                </div>

            </div>
            <!-- /.card-header -->

            <div class="card-body">

                <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="text">Ttile</label>
                        <input type="text" name="title" class="form-control" id="text"
                            placeholder="Enter Title ...">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Speakers</label>
                        <select class="select2" name="speakerID[]" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;">
                            @foreach ($speakers as $speaker)
                                <option value="{{ $speaker->id }}">
                                    {{ $speaker->lastName . ' ' . $speaker->firstName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date Start:</label>
                        <div class="input-group date" id="DateStart" data-target-input="nearest">
                            <input type="text" name="datestart" class="form-control datetimepicker-input"
                                data-target="#DateStart" />
                            <div class="input-group-append" data-target="#DateStart" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date End:</label>
                        <div class="input-group date" id="DateEnd" data-target-input="nearest">
                            <input type="text" name="DateEnd" class="form-control datetimepicker-input"
                                data-target="#DateEnd" />
                            <div class="input-group-append" data-target="#DateEnd" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url">Event Url</label>
                        <input type="url" name="url" class="form-control" id="url"
                            placeholder="Enter Title ...">
                    </div>


                    <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3"
                        style="float: right">Create</button>
                </form>

            </div>

        </div>

    </div>
@endsection
