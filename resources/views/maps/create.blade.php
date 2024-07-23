@extends('layouts.master')

@section('header')
    Create Map Page
@endsection

@section('page')
    View Maps
@endsection

@section('link')
    {{ route('map.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="card card-default col-12">
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">Create Maps.</h3>
                </div>

            </div>
            <!-- /.card-header -->
            <form action="{{ route('map.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control"
                            placeholder="Enter ...">
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <select class="form-control select2" name="country" style="width: 100%;">
                            @foreach ($cities as $city)
                                <option value="{{ $city->lng . ',' . $city->lat }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Slogan</label>
                        <input type="text" value="{{ old('slogan') }}" name="slogan" class="form-control"
                            placeholder="Enter ...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Image Principale</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="imagePrincipale" class="custom-file-input"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagesInputFile">Images</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="images[]" class="custom-file-input" id="imagesInputFile"
                                    multiple>
                                <label class="custom-file-label" for="imagesInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <div id="imagesNormale-container" class="mt-3 d-flex"></div>
                    </div>



                    <div class="form-group">
                        <label> Date of Establishment</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" value="{{ old('dateEstablishe') }}" name="dateEstablishe"
                                class="form-control datetimepicker-input" data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- Date and time -->

                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>founder</label>
                        <input type="text" value="{{ old('founder') }}" name="founder" class="form-control"
                            placeholder="Enter ...">
                    </div>

                    <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagesPlateInputFile">Main dishes</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="plateImages[]" class="custom-file-input"
                                    id="imagesPlateInputFile" multiple>
                                <label class="custom-file-label" for="imagesPlateInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <div id="image-container" class="mt-3"></div>
                    </div>


                    <div class="form-group">
                        <label for="imagesclotheInputFile">Main clothes</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="clotheImages[]" class="custom-file-input"
                                    id="imagesclotheInputFile" multiple>
                                <label class="custom-file-label" for="imagesclotheInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <div id="image-container-clothes" class="mt-3"></div>
                    </div>


                    <div class="form-group">
                        <label for="imagespalceInputFile">Places</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="placeImages[]" class="custom-file-input" id="imagespalceInputFile" multiple>
                                <label class="custom-file-label" for="imagespalceInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <div id="image-container-places" class="mt-3"></div>
                    </div>
                    

                </div>


                <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Create</button>

            </form>

        </div>





    </div>
    @include('components.jQuery')
@endsection
