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
    <x-create-filter-modal :titleModel="'Create Category'" :modelRouteCreate="route('category.store')">
        <div class="form-group">
            <label>Domain</label>
            <select name="domainId" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                style="width: 100%;">
                @foreach ($domains as $domain)
                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="categorie">Name</label>
            <input value="{{ old('name') }}" type="text" class="form-control" id="category"
                placeholder="Entre Category Name ..." name="name">
        </div>
    </x-create-filter-modal>


    <div class="row justify-content-center">

        <div class="col-12 mb-3 d-flex justify-content-end">
            <button type="button" data-toggle="modal" data-target="#Create-Filter-Modal"
                class="btn btn-block btn-default w-25">
                Create Category
            </button>
        </div>

        <!-- /.col -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>

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
                                <th>Domain</th>
                                <th>Category</th>
                                <th>Update</th>
                                <th>Delete</th>

                            </tr>
                        </thead>

                        <tbody class="text-center" id="resultcategory">
                            @foreach ($categories as $category)
                                <x-update-filter-modal :filterId="$category->id" :titleModel="'Update Category'" :modelRoute="route('category.update', Crypt::encrypt($category->id))">
                                    <div class="form-group">
                                        <label>Domain</label>
                                        <select name="domainId" class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            @foreach ($domains as $domain)
                                                <option value="{{ $domain->id }}"
                                                    {{ $category->domainId == $domain->id ? 'selected' : '' }}>
                                                    {{ $domain->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="categorie">Name</label>
                                        <input value="{{ old('name', $category->name) }}" type="text"
                                            class="form-control" id="category" placeholder="Entre Category Name ..."
                                            name="name">
                                    </div>
                                </x-update-filter-modal>
                                <x-delete-modal :modelDeleteId="$category->id" :modelRouteDelete="route('category.destroy', Crypt::encrypt($category->id))" />

                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->domain->name }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>

                                        <a type="button" data-toggle="modal"
                                            data-target="#update_filter_model_{{ $category->id }}"
                                            class="btn btn-sm bg-warning">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#delete_{{ $category->id }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->


                <div class="card-footer">


                    <div aria-label="Page navigation example d-flex" class=" d-flex "
                        style="flex-direction: column !important ; text-align: left">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($categories->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($page = 1; $page <= $categories->lastPage(); $page++)
                                @if ($page == $categories->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}
                                            <span class="sr-only">(current)</span></a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $categories->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($categories->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            @endif
                        </ul>
                        </nav>




                    </div>
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->

    </div>
@endsection
