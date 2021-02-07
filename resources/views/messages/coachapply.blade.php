@desktop
<!-- Desktop view -->


@extends('yooty')

@section('content')

    <div class="container reg-container">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3"><span class="ok-ico"><i class="fas fa-check-circle"></i></span></div>
                    <div class="col-md-9">
                        <div class="spacer20"></div>
                        <h1 class="f-boldSE caps">Votre demande<br />a été envoyée</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="spacer40"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <h1 class="f-boldSE caps">Vous recevrez une<br />réponse sous 24h</h1>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="spacer40"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <form action="{{ route('search-messages') }}">
                    <button class="yootyButt"><span class="menu-txt">Retourner à la recherche</span></button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>

    <div class="spacer80"></div><div class="spacer40"></div>

@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Rechercher un prof</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside text-center">

        <div class="spacer60">&nbsp;</div>
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-inline-block"><span class="ok-ico-mob"><i class="fas fa-check-circle"></i></span></div>
                <div class="d-inline-block w-75">
                    <h2 class="f-boldSE caps">Votre demande<br />a été envoyée</h2>
                </div>
            </div>
            <div class="spacer40"></div>
            <div class="w-75 text-left" style="margin: 0 auto;">
                <h2 class="f-boldSE caps">Vous recevrez une<br />réponse sous 24h</h2>
            </div>
            <div class="spacer80"></div>
            <div class="text-center w-100">
                <form action="{{ route('search-messages') }}">
                    <button class="yootyButt"><span class="menu-txt">Retourner à la recherche</span></button>
                </form>
            </div>
        </div>
    </div>

@endsection


@enddesktop
