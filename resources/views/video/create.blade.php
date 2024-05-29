@extends('layouts.master')


@section('header')
    Create videos Page
@endsection

@section('page')
    View content
@endsection

@section('link')
    {{ route('content.index') }}
@endsection

@section('content')
    <div class="row">
        <div class="card card-default col-12">
            <div class="card-header row">
                <div class="col-6">
                    <h3 class="card-title">Create Video</h3>
                </div>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('video.store') }}" id="create_videos" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <input hidden type="text" name="podcastId" value="{{ $content->id }}">

                    <div class="form-group">
                        <label for="titleVideo">Title</label>
                        <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                            id="titleVideo" placeholder="Entrez Title ...">
                    </div>

                    <div class="form-group clearfix text-center col-4">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="isComing" id="iscoming">
                            <label for="iscoming">
                                Coming Soon
                            </label>
                        </div>

                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image2">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image2">
                            <label class="custom-file-label" for="image2">Upload</label>
                        </div>
                    </div>

                    @if ($content->contentType == 'podcast')
                        <div class="form-group">
                            <label for="guestInvite">Invité(s)</label>
                            <select class="select3" name="guestIds[]" multiple="multiple" id="guestInvite"
                                data-placeholder="Select a State" style="width: 100%;">
                                @foreach ($inviteUsers as $inviteUser)
                                    <option value="{{ $inviteUser->id }}">{{ $inviteUser->email }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!-- /.form-group -->
                    @elseif($content->contentType == 'conference')
                        <div class="form-group">
                            <label for="guestConference">Conférencies</label>
                            <select class="select3" name="guestIds[]" multiple="multiple" id="guestConference"
                                data-placeholder="Select a State" style="width: 100%;">
                                @foreach ($conferencerUsers as $conferencerUser)
                                    <option value="{{ $conferencerUser->id }}">{{ $conferencerUser->email }}</option>
                                @endforeach

                            </select>
                        </div>
                        <!-- /.form-group -->
                    @else
                    @endif


                    <div class="form-group">
                        <label for="tags_video">Tags</label>
                        <input type="text" class="form-control" name="tags[]" id="tags-input" />
                    </div>

                    <div class="form-group">
                        <label for="video">Video</label>
                        <input type="url" value="{{ old('video') }}" class="form-control" name="video" id="video"
                            placeholder="Enter url video ...">
                    </div>

                    <!-- time Picker -->
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="time" class="form-control" id="duration" name="duration" value="00:00:00"
                            step="1">
                    </div>

                </div>

                <button type="submit" class="btn btn-block btn-dark w-50 mb-3 ml-3">Create</button>
            </form>

            <div class="row row-cols-1 row-cols-md-3 position-relative">

                @include('video.partial.card')

            </div>


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
