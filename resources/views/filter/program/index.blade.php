@extends('layouts.master')

@section('header')
    Manage Programs Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
    <x-create-filter-modal :titleModel="'Create Program'" :modelRouteCreate="route('program.store')">

        <div class="form-group">
            <label for="title"> Title</label>
            <input value="{{ old('title') }}" type="text" class="form-control" id="title" placeholder="Entre Title ..."
                name="title">
        </div>

        <div class="form-group">
            <label for="Description"> Description</label>
            <textarea class="form-control" id="Description" name="description" rows="3" placeholder="Entre Description ..."></textarea>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" name="tags[]" id="tags-input" />
        </div>

        <div class="form-group">
            <label>Category</label>
            <select class="select2" multiple="multiple" name="categoryId[]" data-placeholder="Select a State"
                style="width: 100%;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>
        <!-- /.form-group -->
    </x-create-filter-modal>





    <div class="row">
        <div class="col-12">


            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <button type="button" data-toggle="modal" data-target="#Create-Filter-Modal"
                            class="btn btn-block btn-default w-25 position-absolute" style="z-index: 1000">
                            Create Program
                        </button>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th>Category</th>
                                <th>Edite</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <x-delete-modal :modelDeleteId="$program->id" :modelRouteDelete="route('program.destroy', Crypt::encrypt($program->id))" />
                                <x-update-filter-modal :filterId="$program->id" :titleModel="'Update Program'" :modelRoute="route('program.update', Crypt::encrypt($program->id))">
                                    <div class="form-group">
                                        <label for="title_{{ $program->id }}"> Title</label>
                                        <input value="{{ old('title', $program->title) }}" type="text"
                                            class="form-control" id="title_{{ $program->id }}"
                                            placeholder="Entre Title ..." name="title">
                                    </div>

                                    <div class="form-group">
                                        <label for="Description_{{ $program->id }}"> Description</label>
                                        <textarea class="form-control" id="Description_{{ $program->id }}" name="description" rows="3"
                                            placeholder="Entre Description ...">{{ $program->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags_{{ $program->id }}">Tags</label>
                                        <input type="text" class="form-control" name="tags[]"
                                            id="tag-input_{{ $program->id }}" data-id="{{ $program->id }}"
                                            value="@foreach ($program->tags as $tag){{ $tag->name }}@if (!$loop->last),@endif @endforeach" />
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="select2" multiple="multiple" name="categoryId[]"
                                            data-placeholder="Select a Category" style="width: 100%;">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $program->programcategory->pluck('categoryId')->contains($category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->

                                </x-update-filter-modal>

                                <tr class="text-center">
                                    <td>{{ $program->title }}</td>
                                    <td> <button class="btn btn-app" style="border: none" data-toggle="modal"
                                            data-target="#description">
                                            <i class="fa fa-plus mt-1" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>


                                        <h5>
                                            @foreach ($program->tags as $tag)
                                                <span class="badge badge-secondary">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </h5>

                                    </td>
                                    <td>
                                        <h5>
                                            @foreach ($program->programcategory as $category)
                                                <span class="badge badge-secondary">
                                                    {{ $category->category->name }}
                                                </span>
                                            @endforeach
                                        </h5>
                                    </td>
                                    <td><a type="button" data-toggle="modal"
                                            data-target="#update_filter_model_{{ $program->id }}"
                                            class="btn btn-sm bg-warning">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a></td>
                                    <td><a type="button" data-toggle="modal" data-target="#delete_{{ $program->id }}"
                                            class="btn btn-sm bg-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a></td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    @include('components.jQuery')

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

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


    <script>
        $(document).ready(function() {
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();
        });

        $(document).ready(function() {
            @foreach ($programs as $program)
                var tagInputEle_update = $('#tag-input_{{ $program->id }}');
                tagInputEle_update.tagsinput();
            @endforeach
        });
    </script>
@endsection
