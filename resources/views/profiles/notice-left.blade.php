@desktop
<!-- Desktop view -->


@extends('yooty')

@section('content')
    @guest
        @if(Route::has('register'))
            <div class="container reg-container text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                        <br />
                        <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="container reg-container">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <h1 class="f-boldSE caps">Votre compte</h1> <!--Modifiez votre compte-->
                    <!-- <div id="alert"></div> -->
                    <div class="spacer40">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-5">
                            @include('profiles.menu')
                        </div>
                        <div class="col-md-7 text-center">
                            <p class="f-name_list_profile caps">Avis laissés</p>
                            <div class="spacer10">&nbsp;</div>
                            <p class="text-center f-name_public_profile">Vous avez écrit</p>
                            <hr>
                            @foreach($user->testimonial_reviewer as $reviewer)
                                <div class="row">
                                    <div class="col">
                                        <div class="spacer10">&nbsp;</div>
                                        <!-- About user -->
                                        <p class="f-name_public_profile text-center">Sur {{ $reviewer->user->name }} {{ $reviewer->user->surname }}</p>
                                        <!-- What you wrote -->
                                        <p>{{ $reviewer->testimonial }}</p>
                                        <div class="text-center">
                                            @switch($reviewer->rating)
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
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Avis laissés</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    @guest
        <div class="container reg-container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                    <br />
                    <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                </div>
            </div>
        </div>
    @else
        <div class="spacer80">&nbsp;</div>
        <div class="container">
            <div class="row">
                <div class="col-1">&nbsp;</div>
                <div class="col-10">
                    <p class="text-center f-name_public_profile caps">Vous avez écrit</p>
                    <div class="spacer10">&nbsp;</div>
                    <hr>
                    @foreach($user->testimonial_reviewer as $reviewer)
                        <div class="spacer10">&nbsp;</div>
                        <!-- About user -->
                        <p class="f-name_public_profile text-center">Sur {{ $reviewer->user->name }} {{ $reviewer->user->surname }}</p>
                        <!-- What you wrote -->
                        <p class="text-center">{{ $reviewer->testimonial }}</p>
                        <div class="text-center">
                            @switch($reviewer->rating)
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
                    @endforeach
                </div>
                <div class="col-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection


@enddesktop


