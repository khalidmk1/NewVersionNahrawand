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

                <div class="card-footer">


                    <div aria-label="Page navigation example d-flex" class=" d-flex "
                        style="flex-direction: column !important ; text-align: left">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($objectives->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $objectives->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($page = 1; $page <= $objectives->lastPage(); $page++)
                                @if ($page == $objectives->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}
                                            <span class="sr-only">(current)</span></a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $objectives->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($objectives->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $objectives->nextPageUrl() }}">Next</a>
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

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
