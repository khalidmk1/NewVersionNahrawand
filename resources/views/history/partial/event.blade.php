<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Desctiption</th>
                    <th>Image</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <x-card-image :itemId="$event->id" :imageUrl="asset('storage/event/' . $event->image)" />
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td> <button class="btn btn-block btn-info" data-toggle="modal"
                                data-target="#element_{{ $event->id }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button></td>
                        <td>{{ $event->deleted_at }}</td>

                        <td>
                            <form action="{{ route('event.restore', Crypt::encrypt($event->id)) }}"
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
