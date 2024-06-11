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

                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->
                        </form>



                    </div>


                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <form action="{{ route('ticket.comment.create', Crypt::encrypt($ticket->id)) }}" method="post"
                        class="form-horizontal">
                        @csrf
                        <div class="input-group input-group-sm mb-0">
                            <input class="form-control form-control-sm" name="comment" placeholder="Comment">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Comment</button>
                            </div>
                        </div>
                    </form>

                    @foreach ($ticket->comments as $comment)
                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm"
                                    src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" alt="User Image">
                                <span class="username">
                                    <a href="#">{{ $comment->user->firstName . ' ' . $comment->user->lastName }}</a>
                                    {{-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> --}}
                                </span>
                                <span class="description">Shared publicly -
                                    {{ Carbon\Carbon::parse($comment->update_at)->isoFormat('D MMMM YYYY à HH[h]mm') }}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                {{ $comment->comment }}
                            </p>

                        </div>
                        <!-- /.post -->
                    @endforeach



                    {{--  @foreach ($ticket->comments as $comment)
                            <div class="col-12"> <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" alt="user image">
                                        <span class="username">
                                            <a
                                                href="#">{{ $comment->user->firstName . ' ' . $comment->user->lastName }}</a>

                                        </span>
                                        <span class="description">Shared publicly -
                                            {{ Carbon\Carbon::parse($comment->update_at)->isoFormat('D MMMM YYYY à HH[h]mm') }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                                <!-- /.post -->
                            </div>
                        @endforeach --}}

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
