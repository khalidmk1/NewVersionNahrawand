@extends('layouts.master')

@section('header')
    Create Content Page
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
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">Create Content.</h3>
                </div>

            </div>
            <!-- /.card-header -->
            <form action="{{ route('content.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Ttile</label>
                        <input type="text" value="{{ old('title') }}" class="form-control" name="title" id="title"
                            placeholder="Enter Ttile ...">
                    </div>

                    <div class="row justify-content-around ">
                        <div class="form-group clearfix text-center col-4">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="isComing" id="iscoming">
                                <label for="iscoming">
                                    Coming Soon
                                </label>
                            </div>

                        </div>



                        <div class="form-group col-4 text-center">
                            <!-- Bootstrap Switch -->
                            <label for="boostrap-switch" class="mr-5">
                                Display
                            </label>
                            <input type="checkbox" name="isActive" checked data-bootstrap-switch data-off-color="danger"
                                data-on-color="success">
                        </div>
                        <!-- /.card -->
                    </div>





                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" name="tags[]" id="tags-input" />
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                                    style="width: 100%;">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-6">

                            {{-- <div class="form-group">
                                <label for="objective_option">Objectives</label>
                                <select class="select3" name="objectivesId[]" multiple="multiple" id="objective_option"
                                    data-placeholder="Select a State" style="width: 100%;">

                                </select>
                            </div> --}}

                            <div class="form-group">
                                <label for="subCategory">SubCategories</label>
                                <select class="select3" name="subCategoryId[]" multiple="multiple" id="subCategory"
                                    data-placeholder="Select a State" style="width: 100%;">
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->

                        </div>


                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label>Type Content</label>
                        <select class="form-control" name="contentType" id="cours_type">
                            <option value="select" selected>Choose Content Type</option>
                            <option value="conference">Conférance Content</option>
                            <option value="podcast">Podcast Content</option>
                            <option value="formation">Formation Content</option>
                            <option value="quickly">Quickly Content</option>
                        </select>
                    </div>
                    @include('content.partial.sections.conference')
                    @include('content.partial.sections.podcast')
                    @include('content.partial.sections.formation')
                    @include('content.partial.sections.quickly')

                    <section class="appendedSection"></section>



                </div>

                <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right"
                    id="create_btn">Create</button>

            </form>

        </div>





    </div>

    @include('components.jQuery')

    <script>
        $(document).ready(function() {

            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();
            
        });
    </script>
@endsection
