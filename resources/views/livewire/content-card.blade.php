<div>
    <!-- resources/views/livewire/content-card.blade.php -->
    <div class="row p-3 row-cols-1 row-cols-md-3 contentContainer" id="resultcours">
        @forelse ($contents as $index => $content)
            <div class="col " wire:key="content-{{ $index }}">
                <div class="card">
                    <div class="position-relative">
                        <h5 class="position-absolute badge {{ $content->isActive ? 'badge-success' : '' }} ">
                            {{ $content->isActive ? 'Active' : '' }}</h5>
                        <h5 class="position-absolute badge {{ $content->isComing ? 'badge-warning' : '' }}"
                            style="right: 0">
                            {{ $content->isComing ? 'A Venir' : '' }}</h5>
                        <h5 class="position-absolute m-0 badge badge-info" style="bottom: 0 ; right: 0;">
                            {{ $content->contentType }}</h5>

                        <img src="{{ asset('storage/content/' . $content->image) }}" class="card-img-top about_img"
                            alt="Skyscrapers" />
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"> {{ $content->title }}</h2>
                        <p class="card-text">{{ Str::limit($content->smallDescription, '100', '...') }}</p>
                        <a href="{{ route('content.show', Crypt::encrypt($content->id)) }}"
                            class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            No Products
        @endforelse
    </div>
    <div class="card-footer">
        <!-- Pagination UI -->
        <div class="d-flex justify-content-left mt-4">
            {{ $contents->links('livewire::simple-bootstrap') }}
        </div>
    </div>

</div>
