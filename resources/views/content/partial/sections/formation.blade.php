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
            <input type="checkbox" name="isCertify" id="certify">
            <label for="certify">
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
                    {{ $formateurUser->firstName.' '.$formateurUser->lastName }}</option>
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
        <label for="DocumentFomation">Document</label>
        <input type="url" value="{{ old('document') }}" class="form-control" name="document"
            id="DocumentFomation" placeholder="Entrez url document ...">
    </div>
</section>
