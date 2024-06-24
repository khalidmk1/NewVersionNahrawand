<form action="{{ route('quiz.content.store', Crypt::encrypt($content->id)) }}" id="create_Question" method="post">
    @csrf
    <input type="text" hidden name="question">

    <div class="form-group Question">
        <label for="Question">Question</label>
        <input type="text" class="form-control question_text " name="question[]" required id="Question"
            placeholder="Entrez Question ...">
    </div>

    <div id="containerQuestion">


        <button id="addQuestion" type="button" class="btn btn-primary">Add
            Question</button>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-block btn-info w-25 mt-2" style="float: right">Create
                Questions</button>
        </div>

        <div class="col-12">
            <div class="row mt-5 ContentQuestion">




            </div>
        </div>

    </div>

</form>
