@extends('layouts.master')

@section('header')
    Manage Ticket Page
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
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Ticket</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Comments</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <div class="card card-default">
                        <form action="{{ route('ticket.update', Crypt::encrypt($ticket->id)) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-header row justify-content-between">
                                <div class="col-6">
                                    <h3 class="card-title">Detail Ticket</h3>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-block btn-warning w-25 "
                                        style="float: right">Modifier</button>
                                </div>
                            </div>
                            <!-- /.card-header -->


                            <div class="card-body">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-8">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="ticket" class="col-sm-2 col-form-label">Ticket
                                                        Status</label>
                                                    <div class="col-sm-10">
                                                        <!-- select -->
                                                        <select class="form-control" id="ticket" name="status"
                                                            style="height: 40px;">
                                                            @if ($ticket->status == 1)
                                                                <option selected value="1">Handled</option>
                                                                <option value="0">In Progress</option>
                                                            @else
                                                                <option value="1">Handled</option>
                                                                <option selected value="0">In Progress</option>
                                                            @endif


                                                        </select>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-12">
                                                <!-- textarea -->
                                                <div class="form-group">
                                                    <label>Detail</label>
                                                    <textarea class="form-control" name="detail" rows="3" placeholder="Enter ...">{{ $ticket->detail }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4"> <img src="{{ asset('storage/ticket/' . $ticket->file) }}"
                                                class="img-fluid" alt="ticket"></div>
                                    </div>


                                    {{--    <div class="col-sm-12" id="Commentcontain">
                                        <!-- textarea -->
                                        <div class="form-group position-relative">
                                            <input type="text" name="comment"
                                                value="{{ old('comment', optional($personnaleTicket)->comment) }}" class="form-control"
                                                placeholder="Enter ...">
                
                                        </div>
                                    </div> --}}

                                    {{--    @foreach ($outhertickets as $outherticket)
                                        <div class="col-12"> <!-- Post -->
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('storage/avatars/' . $outherticket->user->avatar) }}"
                                                        alt="user image">
                                                    <span class="username">
                                                        <a
                                                            href="#">{{ $outherticket->user->firstName . ' ' . $outherticket->user->lastName }}</a>
                
                                                    </span>
                                                    <span class="description">Shared publicly -
                                                        {{ Carbon\Carbon::parse($outherticket->update_at)->isoFormat('D MMMM YYYY à HH[h]mm') }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    {{ $outherticket->comment }}
                                                </p>
                
                
                
                                            </div>
                                            <!-- /.post -->
                                        </div>
                                    @endforeach --}}

                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->
                        </form>

                        {{-- <form action="{{ route('dashboard.comment.ticket.store', Crypt::encrypt($ticket->id)) }}" method="post">
                            @csrf
                            <input class="form-control form-control-sm m-2" name="comment" style="width: 98%;" type="text"
                                placeholder="Enter Comment">
                        </form> --}}

                    </div>


                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-danger">
                                10 Feb. 2014
                            </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-primary"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-user bg-info"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your
                                    friend request
                                </h3>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-comments bg-warning"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-success">
                                3 Jan. 2014
                            </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
