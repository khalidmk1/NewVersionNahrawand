@extends('layouts.master')

@section('header')
    View Map Page
@endsection

@section('page')
    View Maps
@endsection

@section('link')
    {{ route('map.index') }}
@endsection



@section('content')
    <x-delete-modal :modelDeleteId="'map_' . $map->id" :modelTitle="'Delete map'" :modelRouteDelete="route('map.destroy', Crypt::encrypt($map->id))" />
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">
                        {{ $map->founder }}</h3>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail</a></li>
                        @can('viewEditeContent')
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Edite</a>
                            </li>
                        @endcan
                        @can('viewDeleteContent')
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Setting</a>
                            </li>
                        @endcan

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="row align-items-center ">
                                    <div class="col-md-9 col-sm-12">
                                        <h1 class="username ">
                                            <div>{{ $map->title }}</div>
                                            <p class="font-weight-light" style="font-size: 17px;">{{ $map->slogan }}</p>

                                        </h1>
                                    </div>
                                </div>
                                <!-- /.user-block -->

                                <div class="row mb-3">
                                    <div class="row mb-3 text-center">
                                        <div class="col-sm-12">
                                            <img class="img-fluid" src="{{ asset('storage/' . $map->image) }}"
                                                alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-12">
                                            <section class="slid-containe container">
                                                <div class="swiper mySwiper">
                                                    <div class="swiper-wrapper content">
                                                        @foreach ($map->images as $picture)
                                                            @if ($picture->type == 'image')
                                                                <div class="swiper-slide card-event slider-image"
                                                                    style="background-image: url('{{ asset('storage/' . $picture->image) }}'); height: 275px;
                                                                           ">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <!-- Add Navigation -->
                                                    <div class="swiper-button-next"></div>
                                                    <div class="swiper-button-prev"></div>
                                                    <!-- Add Pagination -->
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                            </section>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.row -->


                                <!-- /.row -->
                            </div>
                            <!-- /.post -->
                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>Description.</strong></div>

                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $map->description }}
                                </p>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>Date of Establishment .</strong></div>

                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $map->date }}
                                </p>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>food .</strong></div>
                                </div>
                                <!-- /.user-block -->
                                <section class="slid-containe container">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper content">
                                            @foreach ($map->images as $picture)
                                                @if ($picture->type == 'plate')
                                                    <div class="swiper-slide card-event slider-image"
                                                        style="background-image: url('{{ asset('storage/' . $picture->image) }}'); height: 275px;
                                                               ">
                                                        <p class="text-slider">{{ $picture->description }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!-- Add Navigation -->
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </section>

                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="d-flex">
                                    <i class="fa fa-exclamation-circle" style="font-size: x-large" aria-hidden="true"></i>
                                    <div class="ml-2"><strong>clothes .</strong></div>
                                </div>
                                <!-- /.user-block -->
                                <section class="slid-containe container">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper content">
                                            @foreach ($map->images as $picture)
                                                @if ($picture->type == 'clothe')
                                                    <div class="swiper-slide card-event slider-image"
                                                        style="background-image: url('{{ asset('storage/' . $picture->image) }}'); ">
                                                        <p class="text-slider">{{ $picture->description }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!-- Add Navigation -->
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </section>

                            </div>
                            <!-- /.post -->


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            @include('maps.partial.updateForm')
                        </div>



                        <div class="tab-pane" id="settings">
                            <div class="form-group">
                                <button type="submit" data-toggle="modal"
                                    data-target="#delete_map_{{ $map->id }}"
                                    class="btn btn-danger w-50">Delete</button>
                            </div>

                        </div>


                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
