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
                            <td>{{$cl}}</td>
                            <td>Internet
                                Explorer 4.0
                            </td>
                            <td>Win 95+</td>
                            <td> 4</td>
                            <td>X</td>
                        </tr>
                    @endforeach




                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
