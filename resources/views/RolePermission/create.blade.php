@section('model-title')
Create Role
@endsection

@section('model-content')
    <form action="{{route('role.store')}}" method="POST">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="nameRole">name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="nameRole"
                    placeholder="Enter name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-block btn-info w-25">Create</button>
        </div>
    </form>
@endsection