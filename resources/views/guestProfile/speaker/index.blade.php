@extends('layouts.master')

@section('header')
    View Speakers Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('card-detail-content')
    <div class="row pb-3" style="row-gap: 10px;" id="resultUser">
        @foreach ($speakers as $speaker)
            <x-delete-modal :modelDeleteId="$speaker->id" :modelRouteDelete="route('profile.destroy', Crypt::encrypt($speaker->id))" />
            <div class="col-lg-4 col-md-6 col-sm-6 oldUser">
                <div class="text-center card-box bg-light">
                    <div class="member-card pb-4" >
                        <div class="thumb-lg member-thumb mx-auto p-5"  style="background-image: url('{{ asset('storage/cover/' . $speaker->cover) }}'); opacity: 1;">
                            <img src="{{ asset('storage/avatars/' . $speaker->avatar) }}" style="height: 89px;width: 89px; position: relative; top: 47px"
                                class="rounded-circle img-thumbnail" alt="profile-image">

                        </div>
                        <div class="">
                            <h4>{{ $speaker->firstName . ' ' . $speaker->lastName }}</h4>
                            <p class="text-muted">@ {{ $speaker->roles->first()->name }} <span>| </span><span><a
                                        href="#" class="text-pink">{{ $speaker->email }}</a></span></p>
                            <p class="p-2">{{ $speaker->biographie }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <a style="float: top;" href="{{ route('profile.edit', Crypt::encrypt($speaker->id)) }}"
                            class="btn btn-sm mb-2 bg-warning">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#delete_{{ $speaker->id }}"
                            class="btn btn-sm btn-danger mb-2 mr-2">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- end col -->
        @endforeach
    </div>
    <!-- end row -->
@endsection

@section('paginate-datail-card')
    {{ $speakers->links() }}
@endsection

@section('content')
    @include('components.detail-card')
@endsection
