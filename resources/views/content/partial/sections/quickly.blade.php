<section id="quickly" class="p-3" style="background-color: rgba(151, 120, 46, 0.46) ; border-radius:20px ">

    <div class="position-relative"></div>

    <div class="form-group">
        <label>Formateur</label>
        <select  class=" selectize" name="contentHost" style="width: 100%;">
            @foreach ($formateurUsers as $formateurUser)
                <option value="{{ $formateurUser->id }}">
                    {{ $formateurUser->email }}</option>
            @endforeach

        </select>
    </div>
    <!-- /.form-group -->

    <div class="form-group">
        <label for="coursImage">Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImage" id="coursImage">
            <label class="custom-file-label" for="customFile">Choose image</label>
        </div>
    </div>

    <div class="form-group">
        <label for="flexImageConference">Flex Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImageFlex" id="flexImageConference">
            <label class="custom-file-label" for="flexImageConference">Choose image</label>
        </div>
    </div>

    <div class="form-group">
        <label for="videoconference">Video</label>
        <input type="url" value="{{ old('videoUrl') }}" class="form-control" name="videoUrl"
            id="videoconference" placeholder="Entrez url video ...">
    </div>


</section>
