@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')
    <div class="container reg-container">
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <!--  Link to back (on profile)  -->
                <a href="{{ route('profiles.publicprofile', ['id' => $user->id, 'path' => $backpath]) }}" style="cursor: pointer;">
                    <i class="fas fa-angle-left black" style="font-size: 12px"></i>
                    <span style="text-decoration: underline;" class="black">Retour</span>
                </a>
                <div class="spacer35">&nbsp;</div>

                <h1 class="f-boldSE caps"> Témoignages sur {{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</h1>
                <div class="spacer20">&nbsp;</div>
                <p class="text-center f-name_public_profile">Score moyen&nbsp;: {{ Str::of($user->testimonial->avg('rating'))->limit(3, ' /') }}&nbsp;5</p>
                <div class="spacer20">&nbsp;</div>
                <hr>

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


@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft">
                <a href="{{ route('profiles.publicprofile', ['id' => $user->id, 'path' => $backpath]) }}"
                   style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i>
                </a>
            </div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside">

        <div class="spacer20">&nbsp;</div>
        <h2 class="caps f-boldSE d-inline-block">
            Témoignages sur<br>{{ $user->name }} {{ Str::substr($user->surname, 0, 1) }}
        </h2>
        <hr>
        @forelse($user->testimonial as $testimonial)
            <div class="spacer10">&nbsp;</div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <p class="text-center f-name_public_profile">Score moyen&nbsp;: {{ Str::of($user->testimonial->avg('rating'))->limit(3, '/') }}&nbsp;5</p>
                    <hr>
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
                <div class="col-1"></div>
            </div>
        @empty
            <h5>Pas de fils</h5>
        @endforelse

        <div class="spacer80">&nbsp;</div>

    </div>

@endsection


@enddesktop
