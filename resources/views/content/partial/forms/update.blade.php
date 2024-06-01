<!-- /.card-header -->
<form action="{{ route('content.update', Crypt::encrypt($content->id)) }}" method="post" enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card-body">

        <input type="text" value="{{ $content->id }}" name="contentId" hidden>
        <div class="form-group">
            <label for="title">Ttile</label>
            <input type="text" value="{{ old('title', $content->title) }}" class="form-control" name="title"
                id="title" placeholder="Entrez Titre ...">
        </div>

        <div class="row">
            <div class="form-group clearfix col-6">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="isComing" id="iscoming"
                        {{ $content->isComing == 1 ? 'checked' : '' }}>
                    <label for="iscoming">
                        Coming Soon
                    </label>
                </div>

            </div>
            <div class="col-6">
                <!-- Bootstrap Switch -->
                <label for="boostrap-switch" class="mr-5">
                    Display
                </label>
                <input type="checkbox" name="isActive" id="boostrap-switch" data-value="" data-bootstrap-switch
                    data-off-color="danger" data-on-color="success" {{ $content->isActive == 1 ? 'checked' : '' }}>
            </div>
            <!-- /.card -->

        </div>


        <!-- textarea -->
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="smallDescription" rows="3" placeholder="Enter ...">{{ old('smallDescription', $content->smallDescription) }}</textarea>
        </div>


        {{--  <div class="form-group">
            <label for="tags">Tags</label>

            <input type="text" class="form-control" value="{{ implode(',', $content->tags) }}" name="tags[]"
                id="tags-input" />

        </div> --}}

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" id="souscategory_goals" name="cotegoryId" style="width: 100%;">
                        <option>Choose Category</option>
                        @foreach ($categories as $category)
                            <option {{ $content->categoryId == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="col-6">

                <div class="form-group">
                    <label for="goals_option">Objectives</label>
                    <select class="select3" name="objectivesId[]" multiple="multiple" id="objective_option"
                        data-placeholder="Select Objectives" style="width: 100%;">
                       {{--  @foreach ($objectives as $objective)
                            <option value="{{ $objective->id }}">
                                {{ $objective->name }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>


            </div>


        </div>



        <div class="col-12">
            <div class="form-group">
                <label for="subCategory">SubCategories</label>
                <select class="select3" name="subCategoryId[]" multiple="multiple" id="subCategory"
                    data-placeholder="Select a State" style="width: 100%;">
                    @foreach ($subCategories as $subCategory)
                        <option
                            {{ $content->contentSubCategories->contains('subCategoryId', $subCategory->id) ? 'selected' : '' }}
                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                    @endforeach

                </select>
            </div>
            <!-- /.form-group -->
        </div>

        <div class="form-group">
            <label for="tagContent">Tags</label>
            <input type="text" class="form-control" name="tags[]" id="tags-input"
                value="@foreach ($content->tags as $tag){{ $tag->name }}@if (!$loop->last),@endif @endforeach" />
        </div>


        @if ($content->contentType == 'conference' || $content->contentType == 'podcast')
            <div class="form-group">
                <label>Modirateur</label>
                <select class="form-control select2" name="contentHost" style="width: 100%;">
                    @foreach ($moderatorUsers as $moderatorUser)
                        <option {{ $moderatorUser->id == $content->hostId ? 'selected' : '' }}
                            value="{{ $moderatorUser->id }}">
                            {{ $moderatorUser->email }}
                        </option>
                    @endforeach
                </select>
            </div>
        @elseif($content->contentType == 'formation')
            <div class="form-group">
                <label>Formateur</label>
                <select class="form-control select2" name="contentHost" style="width: 100%;">
                    @foreach ($formateurUsers as $formateurUser)
                        <option {{ $formateurUser->id == $content->hostId ? 'selected' : '' }}
                            value="{{ $formateurUser->id }}">
                            {{ $formateurUser->email }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif



        <!-- /.form-group -->
        <!-- textarea -->
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="bigDescription" rows="6" placeholder="Enter ...">{{ $content->bigDescription }}</textarea>
        </div>

        <div class="form-group">
            <label for="coursImage">Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="contentImage" id="coursImage">
                <label class="custom-file-label" for="coursImage">Choisez image</label>
            </div>
        </div>
        <div class="form-group">
            <label for="flexImagePodcast">Flex Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="contentImageFlex" id="flexImagePodcast">
                <label class="custom-file-label" for="flexImagePodcast">Choose image</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">

                <div class="form-group">
                    <label for="videoconference">Video</label>
                    <input type="url" value="{{ old('video', $content->video) }}" class="form-control"
                        name="videoUrl" id="videoconference" placeholder="Entrez url video ...">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="time" class="form-control" id="duration" data-id="{{ $content->id }}"
                        name="duration" value="{{ old('duration', $content->duration) }}" step="1">
                </div>

            </div>

        </div>


    </div>

    <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Update</button>

</form>

@include('components.jQuery')
<script>
    $(document).ready(function() {
        var tagInputEle = $('#tags-input');
        tagInputEle.tagsinput();
    });
</script>
