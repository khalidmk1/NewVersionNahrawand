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
   
   

    <x-delete-modal :modelDeleteId="$content->id" :modelTitle="'Delete content'" :modelRouteDelete="route('content.destroy', Crypt::encrypt($content->id))" />
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('storage/avatars/' . $content->user->avatar) }}" style="height: 100px; width: 100px"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">
                        {{ $content->user->firstName . ' ' . $content->user->lastName }}</h3>

                    <p class="text-muted text-center">
                        @foreach ($content->user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </p>

                    {{--  <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Number of invite</b> <a class="float-right">{{ $PodcastGuest->count() }}</a>
                        </li>


                    </ul> --}}


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail</a></li>
                        @can('viewEditeContent')
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Edite</a>
                            </li>
                        @endcan
                        @can('viewDeleteContent')
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Setting</a>
                            </li>
                        @endcan

                        @if ($content->isCertify == 1)
                            <li class="nav-item"><a class="nav-link" href="#quiz" data-toggle="tab">Quiz</a>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex align-items-center">
                                    <h1 class="username">
                                        <div>{{ $content->title }}</div>

                                    </h1>
                                    <h5 class="ml-4 badge badge-success">{{ $content->isActive ? 'Active' : '' }}</h5>
                                    <h5 class="ml-4 badge badge-warning">{{ $content->isComing ? 'A Venir' : '' }}</h5>
                                </div>
                                <!-- /.user-block -->

                                <div class="row mb-3">
                                    @if ($content->contentType != 'formation')
                                        <div class="col-sm-6">
                                            <iframe class="embed-responsive-item w-100 h-100 rounded border-dark"
                                                src="{{ $content->video }}" allowfullscreen></iframe>

                                        </div>
                                    @endif

                                    <!-- /.col -->
                                    <div class="{{ $content->contentType == 'formation' ? 'col-sm-12' : 'col-sm-6' }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-fluid"
                                                    src="{{ asset('storage/content/' . $content->image) }}" alt="Photo">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">

                                                <img class="img-fluid"
                                                    src="{{ asset('storage/flex/' . $content->imageFlex) }}"
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
                            @if ($content->contentType != 'formation')
                                <!-- Post -->
                                <div class="post">
                                    <div class="d-flex">
                                        <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                            aria-hidden="true"></i>
                                        <div class="ml-2"><strong>Small Description.</strong></div>

                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ $content->smallDescription }}
                                    </p>
                                </div>
                                <!-- /.post -->
                                <!-- Post -->
                                <div class="post">
                                    <div class="d-flex">
                                        <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                            aria-hidden="true"></i>
                                        <div class="ml-2"><strong>big Description.</strong></div>

                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ $content->bigDescription }}
                                    </p>
                                </div>
                                <!-- /.post -->
                            @endif


                            @if ($content->contentType == 'formation')
                                <!-- Post -->
                                <div class="post">
                                    <div class="d-flex">
                                        <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                            aria-hidden="true"></i>
                                        <div class="ml-2"><strong>Description.</strong></div>

                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ $content->smallDescription }}
                                    </p>
                                </div>
                                <!-- /.post -->
                            @endif




                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-tags" style="font-size: x-large" aria-hidden="true"></i>

                                    <div class="ml-2"><strong>Tags.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                @foreach ($content->tags as $tag)
                                    <h2 class="badge badge-info">
                                        {{ $tag->name }}
                                    </h2>
                                @endforeach
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">

                                    <i class="fa fa-bullseye" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>SubCategory.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                @foreach ($content->contentSubCategories as $subCategorie)
                                    <h5 class="badge badge-info">
                                        {{ $subCategorie->subCategory->name }}
                                    </h5>
                                @endforeach

                            </div>
                            <!-- /.post -->


                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="row mb-2 justify-content-between align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <i class="fa fa-exclamation-circle" style="font-size: x-large"
                                                aria-hidden="true"></i>
                                            <div class="ml-2 mb-2"><strong>Video.</strong></div>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('video.show', Crypt::encrypt($content->id)) }}"
                                            class="btn btn-block btn-info w-50" style="float: right;">Add
                                            video</a>
                                    </div>

                                </div>


                                <div class="row">
                                    @foreach ($content->videos as $video)
                                        <x-delete-modal :modelDeleteId="$video->id" :modelTitle="'Delete Video'" :modelRouteDelete="route('video.destroy', Crypt::encrypt($video->id))" />

                                        <x-card-video :videoUrl="$video->video" :videoID="$video->id">
                                            <x-update-filter-modal :filterId="$video->id" :titleModel="'Update Video'" :modelRoute="route('video.update', Crypt::encrypt($video->id))">
                                                <input hidden type="text" name="podcastId"
                                                    value="{{ $content->id }}">

                                                <div class="form-group">
                                                    <label for="titleVideo">Title</label>
                                                    <input type="text" value="{{ old('title', $video->title) }}"
                                                        class="form-control" name="title"
                                                        id="titleVideo_{{ $video->id }}"
                                                        placeholder="Entrez Title ...">
                                                </div>

                                                <div class="form-group clearfix text-center col-4">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox"
                                                            {{ $video->isComing == 1 ? 'checked' : '' }} name="isComing"
                                                            id="iscoming-{{ $video->id }}">
                                                        <label for="iscoming-{{ $video->id }}">
                                                            Coming Soon
                                                        </label>
                                                    </div>

                                                </div>

                                                <!-- textarea -->
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $video->description }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image2">Image</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image"
                                                            id="image_{{ $video->id }}">
                                                        <label class="custom-file-label"
                                                            for="image_{{ $video->id }}">Upload</label>
                                                    </div>
                                                </div>

                                                @if ($content->contentType == 'podcast')
                                                    <div class="form-group">
                                                        <label for="guestInvite">Invité(s)</label>
                                                        <select class="select3" name="guestIds[]" multiple="multiple"
                                                            id="guestInvite_{{ $video->id }}"
                                                            data-placeholder="Select a State" style="width: 100%;">
                                                            @foreach ($invertersUsers as $invertersUser)
                                                                <option
                                                                    {{ $video->videoguest->contains('userId', $invertersUser->id) ? 'selected' : '' }}
                                                                    value="{{ $invertersUser->id }}">
                                                                    {{ $invertersUser->email }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                @elseif($content->contentType == 'conference')
                                                    <div class="form-group">
                                                        <label for="guestConference">Conférencies</label>
                                                        <select class="select3" name="guestIds[]" multiple="multiple"
                                                            id="guestConference_{{ $video->id }}"
                                                            data-placeholder="Select a State" style="width: 100%;">
                                                            @foreach ($conferencerUsers as $conferencerUser)
                                                                <option value="{{ $conferencerUser->id }}"
                                                                    {{ $video->videoguest->contains('userId', $conferencerUser->id) ? 'selected' : '' }}>
                                                                    {{ $conferencerUser->email }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                @endif




                                                <div class="form-group">
                                                    <label for="tags_video">Tags</label>
                                                    <input type="text" class="form-control"
                                                        value="@foreach ($video->tags as $tag){{ $tag->name }}@if (!$loop->last),@endif @endforeach"
                                                        name="tags[]" data-id="{{ $video->id }}"
                                                        class="videoTags" />
                                                </div>


                                                <div class="form-group">
                                                    <label for="video">Video</label>
                                                    <input type="url" value="{{ old('video', $video->video) }}"
                                                        class="form-control" name="video" id="video"
                                                        placeholder="Enter url video ...">
                                                </div>

                                                <!-- time Picker -->
                                                <div class="form-group">
                                                    <label for="duration">Duration</label>
                                                    <input type="time" class="form-control" id="duration"
                                                        name="duration" value="{{ old('durtion', $video->duration) }}"
                                                        step="1">
                                                </div>
                                            </x-update-filter-modal>
                                            <h3 class="pt-2">
                                                {{ $video->title }}
                                            </h3>
                                            <ul class="list-inline projects">
                                                @foreach ($video->videoguest as $guest)
                                                    <li class="list-inline-item">
                                                        <img alt="Avatar" class="table-avatar"
                                                            style="height: 33px; width: 33px;"
                                                            src="{{ asset('storage/avatars/' . $guest->user->avatar) }}">
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="text">{{ $video->description }}.</p>
                                            <h5 class="pink-text text-right">
                                                {{ $video->duration }}</h5>
                                        </x-card-video>
                                    @endforeach

                                </div>
                            </div>
                            <!-- /.post -->


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">

                            @include('content.partial.forms.update')
                        </div>



                        <div class="tab-pane" id="settings">

                            <div class="form-group">
                                <button type="submit" data-toggle="modal" data-target="#delete_{{ $content->id }}"
                                    class="btn btn-danger w-50">Delete</button>
                            </div>

                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="quiz">

                            <div class="form-group text-right">
                                <a href="{{ route('quiz.show', Crypt::encrypt($content->id)) }}"
                                    class="btn btn-info w-25">Add Quiz</a>
                            </div>

                            @include('content.partial.sections.quiz')

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
@endsection
