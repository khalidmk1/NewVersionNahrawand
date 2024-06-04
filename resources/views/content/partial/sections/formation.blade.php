<section id="formation" class="p-3" style="background-color: rgba(208, 144, 16, 0.35) ; border-radius:20px ">

    <!-- textarea -->
    <div class="form-group">
        <label>Small Description</label>
        <textarea class="form-control" name="smallDescription" rows="3" placeholder="Enter ...">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="ImageFomation">Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImage" id="ImageFomation">
            <label class="custom-file-label" for="ImageFomation">Choose image</label>
        </div>
    </div>

    <div class="form-group">
        <label for="flexImageFormation">Flex Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="contentImageFlex" id="flexImageFormation">
            <label class="custom-file-label" for="flexImageFormation">Choose image</label>
        </div>
    </div>



    <div class="form-group clearfix">
        <div class="icheck-primary d-inline">
            <input type="checkbox" name="isCertify" id="certifier_formation">
            <label for="certifier_formation">
                Certify
            </label>
        </div>

    </div>

    <!-- textarea -->
    <div class="form-group" id="condition">
        <label>Eligibility criteria</label>
        <textarea class="form-control" name="condition" rows="3" placeholder="Enter ..."></textarea>
    </div>


    <div class="form-group">
        <label>Formateur</label>
        <select class=" selectize" name="contentHost" style="width: 100%;">
            @foreach ($formateurUsers as $formateurUser)
                <option value="{{ $formateurUser->id }}">
                    {{ $formateurUser->email }}</option>
            @endforeach

        </select>
    </div>
    <!-- /.form-group -->


    <div class="form-group">
        <label>Program</label>
        <select class=" selectize" name="programId" style="width: 100%;">
            <option value="0">Choose Program</option>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}">
                    {{ $program->title }}</option>
            @endforeach

        </select>
    </div>
    <!-- /.form-group -->




    <div class="form-group">
        <label for="DocumentFomation">Documents</label>
        <div class="custom-file">
            <input type="file" name="document" class="custom-file-input" id="DocumentFomation" multiple>
            <label class="custom-file-label" for="DocumentFomation">Choose Documents</label>
        </div>
    </div>
</section>
