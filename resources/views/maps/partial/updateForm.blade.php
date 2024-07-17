<!-- /.card-header -->
<form action="{{ route('map.update', Crypt::encrypt($map->id)) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf




    <div class="form-group col-12">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="100%" height="560" id="gmap_canvas"
                    src="https://maps.google.com/maps?q={{ $map->att }},{{ $map->lang }}&t=k&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <a href="https://online.stopwatch-timer.net/pomodoro-timer">tomato timer</a><br>
                <a href="https://textcaseconvert.com"></a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 560px;
                        width: 100%;
                    }
                </style>
                <a href="https://www.ongooglemaps.com">google maps embed</a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 560px;
                        width: 100%;
                    }
                </style>
            </div>
        </div>
    </div>


    <!-- /.form-group -->
    <div class="form-group">
        <label>Title</label>
        <input type="text" value="{{ old('title', $map->title) }}" name="title" class="form-control"
            placeholder="Enter ...">
    </div>

    <div class="form-group">
        <label>City</label>
        <select class="form-control select2" name="country" style="width: 100%;">
            @foreach ($cities as $city)
                <option value="{{ $city->lng . ',' . $city->lat }}"
                    {{ $map->att == $city->lat && $map->lang == $city->lng ? 'selected=selected' : '' }}>
                    {{ $city->city }}
                </option>
            @endforeach
        </select>
    </div>


    <!-- /.form-group -->
    <div class="form-group">
        <label>Slogan</label>
        <input type="text" value="{{ old('slogan', $map->slogan) }}" name="slogan" class="form-control"
            placeholder="Enter ...">
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image Principale</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="imagePrincipale" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="imagesInputFile">Images</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="images[]" class="custom-file-input" id="imagesInputFile" multiple>
                <label class="custom-file-label" for="imagesInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <div class="mt-3 d-flex">
            @foreach ($map->images as $picture)
                @if ($picture->type == 'image')
                    <div class="image-wrapper-images">
                        <img src="{{ asset('storage/' . $picture->image) }}" alt="">
                        <i class="fa fa-trash trash-icon delete-image-form" data-id="{{ Crypt::encrypt($picture->id) }}"
                            aria-hidden="true"></i>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="imagesNormale-container" class="mt-3 d-flex">

        </div>
    </div>



    <div class="form-group">
        <label> Date of Establishment</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" value="{{ old('dateEstablishe', $map->date) }}" name="dateEstablishe"
                class="form-control datetimepicker-input" data-target="#reservationdate" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <!-- Date and time -->

    <!-- /.form-group -->
    <div class="form-group">
        <label>founder</label>
        <input type="text" value="{{ old('founder', $map->founder) }}" name="founder" class="form-control"
            placeholder="Enter ...">
    </div>

    <div class="form-group">
        <label>Textarea</label>
        <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{ $map->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="imagesPlateInputFile">Main dishes</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="plateImages[]" class="custom-file-input" id="imagesPlateInputFile" multiple>
                <label class="custom-file-label" for="imagesPlateInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <div class="mt-3">
            @foreach ($map->images as $picture)
                @if ($picture->type == 'plate')
                    <div class="image-wrapper ">
                        <img src="{{ asset('storage/' . $picture->image) }}" alt="">
                        <input type="text" class="form-control"
                            value="{{ old('description', $picture->description) }}"
                            name="textPlate[{{ $picture->id }}]" placeholder="Enter description">
                        <i class="fa fa-trash trash-icon delete-image-form"
                            data-id="{{ Crypt::encrypt($picture->id) }}" aria-hidden="true"></i>

                    </div>
                @endif
            @endforeach
        </div>

        <div id="image-container" class="mt-3"></div>
    </div>


    <div class="form-group">
        <label for="imagesclotheInputFile">Main clothes</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="clotheImages[]" class="custom-file-input" id="imagesclotheInputFile"
                    multiple>
                <label class="custom-file-label" for="imagesclotheInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        <div class="mt-3">
            @foreach ($map->images as $picture)
                @if ($picture->type == 'clothe')
                    <div class="image-wrapper ">
                        <img src="{{ asset('storage/' . $picture->image) }}" alt="">
                        <input type="text" class="form-control"
                            value="{{ old('description', $picture->description) }}"
                            name="textClothes[{{ $picture->id }}]" placeholder="Enter description">
                        <i class="fa fa-trash trash-icon delete-image-form"
                            data-id="{{ Crypt::encrypt($picture->id) }}" aria-hidden="true"></i>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="image-container-clothes" class="mt-3"></div>
    </div>

    <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3 form-update"
        style="float: right">Update</button>
</form>
