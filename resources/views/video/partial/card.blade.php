@foreach ($videos as $video)
    <div class="position-absolute">
        <x-delete-modal :modelDeleteId="$video->id" :modelRouteDelete="route('delete.video', Crypt::encrypt($video->id))" />
    </div>

    <div class="col mb-4 ">
        <!-- Card -->
        <div class="card card-image ui_delete"
            style="background-image: url('{{ asset('storage/video/' . $video->image) }}'); opacity: 1;">
            <button type="button" data-toggle="modal" data-target="#delete_{{ $video->id }}"
                style="right: 6px; top: 4px;" class="btn btn-sm btn-danger position-absolute">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>


            <!-- Content -->
            <div class="text-white  d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4 m-3 "
                style="border-radius: 20px ; background: #343a4057">
                <div class="row" style="max-width: 359px;">
                    <div class="col-12">
                        <h3 class="card-title pt-2 "><strong>{{ $video->title }}</strong></h3>
                    </div>
                    <div class="col-12 ">
                        <p class="">{{ $video->description }}.</p>
                    </div>
                    <div class="col-12">
                        <h5 class="pink-text text-right">{{ $video->duration }}</h5>
                    </div>
                </div>
            </div>

        </div>
        <!-- Card -->
    </div>
@endforeach
