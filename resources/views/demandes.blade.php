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
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <h1 class="f-boldSE caps text-center"> annonces en attente </h1>
                    <div class="spacer40">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            @include('messages.demandes-list')
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <div class="container-mob-inside">
        <!-- menu button in menu-line -->
        <div class="mobMenu-blank">
            <div class="position-relative">
                <a href="{{ url('profile') }}" class="black">
                    <div class="menuleft">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </a>
                <a href="{{ url('/') }}" class="black">
                    <div id="menucenter">
                        <img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo-mob" alt="YOOTY">
                    </div>
                </a>
                <a href="{{ route('search-messages') }}" class="black">
                    <div id="menuright">
                        <i class="far fa-comment-dots iconbottmenu"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="spacer20">&nbsp;</div>

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
            <div class="text-center">
                <h1 class="f-name_list_profile caps">Annonces en attente</h1>
            </div>
            <hr class="w-75">
            <div class="spacer20">&nbsp;</div>
            <div class="container-mob-content">
                @include('messages.messages-list')
            </div>
            <div class="spacer80">&nbsp;</div>
        @endguest

    </div>
@endsection


@enddesktop
