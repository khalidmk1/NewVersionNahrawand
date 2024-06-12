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
                <tr>
                    <td>{{$content->title}}</td>
                    <td>{{$content->contentType}}</td>
                    <td> <img src="{{ asset('storage/content/' . $content->image) }}"
                        class="img-thumbnail" style="height: 173px" alt="Content" /></td>
                    <td>{{$content->deleted_at}}</td>
                    <td>
                        <td>
                            <a class="btn btn-block btn-info"
                                href=""><i
                                    class="fa fa-undo" aria-hidden="true"></i></a>
                        </td>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
