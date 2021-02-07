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
    <!--  Link to back (on search)  -->
    <div class="container topblock">
        <div class="row">
            <div class="col-md-12">
                <div style="padding-top: 20px; padding-left: 5vw;">
                    <a onclick="javascript:history.back(); return false;" style="cursor: pointer;">< <span style="padding-left: 10px; text-decoration: underline;">Retour aux questions</span></a>
                </div>
            </div>
        </div>
    </div>

    <!--  Body of message view  -->
    <div class="container">
        <!--  Body header  -->
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <h1 class="f-boldSE caps">Mes propositions d’aides</h1>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="spacer20">&nbsp;</div>

        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-5">
                <h2 class="f-name_list_profile caps">{{count($users)}} Propositions</h2>
            </div>
            <div class="col-md-5 text-right">
                <form action="{{ route('deleteassistance',$message->id) }}" method="post" role="form" id="delAllAssistant">
                    @csrf
                    <button type="submit" class="f-info_list_profile blank-white-button caps d-inline-block black"><i class="far fa-trash-alt"></i>&nbsp;supprimer tout</button>
                </form>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <!--  Profile list  -->
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div id="UnderLine"></div>
                <div class="spacer20">&nbsp;</div>
                @include('messages.userslist')
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <div class="spacer80">&nbsp;</div>
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
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Mes propositions d’aides</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>
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
        <!--  Body of message view  -->
        <div class="container-mob-content">
            <h2 class="f-name_list_profile caps text-center">{{count($users)}} Propositions</h2>

            <!--  Profile list  -->
            <div id="UnderLine"></div>
            <div class="spacer20">&nbsp;</div>
            @include('messages.userslist')

            <div class="text-center">
                <form action="{{ route('deleteassistance',$message->id) }}" method="post" role="form" id="delAllAssistant">
                    @csrf
                    <button type="submit" class="f-info_list_profile blank-white-button caps d-inline-block black"><i class="far fa-trash-alt"></i>&nbsp;supprimer tout</button>
                </form>
            </div>
        </div>
    @endguest
    <div class="spacer60">&nbsp;</div>

@endsection

@enddesktop
