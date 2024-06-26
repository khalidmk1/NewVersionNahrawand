<div class="row">
    @foreach ($content->quizzes as $quizIndex => $quiz)
        <x-delete-modal :modelDeleteId="$quiz->id" :modelTitle="'Delete Quiz'" :modelRouteDelete="route('quiz.destroy', Crypt::encrypt($quiz->id))" />
        @php
            $firstQuizParameter = $quiz->quizParameter->first();

        @endphp


        <x-update-filter-modal :filterId="$quiz->id" :titleModel="'Update quiz'" :modelRoute="route('quiz.update', Crypt::encrypt($quiz->id))">

            <div class="form-group question">
                <label for="Question">Question</label>
                <input type="text" value="{{ old('question', $quiz->question) }}" class="form-control question_text "
                    name="question" id="Question_{{ $quiz->id }}" placeholder="Entrez Question ...">
            </div>


            @if ($content->quizType == 0)
                {{--  <div class="d-flex justify-content-around align-items-center" style="gap: 35px" id="addsection">
                    <div class="form-group row">
                        <label for="Rate">Success Rate</label>
                        <input type="text"
                            value="{{ old('rate.' . $quiz->id, optional($firstQuizParameter)->rate) }}"
                            class="form-control" required name="rate" id="Rate_{{ $quiz->id }}"
                            placeholder="Enter Rate ...">
                    </div>
                    <div class="form-group row">
                        <label for="count">How many to send?</label>
                        <input type="text"
                            value="{{ old('count.' . $quiz->id, optional($firstQuizParameter)->count) }}"
                            class="form-control" required name="count" id="count_{{ $quiz->id }}"
                            placeholder="Enter Count ...">
                    </div>
                </div> --}}


                @foreach ($quiz->answers as $index => $Answer)
                    <div class="form-group reponse">
                        @if ($index === 0)
                            <label for="Awnser_{{ $Answer->id }}" class="answer_label">Correct Answer</label>
                        @else
                            <label for="Awnser_{{ $Answer->id }}" class="answer_label">Response
                                {{ $index }}</label>
                        @endif
                        <div class="position-relative">
                            <input name="answer[]" type="text" value="{{ old('answer.' . $index, $Answer->Answer) }}"
                                class="form-control response" id="Awnser_{{ $Answer->id }}"
                                aria-label="Text input with checkbox">
                        </div>
                    </div>
                @endforeach

                <div id="container-{{ $quiz->id }}" data-index="{{ count($quiz->answers) }}">
                    <button type="button" class="btn btn-primary addBtn" data-quiz-id="{{ $quiz->id }}"
                        data-quiz-index="{{ $quizIndex }}">Add Response</button>
                </div>
            @endif



        </x-update-filter-modal>


        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header bg-light d-flex align-items-center justify-content-around">

                    <p class="m-0" style="max-width: 243px;">{{ $quiz->question }}</p>

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


                        <button type="button" data-toggle="modal" data-target="#delete_{{ $quiz->id }}"
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
