<form action="{{ route('event.update', Crypt::encrypt($event->id)) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="form-group">
        <label for="text">Ttile</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" id="text"
            placeholder="Enter Title ...">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $event->description }}</textarea>
    </div>

    <div class="form-group">
        <label>Speakers</label>
        <select class="select2" name="speakerID[]" multiple="multiple" data-placeholder="Select a State"
            style="width: 100%;">
            @foreach ($speakers as $speaker)
                <option {{ $event->eventUser->contains('userId', $speaker->id ) ? 'selected' : '' }}
                    value="{{ $speaker->id }}">
                    {{ $speaker->lastName . ' ' . $speaker->firstName }}</option>
            @endforeach
        </select>
    </div>



    <div class="form-group">
        <label>Date Start: </label>
        <div class="input-group date" id="DateStart" data-target-input="nearest">
            <input type="text" name="dateStart" placeholder="{{ $event->dateStart }}"
                class="form-control datetimepicker-input" data-target="#DateStart" />
            <div class="input-group-append" data-target="#DateStart" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Date End:</label>
        <div class="input-group date" id="DateEnd" data-target-input="nearest">
            <input type="text" name="DateEnd" placeholder="{{ $event->dateEnd }}"
                class="form-control datetimepicker-input" data-target="#DateEnd" />
            <div class="input-group-append" data-target="#DateEnd" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="url">Event Url</label>
        <input type="url" value="{{ old('url', $event->url) }}" name="url" class="form-control" id="url"
            placeholder="Enter Title ...">
    </div>


    <button type="submit" class="btn btn-block btn-warning w-25 mb-3 ml-3" style="float: right">update</button>
</form>
