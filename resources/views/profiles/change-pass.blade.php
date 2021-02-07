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

                        <div class="col-md-1">&nbsp;</div>

                        <div class="col-md-6 text-center">
                            <p class="f-name_list_profile caps">Modifier mon mot de&nbsp;passe</p>
                            <div class="spacer20">&nbsp;</div>

                            <!-- messages & error -->
                            @if ( session()->has('message') )
                                <div class="alert alert-success alert-dismissible text-left">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ( session()->has('error') )
                                <div class="alert alert-danger alert-dismissible text-left">
                                    {{ session()->get('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ( $errors->any() )
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <!-- end of messages & error -->

                            <form action="{{ route('change-userpass', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method("PUT")

                                <label for="old_pass">Ancien mot de passe</label>
                                <input id="old_pass" name="old_pass" type="password" class="form-control" />
                                <div class="spacer20">&nbsp;</div>

                                <label for="new_pass">Nouveau mot de passe</label>
                                <input id="new_pass" name="new_pass" type="password" class="form-control" />
                                <div class="spacer20">&nbsp;</div>

                                <label for="new_pass_confirmation">Répétez le nouveau mot de passe</label>
                                <input id="new_pass_confirmation" name="new_pass_confirmation" type="password" class="form-control" />
                                <div class="spacer40">&nbsp;</div>

                                <button type="submit" class="yootyButt">Modifier</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymobprofil')

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
        <!-- menu button in menu-line -->
        <div class="mobMenu-blank">
            <div class="position-relative">
                <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">mon mot de passe</span></div>
                <div id="menucenter">&nbsp;</div>
            </div>
        </div>
        <div class="spacer20">&nbsp;</div>

        <!-- main content -->
        <div class="spacer80">&nbsp;</div>
        <div class="container">
            <div class="row">
                <div class="col-1">&nbsp;</div>
                <div class="col-10 text-center">
                    <p class="f-name_list_profile caps">Modifier mon mot de&nbsp;passe</p>

                    <div class="spacer35">&nbsp;</div>

                    <!-- messages & error -->
                    @if ( session()->has('message') )
                        <div class="alert alert-success alert-dismissible text-left">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ( session()->has('error') )
                        <div class="alert alert-danger alert-dismissible text-left">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ( $errors->any() )
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <!-- end of messages & error -->

                    <form action="{{ route('change-userpass', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method("PUT")

                        <label for="old_pass">Ancien mot de passe</label>
                        <input id="old_pass" name="old_pass" type="password" class="form-control" />
                        <div class="spacer20">&nbsp;</div>

                        <label for="new_pass">Nouveau mot de passe</label>
                        <input id="new_pass" name="new_pass" type="password" class="form-control" />
                        <div class="spacer20">&nbsp;</div>me

                        <label for="new_pass_confirmation">Répétez le nouveau mot de passe</label>
                        <input id="new_pass_confirmation" name="new_pass_confirmation" type="password" class="form-control" />
                        <div class="spacer60">&nbsp;</div>

                        <button type="submit" class="yootyButt">Modifier</button>
                    </form>

                </div>
                <div class="col-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection


@enddesktop
