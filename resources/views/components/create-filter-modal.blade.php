<!-- Modal Create -->
<div class="modal fade" id="Create-Filter-Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ $titleModel }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ $modelRouteCreate }}" method="post">
                @csrf

                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary w-25">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
