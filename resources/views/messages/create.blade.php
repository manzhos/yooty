@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

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
    <div class="container reg-container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="f-boldSE caps">Posez votre question</h1>
            </div>
        </div>
        <div class="spacer40"></div>
        <div class="row-cols-4">
            <div class="col d-inline-block">
                <h3 class="f-boldSE caps">étape 1</h3>
            </div>
            <div class="col d-inline-block">
                <h3 class="f-boldSE caps lightgrey">étape 2</h3>
            </div>
            <div class="col d-inline-block">
                <h3 class="f-boldSE caps lightgrey">étape 3</h3>
            </div>
            <div class="col d-inline-block">
                <h3 class="f-boldSE caps"></h3>
            </div>
        </div>
        <div class="row-cols-4">
            <div class="col-md-3" style="vertical-align: center;">
                <div class="progression position-absolute"></div>
                <div class="rond position-absolute"></div>
            </div>
        </div>
        <div class="spacer60"></div>


        <div class="row">
            <div class="col-md-12">
                <h2 class="f-boldSE caps">Ton devoir</h2>
            </div>
        </div>
        <div class="spacer20"></div>

        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.error')
                @include('layouts.partials.success')
            </div>
        </div>

        <div id="drop">
            <drop-down-create v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}"></drop-down-create>
        </div>

    </div>

@endguest

<!----- Upload Icon styling ----->
<script src="{{ asset('js/uploadIcon.js') }}"></script>


@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a href="{{ route('search-messages') }}" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Poser&nbsp;votre&nbsp;question</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>

    <div class="container-mob-content">
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
            <h3 class="f-boldSE caps text-center">étape 1</h3>
            <div class="spacer10"></div>
            <h3 class="f-boldSE caps text-left">Ton devoir</h3>

            @include('layouts.partials.error')
            @include('layouts.partials.success')
            <div id="drop">
                <drop-down-create v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}"></drop-down-create>
            </div>

            <div class="spacer40"></div>

            <div class="text-center">
                <div class="create-circle active d-inline-block"></div>
                <div class="create-circle d-inline-block"></div>
                <div class="create-circle d-inline-block"></div>
            </div>

            <div class="spacer80"></div>
        @endguest
    </div>


@endsection

@enddesktop
