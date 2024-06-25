<div class="row">
    @foreach ($content->quizzes as $quiz)
        <x-update-filter-modal :filterId="$quiz->id" :titleModel="'Update quiz'" :modelRoute="route('category.update', Crypt::encrypt($quiz->id))">
         
        </x-update-filter-modal>


        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header bg-light d-flex align-items-center justify-content-around">

                    <p class="m-0">{{ $quiz->question }}</p>

                    @php
                        $firstQuizParameter = $quiz->quizParameter->first();
                    @endphp

                    @if ($firstQuizParameter)
                        <h6 class="badge badge-secondary m-0">
                            {{ $firstQuizParameter->rate . '/' . $firstQuizParameter->count }}
                        </h6>
                    @endif

                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($quiz->answers as $Answer)
                        <li class="list-group-item">{{ $Answer->Answer }}</li>
                    @endforeach

                    <li class="list-group-item "> <button style="float: right;" class="btn btn-sm bg-warning "
                            data-toggle="modal" data-target="#update_Qsm_{{ $quiz->id }}">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>


                        <button type="button" data-toggle="modal" data-target="#delete_Qsm_video_{{ $quiz->id }}"
                            class="btn btn-sm btn-danger position-absolute" style="float: right">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        {{--   @include('Cours.update.formation.update.QsmModel') --}}

                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
