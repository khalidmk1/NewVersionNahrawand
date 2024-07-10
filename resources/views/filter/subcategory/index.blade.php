@extends('layouts.master')

@section('header')
    Manage SubCategories Page
@endsection

@section('page')
    View SubCategories
@endsection

@section('link')
    {{ route('subcategory.index') }}
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
                            <input type="text" id="search_filter" name="category" class="form-control float-right"
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
                        <tbody class="text-center" id="result">
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
                                <x-delete-modal :modelDeleteId="'subCategory_'.$subCategory->id"  :modelTitle="'Delete SubCategory'" :modelRouteDelete="route('subcategory.destroy', Crypt::encrypt($subCategory->id))" />

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
                                            data-target="#delete_subCategory_{{ $subCategory->id }}" class="btn btn-sm btn-danger">
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
                            @if ($subCategories->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $subCategories->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($page = 1; $page <= $subCategories->lastPage(); $page++)
                                @if ($page == $subCategories->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}
                                            <span class="sr-only">(current)</span></a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $subCategories->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($subCategories->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $subCategories->nextPageUrl() }}">Next</a>
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

    @include('components.jQuery')
@endsection
