<div class="row">
    <div class="col-12">


        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
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
                                <td>{{$answer->content->title}}</td>
                                <td>{{$answer->quiz->question}}
                                </td>
                                <td>{{$answer->answer}}</td>
                                <td> 4</td>
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
