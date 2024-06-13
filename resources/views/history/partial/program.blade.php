<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                   {{--  <th>Image</th> --}}
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                    {{--  <x-card-image :itemId="$video->id" :imageUrl="asset('storage/video/' . $video->image)" /> --}}
                    <tr>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->description }}</td>
                       {{--  <td> <button class="btn btn-block btn-info" data-toggle="modal"
                                data-target="#element_{{ $video->id }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button></td> --}}
                        <td>{{ $program->deleted_at }}</td>
                        <td>
                            <form action="{{ route('program.restore', Crypt::encrypt($program->id)) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-block btn-dark"><i class="fa fa-undo"
                                        aria-hidden="true"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
