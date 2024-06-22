<!-- Modal -->
<div class="modal fade" id="{{ $itemId }}" tabindex="-1"
    aria-labelledby="exampleModalLabel_{{ $itemId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel_{{ $itemId }}">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{$imageUrl}}" class="img-fluid" alt="Responsive image">
            </div>

        </div>
    </div>
</div>
