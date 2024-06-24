@extends('layouts.master')

@section('header')
    Create Quiz Page
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
                    <h3 class="card-title">Create Quiz </h3>
                </div>
                <div class="col-6">
                    {{--     <a href="{{ Route('dashboard.create.video.fomation', Crypt::encrypt($coursFormationId->id)) }}"
                        style="float: inline-end" class="btn btn-block btn-info w-25">Create Video</a> --}}
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">


                <ul class="nav nav-tabs mb-3 justify-content-between" id="myTab" role="tablist">
                    @if ($content->quizType == 0 || $content->quizType == null)
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">QSM</a>
                        </li>
                    @endif
                    @if ($content->quizType == 1 || $content->quizType == null)
                        <li class="nav-item">
                            <a class="nav-link @if ($content->quizType == 1) active @endif" id="profile-tab"
                                data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Question</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade @if ($content->quizType == 0 || $content->quizType == null) show active @endif" id="home"
                        role="tabpanel" aria-labelledby="home-tab">
                        @include('quiz.content.partial.qsm')
                        <div class="col-12">
                            <div class="row mt-4">
                                @include('quiz.components.qsmContentCard')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade @if ($content->quizType == 1) show active @endif" id="profile"
                        role="tabpanel" aria-labelledby="profile-tab">
                        @include('quiz.content.partial.question')
                        <div class="col-12">
                            <div class="row mt-4">
                                @include('quiz.components.qsmContentCard')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
