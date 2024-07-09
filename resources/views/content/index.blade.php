@extends('layouts.master')

@section('header')
    Content Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Content</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Quickly</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body p-0">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    @livewire('content-card')
                </div>
                <div class="tab-pane" id="timeline">
                    @livewire('quickly-card')
                </div>
            </div>
        </div><!-- /.card-body -->
    </div><!-- /.card -->
@endsection
