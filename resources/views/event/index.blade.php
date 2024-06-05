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
            <h3 class="card-title">View Content</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3  event_conatine " id="resultcours">
                @foreach ($events as $event)
                    <div class="col ">

                        <div class="card">
                            <div class="position-relative">
                                <img src="{{ asset('storage/event/' . $event->image) }}" class="card-img-top about_img"
                                    alt="Skyscrapers" />
                            </div>

                            <div class="card-body">
                                <h2 class="card-title"> {{ $event->title }}</h2>
                                <p class="card-text">{{ Str::limit($event->description, '100', '...') }}</p>
                                <a href="{{ route('event.show', Crypt::encrypt($event->id)) }}"
                                    class="btn btn-primary">Detail</a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>



            <div class="card-footer">


                <div aria-label="Page navigation example d-flex" class=" d-flex " style="flex-direction: column !important">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($events->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $events->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @for ($page = 1; $page <= $events->lastPage(); $page++)
                            @if ($page == $events->currentPage())
                                <li class="page-item active"><a class="page-link" href="#">{{ $page }} <span
                                            class="sr-only">(current)</span></a></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $events->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($events->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $events->nextPageUrl() }}">Next</a>
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
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
