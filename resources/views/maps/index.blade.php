@extends('layouts.master')

@section('header')
    Map Page
@endsection

@section('page')
    View Maps
@endsection

@section('link')
    {{ route('map.index') }}
@endsection

@section('content')
<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400&display=swap" rel="stylesheet">

<style>
.card-bg {
    position: relative;
    background-size: cover;
    background-position: center;
    height: 300px;
    color: white;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}
.card-bg-overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(44, 43, 43, 0.5); 
    display: flex;
    justify-content: center;
    align-items: center;
}


.card-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    margin: 0;
}
.card-text {
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    margin-top: 10px;
}
</style>

<div class="row">
    <div class="card card-default col-12">
        <div class="card-header row">
            <div class="col-6">
                <h3 class="card-title">Maps.</h3>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                @foreach ($maps as $map)
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card bg-dark text-center">
                        <div class="card-bg" style="background-image: url('{{ asset('storage/' . $map->image) }}');">
                            <a href="{{route('map.show' , Crypt::encrypt($map->id))}}">
                                <div class="card-bg-overlay">
                                    <div class="card-content  text-center">
                                        <h3 class="card-title text-white">{{ $map->title }}</h3>
                                        <p class="card-text text-dark">{{ $map->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        
        <div class="card-footer">


            <div aria-label="Page navigation example d-flex" class=" d-flex " style="flex-direction: column !important">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($maps->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $maps->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($page = 1; $page <= $maps->lastPage(); $page++)
                        @if ($page == $maps->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }} <span
                                        class="sr-only">(current)</span></a></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $maps->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($maps->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $maps->nextPageUrl() }}">Next</a>
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
    </div>
</div>
@endsection
