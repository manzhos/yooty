@foreach($user->testimonial as $testimonial)
    <div class="reviews">
        <div class="review-topline">
            <h6 class="review-head d-inline-block">Avis laissé par {{ $testimonial->user->name }}&nbsp;{{ Str::substr($testimonial->user->surname, 0, 1) }} le {{$testimonial->user->created_at}}</h6>
            @if($testimonial->rating == 5)
                <img src="{{ asset('images/5-star.svg') }}" class="review-star d-inline-block" />
            @elseif($testimonial->rating == 4)
                <img src="{{ asset('images/4-star.svg') }}" class="review-star d-inline-block" />
            @elseif($testimonial->rating == 3)
                <img src="{{ asset('images/3-star.svg') }}" class="review-star d-inline-block" />
            @elseif($testimonial->rating == 2)
                <img src="{{ asset('images/2-star.svg') }}" class="review-star d-inline-block" />
            @elseif($testimonial->rating == 1)
                <img src="{{ asset('images/1-star.svg') }}" class="review-star d-inline-block" />
            @endif
        </div>
        <p class="review-body">{{ $testimonial->testimonial }}</p>
    </div>
@endforeach
