<div class="gallery-photos" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 464 }'>
<!-- <div class="gallery-photos masonry"> -->
    @foreach($post->photos->take(4) as $photo)
        <figure class="grid-item grid-item--height2">
        <!-- <figure class="gallery-image"> -->
        @if($loop->iteration === 4)
            <div class="overlay">{{ $post->photos->count() }} Fotos</div>
        @endif
        <img src="{{ url($photo->url) }}" alt="" class="img-responsive">
    </figure>	
@endforeach		
</div>