@extends('layouts.master')



@include('RolePermission.create')

@section('header')
    Manage Role Page
@endsection

@section('page')
    View Role
@endsection

@section('link')
    {{ Route('role.index') }}
@endsection


@section('content')
    <div class="position-relative" style="overflow: hidden">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card card-position">
                    <div class="card-header">
                        <h3 class="card-title">
                            <button class="btn btn-block btn-default" data-toggle="modal"
                                data-target="#single-generic-model">Create
                                Role</button>
                        </h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="search_role" name="role" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 440px;">
                        <table class="table table-head-fixed text-nowrap position-relative" id="searchedRole">
                            <thead>
                                <tr>
                                    <th class="text-center">Roles</th>

                                    @foreach ($permissions as $permission)
                                        <th class="text-center">{{ $permission->name }} </th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody id="searchedRole">
                                @foreach ($roles as $role)
                                    <tr class="text-center">
                                        <td>{{ $role->name }}</td>
                                        @foreach ($permissions as $permission)
                                            <td class="text-center">
                                                <form class="make_permission">
                                                    @csrf
                                                    <div class="icheck-primary d-inline">
                                                        @php
                                                            // Check if the role has the permission
                                                            $isChecked =
                                                                isset($roleHasPermission[$role->id]) &&
                                                                $roleHasPermission[$role->id]->contains(
                                                                    'permission_id',
                                                                    $permission->id,
                                                                );
                                                        @endphp

                                                        <input type="checkbox" class="checkbox make_permission"
                                                            data-roleId="{{ $role->id }}"  {{ $isChecked ? 'checked' : '' }}
                                                            data-permissionId="{{ $permission->id }}"
                                                            id="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                                                        <label
                                                            for="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                                                        </label>

                                                    </div>
                                                </form>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    @include('components.jQuery')
    @include('RolePermission.script')
@endsection
