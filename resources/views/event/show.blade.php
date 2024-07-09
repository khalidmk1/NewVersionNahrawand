@extends('layouts.master')

@section('header')
    Create Event Page
@endsection

@section('page')
    View Events
@endsection

@section('link')
    {{ route('event.index') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">

            @foreach ($event->eventUser as $eventUser)
                <div class="row">
                    <div class="col">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('storage/avatars/' . $eventUser->user->avatar) }}"
                                        alt="User profile picture" style="height: 100px; width: 100px">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $eventUser->user->firstName . ' ' . $eventUser->user->lastName }}</h3>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            @endforeach

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Edite</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Setting</a>
                        </li>

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex align-items-center">
                                    <h1 class="username">
                                        <div>{{ $event->title }}</div>

                                    </h1>

                                </div>
                                <!-- /.user-block -->

                                <div class="row mb-3">

                                    <!-- /.col -->
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img class="img-fluid" src="{{ asset('storage/event/' . $event->image) }}"
                                                    alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <!-- /.row -->
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>Description.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $event->description }}
                                </p>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>Date Start.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $event->dateStart }}
                                </p>
                            </div>
                            <!-- /.post -->
                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>Date End.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $event->dateEnd }}
                                </p>
                            </div>
                            <!-- /.post -->

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">

                            @include('event.partial.update')
                        </div>

                        <x-delete-modal :modelDeleteId="$event->id"  :modelTitle="'Delete Event'" :modelRouteDelete="route('event.destroy', Crypt::encrypt($event->id))" />

                        <div class="tab-pane" id="settings">
                            <div class="form-group">
                                <button type="submit" data-toggle="modal" data-target="#delete_{{ $event->id }}"
                                    class="btn btn-danger w-50">Delete</button>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <script>
        $(document).ready(function() {
            $('.videoTags').each(function() {
                var videoId = $(this).data('id');

                var tagInputEle = $('#tags-input-' + videoId);
                tagInputEle.tagsinput();
            });

        })
    </script>
@endsection
