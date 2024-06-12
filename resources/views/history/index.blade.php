@extends('layouts.master')


@section('header')
    Manage History Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <div class="row">


        <div class="card card-default col-12">
            <div class="card-body" id="resultcours">
                <!-- ./row -->
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 ">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-Content-tab" data-toggle="pill"
                                            href="#custom-tabs-one-Content" role="tab"
                                            aria-controls="custom-tabs-one-home" aria-selected="true">Content</a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-Categoty-tab" data-toggle="pill"
                                            href="#custom-tabs-one-Categoty" role="tab"
                                            aria-controls="custom-tabs-one-Categoty" aria-selected="false">Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-SubCategory-tab" data-toggle="pill"
                                            href="#custom-tabs-one-SubCategory" role="tab"
                                            aria-controls="custom-tabs-one-SubCategory"
                                            aria-selected="false">SubCategory</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-Program-tab" data-toggle="pill"
                                            href="#custom-tabs-one-Program" role="tab"
                                            aria-controls="custom-tabs-one-Program" aria-selected="false">Program</a>
                                    </li>

                                    {{-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-Speaker-tab" data-toggle="pill"
                                        href="#custom-tabs-one-Speaker" role="tab"
                                        aria-controls="custom-tabs-one-Speaker"
                                        aria-selected="false">Speaker</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-Manager-tab" data-toggle="pill"
                                        href="#custom-tabs-one-Manager" role="tab"
                                        aria-controls="custom-tabs-one-Manager"
                                        aria-selected="false">Manager</a>
                                </li> --}}

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-Content" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-Content-tab">
                                        @include('history.partial.content')
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-Quicly" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-Quicly-tab">

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-Categoty" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-Categoty-tab">

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-SubCategory" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-SubCategory-tab">

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-Program" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-Program-tab">

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-Objectives" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-Objectives-tab">

                                    </div>

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>



            </div>
        </div>


        <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('components.jQuery')
    @include('components.spicific-script')
@endsection
