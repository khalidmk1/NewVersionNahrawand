<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subCategories as $subCategory)
                    <tr>
                        <td>{{ $subCategory->category->name }}</td>
                        <td>{{ $subCategory->name }}</td>
                        <td>{{ $subCategory->deleted_at }}</td>

                        <td>
                            <form action="{{ route('subCategory.restore', Crypt::encrypt($subCategory->id)) }}" method="post">
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
