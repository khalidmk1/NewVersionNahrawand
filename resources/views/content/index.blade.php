@extends('layouts.master')

@section('header')
    Content Page
@endsection

@section('page')
    View contents
@endsection

@section('link')
    {{ route('content.index') }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;
            const targetUrl = "http://127.0.0.1:8000/dashboard/content";
    
            // Check if the current URL is not the target URL (ignoring query parameters)
            if (currentUrl.startsWith(targetUrl) && currentUrl !== targetUrl) {
                window.location.href = targetUrl;
            }
        });
    </script>
    
@endsection
