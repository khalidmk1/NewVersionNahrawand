@extends('layouts.master')

@section('header')
    View Managers Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('card-detail-content')
    <div class="row pb-3" style="row-gap: 10px;" id="resultUser">
        @foreach ($managers as $manager)
            <x-delete-modal :modelDeleteId="$manager->id" :modelRouteDelete="route('profile.destroy', Crypt::encrypt($manager->id))"  />
            <div class="col-lg-4 col-md-6 col-sm-6 oldUser">
                <div class="text-center card-box bg-light">
                    <div class="member-card pt-2 pb-2">
                        <div class="thumb-lg member-thumb mx-auto">
                            <img src="{{ asset('storage/avatars/' . $manager->avatar) }}" style="height: 89px;width: 89px;"
                                class="rounded-circle img-thumbnail" alt="profile-image">
                        </div>
                        <div class="">
                            <h4>{{ $manager->firstName . ' ' . $manager->lastName }}</h4>
                            <p class="text-muted">@ {{$manager->roles->first()->name}} <span>| </span><span><a href="#"
                                        class="text-pink">{{ $manager->email }}</a></span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <a style="float: top;" href="{{ route('profile.edit', Crypt::encrypt($manager->id)) }}"
                            class="btn btn-sm mb-2 bg-warning">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#delete_{{ $manager->id }}"
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
    {{ $managers->links() }}
@endsection

@section('content')
    @include('components.detail-card')
@endsection
