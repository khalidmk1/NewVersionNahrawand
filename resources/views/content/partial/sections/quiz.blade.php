<div class="row">
    @foreach ($content->quizzes as $quiz)
        @php
            $firstQuizParameter = $quiz->quizParameter->first();
        @endphp
        <x-update-filter-modal :filterId="$quiz->id" :titleModel="'Update quiz'" :modelRoute="route('category.update', Crypt::encrypt($quiz->id))">

            <div class="form-group question">
                <label for="Question">Question</label>
                <input type="text" value="{{ old('question', $quiz->question) }}" class="form-control question_text "
                    name="Question" id="Question" placeholder="Entrez Question ...">
            </div>

            @if ($content->quizType == 0)
                <div class="form-group">
                    <label for="RightAwnser">The correct answer</label>
                    <input type="text" value="{{ old('rightAwnser', $firstQuizParameter->rightAnswer->Answer) }}"
                        class="form-control" required name="rightAwnser" id="RightAwnser"
                        placeholder="Enter The correct answer ...">
                </div>

                <div class="d-flex justify-content-around  align-items-center" style="gap: 35px" id="addsection">

                    <div class="form-group row">
                        <label for="Rate">Sccess Rate</label>
                        <input type="text" value="{{ old('rate', $firstQuizParameter->rate) }}" class="form-control"
                            required name="rate" id="Rate" placeholder="Entrez Rate ...">
                    </div>
                    <div class="form-group row">
                        <label for="count">How many to send?</label>
                        <input type="text" value="{{ old('count', $firstQuizParameter->count) }}"
                            class="form-control" required name="count" id="count"
                            placeholder="Entrez la bonne réponse ...">
                    </div>
                </div>


                @foreach ($quiz->answers as $index => $Answer)
                    <div class="form-group reponse">
                        <label for="awnser_${index}" class="answer_label">Response {{ $index + 2 }}</label>
                        <div class="position-relative">
                            <input name="awnser[]" type="text" value="{{ old('Answer', $Answer) }}"
                                class="form-control response" required id="Awnser_${index}"
                                aria-label="Text input with checkbox">

                        </div>
                    </div>
                @endforeach
            @endif




        </x-update-filter-modal>


        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header bg-light d-flex align-items-center justify-content-around">

                    <p class="m-0">{{ $quiz->question }}</p>

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
                            data-toggle="modal" data-target="#update_filter_model_{{ $quiz->id }}">
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
