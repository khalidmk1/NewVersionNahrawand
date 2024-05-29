<section id="conference" class="p-3" style="background-color: rgba(151, 120, 46, 0.46) ; border-radius:20px ">

    <div class="position-relative"></div>

    <div class="form-group">
        <label>Modirateur</label>
        <select class="form-control select2 " name="contentHost" style="width: 100%;">
            @foreach ($moderatorUsers as $moderatorUser)
                <option value="{{ $moderatorUser->id }}">
                    {{ $moderatorUser->email }}</option>
            @endforeach

        </select>
    </div>
    <!-- /.form-group -->


    <!-- textarea -->
    <div class="form-group">
        <label>Description Conférence</label>
        <textarea class="form-control" name="bigDescription" rows="3" placeholder="Enter ..."></textarea>
    </div>

    <div class="form-group">
        <label for="coursImage">Image Conférence</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImage" id="coursImage">
            <label class="custom-file-label" for="customFile">Choose image</label>
        </div>
    </div>

    <div class="form-group">
        <label for="flexImageConference">Flex Image Conférence</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImageFlex" id="flexImageConference">
            <label class="custom-file-label" for="flexImageConference">Choose image</label>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-md-8">

            <div class="form-group">
                {{-- <input type="file" class="filepond" name="introVideoConfrence"
                id="coursVideo"> --}}

                <label for="videoconference">Video Conférence</label>
                <input type="url" value="{{ old('videoUrl') }}" class="form-control" name="videoUrl"
                    id="videoconference" placeholder="Entrez url video ...">
            </div>

        </div>
        <div class="col-md-4">

            <!-- time Picker -->
            <div class="form-group">
                <label for="coursDuration">Duration Conférence</label>
                <input type="time" class="form-control" id="coursDuration" name="duration" value="00:00:00"
                    step="1">
            </div>

        </div>

    </div>


</section>
