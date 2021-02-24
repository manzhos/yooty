
@extends('yooty-blank')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">

                <h2 class="f-boldSE caps"> Témoignages sur {{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</h2>
                <div class="spacer20">&nbsp;</div>
                <p class="text-center f-name_public_profile">Score moyen&nbsp;: {{ Str::of($user->testimonial->avg('rating'))->limit(3, ' /') }}&nbsp;5</p>
                <hr>
                <div class="spacer20">&nbsp;</div>

                @forelse($user->testimonial as $testimonial)
                    <div class="row">
                        <div class="col">
                            <div class="spacer10">&nbsp;</div>
                            <p>{{ $testimonial->testimonial }}</p>
                            <div class="text-center">
                                @switch($testimonial->rating)
                                    @case(1)
                                    <img src="/images/1-star.svg" class="star-testimonial">
                                    @break

                                    @case(2)
                                    <img src="/images/2-star.svg" class="star-testimonial">
                                    @break

                                    @case(3)
                                    <img src="/images/3-star.svg" class="star-testimonial">
                                    @break

                                    @case(4)
                                    <img src="/images/4-star.svg" class="star-testimonial">
                                    @break

                                    @case(5)
                                    <img src="/images/5-star.svg" class="star-testimonial">
                                    @break

                                    @default
                                    <p>Do not have a star.</p>
                                @endswitch
                            </div>
                            <hr />
                        </div>
                    </div>
                @empty
                    <h5>Pas de fils</h5>
                @endforelse

            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>
@endsection
