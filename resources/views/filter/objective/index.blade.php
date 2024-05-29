@extends('layouts.master')

@section('header')
    Manage Objectives Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <x-create-filter-modal :titleModel="'Create Objective'" :modelRouteCreate="route('objective.store')">
        <div class="form-group">
            <label>Subcategory</label>
            <select class="select2" multiple="multiple" name="subCategoryIds[]" data-placeholder="Select a State"
                style="width: 100%;">
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}
                    </option>
                @endforeach

            </select>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="objective">Name</label>
            <input value="{{ old('name') }}" type="text" class="form-control" id="objective"
                placeholder="Entre Objective Name ..." name="name">
        </div>
    </x-create-filter-modal>

    <div class="row justify-content-center">

        <div class="col-12 mb-3 d-flex justify-content-end">
            <button type="button" data-toggle="modal" data-target="#Create-Filter-Modal"
                class="btn btn-block btn-default w-25">
                Create Objectives
            </button>
        </div>

        <!-- /.col -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Objectives</h3>


                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" id="search_goals" name="goal" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">

                        <thead>
                            <tr class="text-center">
                                <th style="width: 10px">#id</th>
                                <th>Subcategory</th>
                                <th>Objective</th>
                                <th>Edite</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody class="text-center" id="resultgoals">
                            @foreach ($objectives as $objective)
                                <x-update-filter-modal :filterId="$objective->id" :titleModel="'Update Objective'" :modelRoute="route('objective.update', Crypt::encrypt($objective->id))">
                                    <div class="form-group">
                                        <label>Subcategory</label>
                                        <select name="subCategoryIds[]" class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            @foreach ($subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}"
                                                    {{ $subCategory->id == $objective->subCategoryId ? 'selected' : '' }}>
                                                    {{ $subCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group">
                                        <label for="objective">Name</label>
                                        <input value="{{ old('name', $objective->name) }}" type="text"
                                            class="form-control" id="objective" placeholder="Entre Objective Name ..."
                                            name="name">
                                    </div>
                                </x-update-filter-modal>
                                <x-delete-modal :modelDeleteId="$objective->id" :modelRouteDelete="route('objective.destroy', Crypt::encrypt($objective->id))" />


                                <tr>
                                    <td>{{ $objective->id }}</td>
                                    <td>{{ $objective->subcategory->name }}</td>
                                    <td>{{ $objective->name }}</td>
                                    <td>

                                        <a type="button" data-toggle="modal"
                                            data-target="#update_filter_model_{{ $objective->id }}"
                                            class="btn btn-sm bg-warning">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td><a type="button" data-toggle="modal" data-target="#delete_{{ $objective->id }}"
                                            class="btn btn-sm bg-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a></td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                {{-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item">{{ $goals['goals']->links() }}</li>

                    </ul>
                </div> --}}
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->

    </div>
@endsection
