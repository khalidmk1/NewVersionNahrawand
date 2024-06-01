{{-- --}}
@extends('layouts.master')
@section('header')
    Content Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Content</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Quickly</a>
                </li>

            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">


                    <div class="row row-cols-1 row-cols-md-3  event_conatine " id="resultcours">
                        @foreach ($contents as $content)
                            <div class="col ">

                                <div class="card">
                                    <div class="position-relative">
                                        <h5
                                            class="position-absolute badge {{ $content->isActive ? 'badge-success' : '' }} ">
                                            {{ $content->isActive ? 'Active' : '' }}</h5>
                                        <h5 class="position-absolute badge {{ $content->isComing ? 'badge-warning' : '' }}"
                                            style="right: 0">
                                            {{ $content->isComing ? 'A Venir' : '' }}</h5>

                                        <img src="{{ asset('storage/content/' . $content->image) }}"
                                            class="card-img-top about_img" alt="Skyscrapers" />

                                    </div>

                                    <div class="card-body">
                                        <h2 class="card-title"> {{ $content->title }}</h2>
                                        <p class="card-text">{{ Str::limit($content->smallDescription, '100', '...') }}</p>
                                        <a href="{{ route('content.show', Crypt::encrypt($content->id)) }}"
                                            class="btn btn-primary">Detail</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.post -->

                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    fdfsdfsdfs
                    {{--  @include('content.partial.forms.update') --}}
                </div>
            </div>



            <div class="card-footer">


                <div aria-label="Page navigation example d-flex" class=" d-flex " style="flex-direction: column !important">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($contents->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $contents->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @for ($page = 1; $page <= $contents->lastPage(); $page++)
                            @if ($page == $contents->currentPage())
                                <li class="page-item active"><a class="page-link" href="#">{{ $page }} <span
                                            class="sr-only">(current)</span></a></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $contents->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($contents->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $contents->nextPageUrl() }}">Next</a>
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
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
