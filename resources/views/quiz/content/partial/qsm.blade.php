<form action="{{ route('quiz.content.store', Crypt::encrypt($content->id)) }}" id="create_quiz" method="post">
    @csrf

    <input type="text" hidden name="Qsm">

    <div class="form-group question">
        <label for="Question">Question</label>
        <input type="text" class="form-control question_text " name="question" id="Question"
            placeholder="Enter Question ...">
    </div>

    <div class="form-group">
        <label for="RightAwnser">The correct answer</label>
        <input type="text" value="{{ old('rightAwnser') }}" class="form-control" name="rightAwnser" id="RightAwnser"
            placeholder="Enter The correct answer ...">
    </div>

    @php
        $firstAnswerParam = $content->answersParametre->first();
    @endphp

    <div class="d-flex justify-content-around align-items-center" id="addsection">
        @if (!$firstAnswerParam)
            <div class="form-group row">
                <label for="Rate">Success Rate</label>
                <input type="text" value="{{ old('rate') }}" class="form-control" name="rate" id="Rate"
                    placeholder="Enter Success Rate ...">
            </div>
            <div class="form-group row">
                <label for="count">How many to send?</label>
                <input type="text" value="{{ old('count') }}" class="form-control" name="count" id="count"
                    placeholder="Enter ...">
            </div>
        @else
            <input type="hidden" name="rate" value="{{ $firstAnswerParam->rate }}">
            <input type="hidden" name="count" value="{{ $firstAnswerParam->count }}">
        @endif
    </div>

    <div id="container">
        <button id="addBtn" type="button" class="btn btn-primary">Add
            Response</button>
    </div>


    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-block btn-info w-25 mt-2" style="float: right">Create QSM</button>
        </div>


    </div>

</form>
