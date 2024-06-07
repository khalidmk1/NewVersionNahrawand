@extends('layouts.master')

@section('header')
    Manage Categories Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th>Type</th>
                        <th>Created at</th>
                        <th>Client</th>
                        <th>Statu</th>
                        <th>Update at</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->TypeTicket }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $ticket->client->firstName . ' ' . $ticket->client->lastName }}</td>
                            <td><span class="tag tag-success">{{ $ticket->status == 1 ? 'Handled' : 'In Progress' }}
                                    {{-- <a href="{{ Route('dashboard.tickets.edite', Crypt::encrypt($ticket->id)) }}">
                                        <i class="fa fa-plus mt-1" aria-hidden="true"
                                            style="cursor: pointer ; float: right;"></i>
                                    </a> --}}
                                </span></td>
                            <td>{{ $ticket->manager->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->updated_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('components.jQuery')
    @include('components.spicific-script')
@endsection
