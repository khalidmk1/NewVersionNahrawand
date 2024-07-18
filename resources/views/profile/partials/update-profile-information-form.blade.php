<!-- form start -->
<form action="{{ route('profile.update', Crypt::encrypt($user->id)) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="card-body">


        <div class="form-group">
            <label for="avatar">avatar</label>
            <div class="custom-file">
                <input type="file" value="{{ old('avatar', $user->avatar) }}" class="custom-file-input" name="avatar"
                    id="avatar">
                <label class="custom-file-label" for="avatar">Choisez image</label>
            </div>
        </div>
        @if ($user->hasAnyRole(['Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier']))
            <div class="form-group">
                <label for="cover">Cover Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cover" id="cover">
                    <label class="custom-file-label" for="cover">Upload</label>
                </div>
            </div>
        @endif


        @if ($user->hasAnyRole(['Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier']))
            <div class="form-group clearfix text-center col-4">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="isPopulaire" id="isPopulaire"
                        {{ $user->isPopular == 1 ? 'checked' : '' }}>
                    <label for="isPopulaire">
                        Popular
                    </label>
                </div>

            </div>
        @endif

        <div class="form-group">
            <label for="firstName"> Last name</label>
            <input type="text" class="form-control" id="firstName" name="firstName"
                value="{{ old('firstName', $user->firstName) }}">

        </div>
        <div class="form-group">
            <label for="lastName">First name</label>
            <input type="text" class="form-control" id="lastName" name="lastName"
                value="{{ old('lastName', $user->lastName) }}">
        </div>

        @if ($user->hasAnyRole('Admin'))
            <div class="form-group">
                <label>Role</label>

                <select class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State"
                    style="width: 100%;">
                    @foreach ($rolesAdmin as $roleAdmin)
                        <option value="{{ $roleAdmin->name }}"
                            {{ $user->roles->contains('id', $roleAdmin->id) ? 'selected' : '' }}>
                            {{ $roleAdmin->name }}</option>
                    @endforeach

                </select>
            </div>
        @endif

        @if ($user->hasAnyRole('Super Admin'))
            <div class="form-group">
                <label>Role</label>

                <select class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State"
                    style="width: 100%;">
                    @foreach ($rolesSuperAdmin as $roleSuperAdmin)
                        <option value="{{ $roleSuperAdmin->name }}"
                            {{ $user->roles->contains('id', $roleSuperAdmin->id) ? 'selected' : '' }}>
                            {{ $roleSuperAdmin->name }}</option>
                    @endforeach

                </select>
            </div>
        @endif


        @if (
            !$user->hasAnyRole([
                'Super Admin',
                'Admin',
                'Formateur',
                'Invité',
                'Modérateur',
                'Conférencier',
                'Animateur',
                'Client',
            ]))

            <div class="form-group">
                <label>Type of Speaker</label>

                <select class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State"
                    style="width: 100%;">
                    @foreach ($rolesMangers as $rolesManger)
                        <option value="{{ $rolesManger->name }}"
                            {{ $user->roles->contains('id', $rolesManger->id) ? 'selected' : '' }}>
                            {{ $rolesManger->name }}</option>
                    @endforeach

                </select>
            </div>
        @endif



        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                value="{{ old('email', $user->email) }}">
        </div>



        @if ($user->hasAnyRole(['Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier']))
            <!-- textarea -->
            <div class="form-group">
                <label for="biographie">Biography</label>
                <textarea class="form-control" id="biographie" rows="3" name="biographie" placeholder="Enter ...">{{ $user->biographie }}</textarea>
            </div>


            <div class="form-group">
                <label>Type of Speaker</label>
                <select class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State"
                    style="width: 100%;">
                    @foreach ($rolesSpeakers as $rolesSpeaker)
                        <option value="{{ $rolesSpeaker->name }}"
                            {{ $user->roles->contains('id', $rolesSpeaker->id) ? 'selected' : '' }}>
                            {{ $rolesSpeaker->name }}</option>
                    @endforeach

                </select>
            </div>



            <div class="form-group">
                <label for="facebook">facebook</label>
                <input type="url" value="{{ old('facebook', $user->faceboock) }}" class="form-control"
                    name="facebook" id="facebook" placeholder="Entrez url reseau social ...">
            </div>
            <div class="form-group">
                <label for="linkedin">linkedin</label>
                <input type="url" value="{{ old('linkedin', $user->linkdin) }}" class="form-control"
                    name="linkedin" id="linkedin" placeholder="Entrez url reseau social ...">
            </div>
            <div class="form-group">
                <label for="instagram">instagram</label>
                <input type="url" value="{{ old('instagram', $user->instagram) }}" class="form-control"
                    name="instagram" id="instagram" placeholder="Entrez url reseau social ...">
            </div>
        @endif

    </div>
    <!-- /.card-body -->


    <div class="card-footer">
        <button type="submit" class="btn btn-block btn-warning w-25" style="float: right">Update</button>
        @if (auth()->user()->id == $user->id)
            <button type="button" data-toggle="modal" data-target="#single-generic-model"
                class="btn btn-primary">Change
                Password</button>
        @endif
    </div>


</form>
