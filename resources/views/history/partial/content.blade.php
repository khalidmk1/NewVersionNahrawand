<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                    <x-card-image :itemId="$content->id" :imageUrl="asset('storage/content/' . $content->image)" />
                    <tr>
                        <td>{{ $content->title }}</td>
                        <td>{{ $content->contentType }}</td>
                        <td> <button class="btn btn-block btn-info" data-toggle="modal"
                                data-target="#element_{{ $content->id }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button></td>
                        <td>{{ $content->deleted_at }}</td>

                        <td>
                            <form action="{{ route('content.restore', Crypt::encrypt($content->id)) }}"
                                method="post">
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
