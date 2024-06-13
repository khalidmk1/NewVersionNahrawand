<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <x-card-image :itemId="$user->id" :imageUrl="asset('storage/avatars/' . $user->avatar)" />
                    <tr>
                        <td>{{ $user->firstName }}</td>
                        <td>{{ $user->lastName }}</td>
                        <td> <button class="btn btn-block btn-info" data-toggle="modal"
                                data-target="#element_{{ $user->id }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button></td>
                        <td>
                            <h5>
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-secondary">{{ $role->name }}</span>
                                @endforeach
                            </h5>
                        </td>
                        <td>{{ $user->deleted_at }}</td>

                        <td>
                            <form action="{{ route('profile.restore', Crypt::encrypt($user->id)) }}" method="post">
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
