@extends('layouts.master')

@section('header')
    FAQ Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection


@section('content')
    <x-create-filter-modal :titleModel="'Create FAQ'" :modelRouteCreate="route('FAQ.store')">
        <!-- textarea -->
        <div class="form-group">
            <label>Question</label>
            <input type="text" value="{{ old('question') }}" class="form-control" name="question" id="Question"
                placeholder="Enter ...">
        </div>

        <!-- textarea -->
        <div class="form-group">
            <label>Response</label>
            <textarea class="form-control" name="answer" rows="3" placeholder="Enter ..."></textarea>
        </div>
    </x-create-filter-modal>
    <div class="row">
        <div class="card card-default col-12">
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">View FAQ</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a data-toggle="modal" data-target="#Create-Filter-Modal" class="btn btn-block btn-default w-25">
                        Create
                    </a>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                @foreach ($FAQs as $FAQ)
                    <form action="{{ route('FAQ.update', Crypt::encrypt($FAQ->id)) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                                <label for="Question" class="col-md-1 col-form-label">Question</label>
                                <div class="col-md-6">
                                    <!-- select -->
                                    <input type="text" value="{{ old('question', $FAQ->question) }}" class="form-control"
                                        name="question" id="Question" placeholder="Enter ...">
                                </div>

                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-block btn-warning w-25 mb-3 ml-3"
                                        style="float: right">
                                        Update</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Response </label>
                                <textarea class="form-control" name="answer" rows="3" placeholder="Enter ...">{{ $FAQ->answer }}</textarea>
                            </div>
                        </div>
                        <hr style="background: white">

                    </form>
                @endforeach

            </div>





        </div>
    </div>
@endsection
