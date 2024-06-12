<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Domain</th>
                    <th>Category</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->domain->name }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->deleted_at }}</td>

                        <td>
                            <form action="{{ route('category.restore', Crypt::encrypt($category->id)) }}" method="post">
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
