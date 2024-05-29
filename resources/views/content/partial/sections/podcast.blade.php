<section id="podcast" class="p-3" style="background-color: rgba(176, 169, 83, 0.32) ; border-radius:20px ">

    <div class="form-group">
        <label for="slug_acroche">Acroche</label>
        <input type="text" value="{{ old('slug') }}" class="form-control" name="slugAcroche" id="slug_acroche"
            placeholder="Entrez Acroche ...">
    </div>

    <div class="form-group">
        <label>Animateur</label>
        <select class="form-control select2 " name="contentHost" style="width: 100%;">
            @foreach ($animatorUsers as $animatorUser)
                <option value="{{ $animatorUser->id }}">
                    {{ $animatorUser->email }}</option>
            @endforeach

        </select>
    </div>
    <!-- /.form-group -->


    <!-- textarea -->
    <div class="form-group">
        <label>Description Podcast</label>
        <textarea class="form-control" name="bigDescription" rows="3" placeholder="Enter ..."></textarea>
    </div>

    <div class="form-group">
        <label for="ImagePodcast">Image Podcast</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImage" id="ImagePodcast">
            <label class="custom-file-label" for="ImagePodcast">Choose image</label>
        </div>
    </div>

    <div class="form-group">
        <label for="flexImagePodcast">Flex Image Podcast</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImageFlex" id="flexImagePodcast">
            <label class="custom-file-label" for="flexImagePodcast">Choose image</label>
        </div>
    </div>


    <div class="row align-items-center">
        <div class="col-md-8">

            <div class="form-group">
                <label for="videocpodcast">Video Podcast</label>
                <input type="url" value="{{ old('videoUrl') }}" class="form-control" name="videoUrl"
                    id="videocpodcast" placeholder="Entrez url video ...">
            </div>



        </div>
        <div class="col-md-4">

            <!-- time Picker -->
            <div class="form-group">
                <label for="DurationPdcast">Duration Podcast</label>
                <input type="time" class="form-control" id="DurationPdcast" name="duration" value="00:00:00"
                    step="1">
            </div>

        </div>

    </div>



</section>
