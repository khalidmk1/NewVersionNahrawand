@extends('layouts.master')

@section('header')
    Show Client Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('storage/avatars/' . $client->avatar) }}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $client->lastName . ' ' . $client->firstName }}</h3>

                    <p class="text-muted text-center">{{ $client->email }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        {{--   <li class="list-group-item">
                            <b>Nombre de Favoris</b> <a class="float-right">{{ $client->Favoris->count() }}</a>
                        </li> --}}
                        {{--  <li class="list-group-item">
                        <b>Number of Content </b> <a class="float-right">543</a>
                    </li> --}}

                    </ul>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fa fa-plus mr-1"></i> Registration date</strong>

                    <p class="text-muted">
                        {{ $client->created_at }}
                    </p>

                    <hr>

                    <strong><i class="fa fa-plug mr-1"></i>Activation date</strong>

                    <p class="text-muted">{{ $client->created_at }}</p>

                    <hr>

                    <strong><i class="fa fa-retweet mr-1" aria-hidden="true"></i> Renewal Date</strong>

                    <p class="text-muted">{{ $client->updated_at }}</p>




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
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Objectives /
                                Domain</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Statistic</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#quiz" data-toggle="tab">Quiz</a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            @foreach ($groupedByDomain as $domainName => $subcategories)
                                <div class="row">
                                    <!-- Domain Column -->
                                    <div class="col-md-4">
                                        <div class="card card-outline card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $domainName }}</h3>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-8">
                                        <!-- Subcategories Column -->
                                        <div class="row align-items-center" style="gap: 2px">
                                            @foreach ($subcategories as $subcategory)
                                                <h3><span
                                                        class="badge badge-secondary">{{ $subcategory->subCategory->name }}</span>
                                                </h3>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline item -->
                                <div>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">Ongoing Formation</h3>
                                        <div class="timeline-body">
                                            @foreach ($client->contentViews as $contentView)
                                                <div class="image-with-text">
                                                    <img src="{{ asset('storage/content/' . $contentView->content->image) }}"
                                                        alt="..." style="height: 141px">
                                                    <div class="image-text">{{ $contentView->content->title }}
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                            </div>


                            <div class="timeline timeline-inverse">
                                <!-- timeline item -->
                                <div>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header">Completed Formation</h3>

                                        <div class="timeline-body">
                                            @foreach ($client->contentFinished as $contentFinished)
                                                <div class="image-with-text">
                                                    <img src="{{ asset('storage/content/' . $contentFinished->content->image) }}"
                                                        alt="..." style="height: 141px">
                                                    <div class="image-text">
                                                        {{ $contentFinished->content->title }}
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->

                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="quiz">
                            @include('client.partial.quiz')
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

    @include('components.jQuery')

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".submitNote").change(function() {
                var noteId = $(this).data("id");
                var urlNote = '{{ route('note.store', ':noteId') }}'.replace(':noteId', noteId);
                var noteAnswer = $(this).is(":checked") ? "on" : "off";
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: urlNote,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    data: {
                        noteAnswer: noteAnswer,
                        _method: 'PUT' 
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });
        });
    </script>
@endsection
