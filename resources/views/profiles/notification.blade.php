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

                        <div class="col-md-5 text-left" style="padding-left: 15px;">
                            <p class="f-name_list_profile caps">Notifications</p>
                            <div class="spacer40">&nbsp;</div>

                            <form class="form-vertical input-form w-100" action="{{ route('profile.notification') }}" method="get" role="form" id="notification-form" style="max-width: 350px" >
                                @csrf
                                <div id="Notifications de message switch" class="d-inline-block vert-top w-100">
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Notifications de message</span>
                                    </div>
                                    <div class="d-inline-block toggles vert-top float-right">
                                        <input type="checkbox" name="message" id="message" class="ios-toggle check orangecheckbox" {{ ($user->setnotification->new_message === 1) ? 'checked' : 'unchecked' }}/>
                                        <label for="message" class="checkbox-label check" data-off="" data-on=""></label>
                                    </div>
                                </div>

                                <div id="Notifications de virement switch" class="d-inline-block vert-top w-100">
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Notifications de virement</span>
                                    </div>
                                    <div class="d-inline-block toggles vert-top float-right">
                                        <input type="checkbox" name="virement" id="virement" class="ios-toggle check orangecheckbox"  {{ ($user->setnotification->money === 1) ? 'checked' : 'unchecked' }}/>
                                        <label for="virement" class="checkbox-label check" data-off="" data-on=""></label>
                                    </div>
                                </div>

                                <div id="Notifications de remboursement switch" class="d-inline-block vert-top w-100">
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Notifications de remboursement</span>
                                    </div>
                                    <div class="d-inline-block toggles vert-top float-right">
                                        <input type="checkbox" name="remboursement" id="remboursement" class="ios-toggle check orangecheckbox"  {{ ($user->setnotification->return_money === 1) ? 'checked' : 'unchecked' }}/>
                                        <label for="remboursement" class="checkbox-label check" data-off="" data-on=""></label>
                                    </div>
                                </div>

                                <div id="Notifications de cours particulier switch" class="d-inline-block vert-top w-100">
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Notifications de cours particulier</span>
                                    </div>
                                    <div class="d-inline-block toggles vert-top float-right">
                                        <input type="checkbox" name="cours_particulier" id="cours_particulier" class="ios-toggle check orangecheckbox"  {{ ($user->setnotification->be_prof === 1) ? 'checked' : 'unchecked' }}/>
                                        <label for="cours_particulier" class="checkbox-label check" data-off="" data-on=""></label>
                                    </div>
                                </div>

                                <div id="Rappel Début et fin de conversation switch" class="d-inline-block vert-top w-100">
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Rappel Début et fin de conversation</span>
                                    </div>
                                    <div class="d-inline-block toggles vert-top float-right">
                                        <input type="checkbox" name="rappel" id="rappel" class="ios-toggle check orangecheckbox"  {{ ($user->setnotification->start_end_conversation === 1) ? 'checked' : 'unchecked' }}/>
                                        <label for="rappel" class="checkbox-label check" data-off="" data-on=""></label>
                                    </div>
                                </div>

                                <div class="spacer40">&nbsp;</div>
                                <input type="submit" class="yootyBTN yooty_color" value="Enregistrer les paramètres">
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
{{--    <div class="container-mob-inside overflow-hidden">
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
        <div class="spacer40">&nbsp;</div>
        <form class="notification-form-mob" action="{{ route('profiles.notification-set') }}" method="post" role="form" id="notification-form">
            @csrf
            <div id="Notifications de message switch" class="d-inline-block vert-top w-100 position-relative">
                <div class="d-inline-block">
                    <span class="f-reg d-block">Notifications de message</span>
                </div>
                <div class="d-inline-block toggles vert-top switcher-block">
                    <input type="checkbox" name="message" id="message" class="ios-toggle check orangecheckbox" checked/>
                    <label for="message" class="checkbox-label check" data-off="" data-on=""></label>
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <div id="Notifications de virement switch" class="d-inline-block vert-top w-100 position-relative">
                <div class="d-inline-block">
                    <span class="f-reg d-block">Notifications de virement</span>
                </div>
                <div class="d-inline-block toggles vert-top switcher-block">
                    <input type="checkbox" name="virement" id="virement" class="ios-toggle check orangecheckbox" checked/>
                    <label for="virement" class="checkbox-label check" data-off="" data-on=""></label>
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <div id="Notifications de remboursement switch" class="d-inline-block vert-top w-100 position-relative">
                <div class="d-inline-block">
                    <span class="f-reg d-block">Notifications de remboursement</span>
                </div>
                <div class="d-inline-block toggles vert-top switcher-block">
                    <input type="checkbox" name="remboursement" id="remboursement" class="ios-toggle check orangecheckbox" checked/>
                    <label for="remboursement" class="checkbox-label check" data-off="" data-on=""></label>
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <div id="Notifications de cours particulier switch" class="d-inline-block vert-top w-100 position-relative">
                <div class="d-inline-block">
                    <span class="f-reg d-block">Notifications de cours particulier</span>
                </div>
                <div class="d-inline-block toggles vert-top switcher-block">
                    <input type="checkbox" name="cours_particulier" id="cours_particulier" class="ios-toggle check orangecheckbox" checked/>
                    <label for="cours_particulier" class="checkbox-label check" data-off="" data-on=""></label>
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <div id="Rappel Début et fin de conversation switch" class="d-inline-block vert-top w-100 position-relative">
                <div class="d-inline-block">
                    <span class="f-reg d-block">Rappel Début et fin de conversation</span>
                </div>
                <div class="d-inline-block toggles vert-top switcher-block">
                    <input type="checkbox" name="rappel" id="rappel" class="ios-toggle check orangecheckbox" checked/>
                    <label for="rappel" class="checkbox-label check" data-off="" data-on=""></label>
                </div>
            </div>

            <div class="spacer40">&nbsp;</div>
            <input type="submit" class="yootyBTN_public_profile yooty_color" value="Enregistrer">
        </form>
    @endguest
    </div>--}}
@endsection


@enddesktop
