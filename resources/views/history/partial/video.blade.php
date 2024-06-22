<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <x-card-image :itemId="'elementVideo'.$video->id" :imageUrl="asset('storage/video/' . $video->image)" />
                    <tr>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->description }}</td>
                        <td> <button class="btn btn-block btn-info" data-toggle="modal"
                                data-target="#elementVideo{{ $video->id }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button></td>
                        <td>{{ $video->deleted_at }}</td>

                        <td>
                            <form action="{{ route('video.restore', Crypt::encrypt($video->id)) }}" method="post">
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
