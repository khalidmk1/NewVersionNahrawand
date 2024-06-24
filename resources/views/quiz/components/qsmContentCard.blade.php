@foreach ($content->quizzes as $Qsm)
    <div class="col-3">
        <div class="card QSM_Quiz" style="width: 18rem;" data-id="{{$Qsm->id}}">
            <div class="card-header">
                {{ $Qsm->question }}
            </div>
            <form action="" method="post">
                @csrf
              {{--   @method('Delete') --}}
                <button type="submit" class="btn btn-sm btn-danger position-absolute" style="right: 6px; top: 4px;">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
            <ul class="list-group list-group-flush">
                @foreach ($Qsm->answers as $Answer)
                    <li class="list-group-item">{{ $Answer->Answer }}</li>
                @endforeach

            </ul>
        </div>
    </div>
@endforeach