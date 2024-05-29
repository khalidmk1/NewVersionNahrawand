<!-- Modal update -->
<div class="modal fade" id="update_filter_model_{{ $filterId }}" tabindex="-1" role="dialog"
    aria-labelledby="ModalLabel_{{ $filterId }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel_{{ $filterId }}">{{ $titleModel }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ $modelRoute }}">
                @csrf
                @method('patch')

                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
