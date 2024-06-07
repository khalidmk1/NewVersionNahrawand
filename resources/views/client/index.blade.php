@extends('layouts.master')

@section('header')
    Edit Profile Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>first Name</th>
                        <th>last Name</th>
                        <th>Status</th>
                        <th>Subscription Date</th>
                        <th>Renewal Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->email}}</td>
                            <td>{{$client->firstName}}</td>
                            <td>{{$client->lastName}}</td>
                            <td>{{$client->status_matrimonial }}</td>
                            <td>{{$client->created_at}}</td>
                            <td>{{$client->updated_at}}</td>
                            <td>
                                <a class="btn btn-block btn-info"
                                    href="{{ route('client.show', Crypt::encrypt($client->id)) }}"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
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
