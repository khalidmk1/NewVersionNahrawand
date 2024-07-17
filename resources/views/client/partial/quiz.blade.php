<div class="row">
    <div class="col-12">


        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>content</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client->quizAnswer as $answer)
                            <tr>
                                <td><a
                                        href="{{ route('content.show', Crypt::encrypt($answer->content->id)) }}">{{ $answer->content->title }}</a>
                                </td>
                                <td>{{ $answer->quiz->question }}
                                </td>
                                <td>{{ $answer->answer }}</td>
                                <td>
                                    <!-- checkbox -->
                                    <div class="form-group clearfix m-0">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" class="submitNote" id="submitNote_{{$answer->id}}" {{ $answer->confirmed == 1 ? 'checked' : '' }} data-id="{{$answer->id}}" name="noteAnswer">
                                          <label for="submitNote">
                                          </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
