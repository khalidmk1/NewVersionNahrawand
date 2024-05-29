{{-- <div class="modal fade" id="delete-modal-{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $id }}">Delete {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete?
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password-{{ $id }}"
                            placeholder="Enter password ...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


{{-- @foreach ($videos as $video)
    <x-delete-modal :id="$video->id" :title="$video->title" :action="route('videos.destroy', $video->id)" />
@endforeach --}}


<!-- Modal -->
<div class="modal fade" id="single-generic-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GenericModalLabel">@yield('model-title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @yield('model-content')
        </div>
    </div>
</div>
