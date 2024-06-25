<div class="modal fade" id="delete_{{ $modelDeleteId }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ $modelTitle }}</h5>
            </div>
            <form action="{{ $modelRouteDelete }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    Are you sure you want to delete?
                    <div class="form-group mt-3">
                        <input type="password" class="form-control" id="password{{ $modelDeleteId }}"
                            placeholder="Enter your password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
