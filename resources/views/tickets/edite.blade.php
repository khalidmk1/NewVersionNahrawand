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
    <div class="card card-default">
        <form action="{{ route('ticket.update', Crypt::encrypt($ticket->id)) }}" method="post">
            @csrf
            @method('patch')
            <div class="card-header row justify-content-between">
                <div class="col-6">
                    <h3 class="card-title">Detail Ticket</h3>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Modifier</button>
                </div>
            </div>
            <!-- /.card-header -->


            <div class="card-body">
                <div class="row">

                    <div class="col-md-8 col-sm-12">
                        <div class="form-group row">
                            <label for="ticket" class="col-sm-2 col-form-label">Ticket Status</label>
                            <div class="col-sm-10">
                                <!-- select -->
                                <select class="form-control" id="ticket" name="status" style="height: 40px;">
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

                    <div class="col-md-4 col-sm-12">
                        <img src="{{ asset('storage/ticket/' . $ticket->file) }}" class="rounded float-right"
                            alt="ticket">
                    </div>

                    <div class="col-sm-12">
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control" name="detail" rows="3" placeholder="Enter ...">{{ $ticket->detail }}</textarea>
                        </div>
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
@endsection
