@extends('layouts.master')

@section('header')
    Manage SubCategories Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection


@section('content')
    <x-create-filter-modal :titleModel="'Create Category'" :modelRouteCreate="route('subcategory.store')">
        <div class="form-group">
            <label>Category</label>
            <select name="categoryId" class="form-control select2" id="categorieselect" style="width: 100%;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="categorie">Name</label>
            <input value="{{ old('name') }}" type="text" class="form-control" id="category"
                placeholder="Entre SubCategory Name ..." name="name">
        </div>
    </x-create-filter-modal>


    <div class="row justify-content-center">

        <div class="col-12 mb-3 d-flex justify-content-end">
            <button type="button" data-toggle="modal" data-target="#Create-Filter-Modal"
                class="btn btn-block btn-default w-25">
                Create SubCategory
            </button>
        </div>

        <!-- /.col -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SubCategory</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" id="search_category" name="category" class="form-control float-right"
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
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Update</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody class="text-center" id="resultcategory">
                            @foreach ($subCategories as $subCategory)
                                <x-update-filter-modal :filterId="$subCategory->id" :titleModel="'Update SubCategory'" :modelRoute="route('subcategory.update', Crypt::encrypt($subCategory->id))">
                                    <div class="form-group">
                                        <label>Domain</label>
                                        <select name="categoryId" class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $subCategory->categoryId == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="categorie">Name</label>
                                        <input value="{{ old('name', $subCategory->name) }}" type="text"
                                            class="form-control" id="category" placeholder="Entre Category Name ..."
                                            name="name">
                                    </div>
                                </x-update-filter-modal>
                                <x-delete-modal :modelDeleteId="$subCategory->id" :modelRouteDelete="route('subcategory.destroy', Crypt::encrypt($subCategory->id))" />

                                <tr>
                                    <td>{{ $subCategory->id }}</td>
                                    <td>{{ $subCategory->category->name }}</td>
                                    <td>{{ $subCategory->name }}</td>
                                    <td>

                                        <a type="button" data-toggle="modal"
                                            data-target="#update_filter_model_{{ $subCategory->id }}"
                                            class="btn btn-sm bg-warning">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#delete_{{ $subCategory->id }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item">{{ $subCategories->links() }}</li>

                    </ul>
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->

    </div>
@endsection
