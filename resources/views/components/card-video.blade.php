<div class="col-12">
    <!-- Card -->
    <div class="card">
        <div class="row">
            <div class="col-6">
                <iframe class="embed-responsive-item w-100 h-100 rounded border-dark" src="{{ $videoUrl }}"
                    allowfullscreen></iframe>
            </div>
            <div class="col-6">
                <div class="text-white  m-2 " style="border-radius: 20px ; background: #343a4070 ">
                    <div class="position-relative ">
                        <button style="right: 0;" class="btn btn-sm bg-warning position-absolute"
                            data-toggle="modal" data-id="{{ $videoID }}"
                            data-target="#update_filter_model_{{ $videoID }}">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        
                        <button type="button" data-toggle="modal" data-target="#delete_{{ $videoID }}"
                            class="btn btn-sm btn-danger position-absolute" style="float: right">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>

                    </div>

                    <div class="card-body">
                        {{ $slot }}

                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->


    </div>
    <!-- Card -->
</div>
