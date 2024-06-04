{{-- --}}
@extends('layouts.master')
@section('header')
    Content Quickly Page
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

        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3  event_conatine " id="resultcours">
                @foreach ($Quicklys as $Quickly)
                    <div class="col ">

                        <div class="card">
                            <div class="position-relative">
                                <h5 class="position-absolute badge {{ $Quickly->isActive ? 'badge-success' : '' }} ">
                                    {{ $Quickly->isActive ? 'Active' : '' }}</h5>
                                <h5 class="position-absolute badge {{ $Quickly->isComing ? 'badge-warning' : '' }}"
                                    style="right: 0">
                                    {{ $Quickly->isComing ? 'A Venir' : '' }}</h5>

                                <img src="{{ asset('storage/content/' . $Quickly->image) }}" class="card-img-top about_img"
                                    alt="Skyscrapers" />

                            </div>

                            <div class="card-body">
                                <h2 class="card-title"> {{ $Quickly->title }}</h2>
                                <p class="card-text">{{ Str::limit($Quickly->smallDescription, '100', '...') }}</p>
                                <a href="{{ route('content.show', Crypt::encrypt($Quickly->id)) }}"
                                    class="btn btn-primary">Detail</a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>


        </div>
        <!-- /.tab-content -->
        <div class="card-footer">


            <div aria-label="Page navigation example d-flex" class=" d-flex " style="flex-direction: column !important">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($Quicklys->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $Quicklys->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($page = 1; $page <= $Quicklys->lastPage(); $page++)
                        @if ($page == $Quicklys->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}
                                    <span class="sr-only">(current)</span></a></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $Quicklys->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($Quicklys->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $Quicklys->nextPageUrl() }}">Next</a>
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

    </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
