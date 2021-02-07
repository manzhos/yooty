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
                <h1 class="f-boldSE caps">Votre compte</h1> <!--Modifiez votre compte-->
                <!-- <div id="alert"></div> -->
                <div class="spacer40">&nbsp;</div>
                <div class="row">
                    <div class="col-md-5">
                        @include('profiles.menu')
                    </div>

                    <div class="col-md-7 text-center">
                        <p class="f-name_list_profile caps">Compétences</p>
                        <div class="spacer35">&nbsp;</div>

{{--
                        <div id="pop">
                            <confirm-userprof v-bind:id="{{$user->id}}"></confirm-userprof>
                        </div>
--}}

                        <form class="" action="{{ route('prof') }}" method="post" role="form" id="compte-form">
                            @csrf
                            <div id="Prof P switch" class="d-block vert-top text-center w-100 overflow-hidden">
                                <div class="d-inline-block" style="padding-top: 2px;">
                                    <span class="profile-text d-block caps">Student / Prof particulier</span>
                                </div>
                                <div class="d-block toggles vert-top" style="padding-top: 5px; height: 34px;">
                                    <input type="checkbox" name="prof" id="prof" class="ios-toggle check orangecheckbox"
                                           {{ ($user->meta->prof == "yes") ? 'checked' : 'unchecked' }}
                                    />
                                    <label for="prof" class="checkbox-label check" data-off="" data-on=""></label>
                                </div>
                            </div>

                            <input type="submit" class="blank-button profile-text underline" value="Enregistrer" />
                        </form>
                        <div class="spacer10">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-10">
                                @include('layouts.partials.error')
                                @include('layouts.partials.success')
                                @include('layouts.partials.error-message')
                            </div>
                            <div class="col-md-1">&nbsp;</div>
                        </div>
                        <hr class="w-75">
                        <div class="spacer20">&nbsp;</div>
                        <div id="drop">
                            @if($user->meta->prof == "yes")
                                <add-skill v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}" v-bind:options_prof="'true'"></add-skill>
                            @else
                                <add-skill v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}" v-bind:options_prof="'false'"></add-skill>
                            @endif
                        </div>

                        <hr class="w-75">

                        @forelse($skills as $skill)
                            <form action="{{ route('del.skill') }}" method="post" role="form">
                                @csrf
                                <div class="row align-items-center">
                                    <input hidden name="skill_id" value="{{$skill->id}}" />
                                    <div class="col-2">&nbsp;</div>
                                    <div class="col-7 text-left">
                                        <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                        @if($user->meta->prof == "yes")
                                            <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                            @if($skill->tarif_week == 0 or $skill->tarif_month == 0)
                                                <div class="text-left add-info-message-list">Vous devez fixer un prix supérieur à zéro, sinon votre profil pour cette compétence n'apparaîtra pas dans la recherche.</div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-1">
                                        <button class="blank-button" type="submit">
                                            <i class="fas fa-minus-circle" style="color: red; font-size: 22px;"></i>
                                        </button>
                                        <a href="" data-toggle="modal" data-target="#ModalCenter{{$skill->id}}" aria-label="Edit">
                                            <i class="far fa-edit" style="color: green; font-size: 17px; margin-left: 4px;"></i>
                                        </a>
                                    </div>
                                    <div class="col-2">&nbsp;</div>
                                </div>
                            </form>

                            <!-- The modal window for the form to edit tariffs -->
                            <div class="modal fade" id="ModalCenter{{$skill->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-win-tariff">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-reg text-center" id="exampleModalLongTitle">
                                                Modifier les taux pour le compétence<br/>
                                                <span class="f-boldSE">{{$skill->science->science_name}} - {{$skill->education->education}}</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- EDIT Comment Form-->
                                            <form class="form-vertical input-form" action="{{route('edit.tariffs')}}" method="post" role="form">
                                                @csrf
                                                <input hidden name="id" value="{{$skill->id}}" />
                                                <div class="row justify-content-center">
                                                    <div class="col-4">
                                                        <span>Semaine</span><div class="spacer10_right">&nbsp;</div>
                                                        <input class="tarif_edit" name="tarif_week" value="{{$skill->tarif_week}}">
                                                        <span>&#8364;</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <span>Mois</span><div class="spacer10_right">&nbsp;</div>
                                                        <input class="tarif_edit" name="tarif_month" value="{{$skill->tarif_month}}">
                                                        <span>&#8364;</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <div class="spacer40"></div>
                                                        <button type="submit" class="yootyButt form-button">Sauvers</button>
                                                        <div class="spacer20_right">&nbsp;</div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <div class="spacer20"></div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        @empty
                            @if($user->meta->prof == "yes")
                                <div class="row">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-10 text-center add-info-message-list">Si vous souhaitez devenir professeur particulier, vous devez sélectionner un ou plusieurs Matiére et le Niveau</div>
                                    <div class="col-md-1">&nbsp;</div>
                                </div>
                            @endif
                        @endforelse

                    </div>

                </div>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
    </div>
@endguest

<!-- Droplist logic -->
<script src="{{ asset('js/droplist.js') }}" ></script>

@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')

    <div class="container-mob-inside">
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
                    <div id="menuleft"><a href="{{ url('profile') }}" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Mon profil</span></div>
                    <div id="menucenter">&nbsp;</div>
                    {{--<a href="{{ route('profiles.info') }}" class="black"><div id="menuright"><i class="far fa-save iconbottmenu"></i></div></a>--}}
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <!-- main content -->
            <div class="container text-center">
                <div class="spacer40">&nbsp;</div>
                <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar">
                <div class="spacer20">&nbsp;</div>

                <span class="f-rate_public_profile d-block">{{ Str::of($user->testimonial->avg('rating'))->limit(3, '/') }}5</span>
                <a href="{{ route('profiles.reviews', ['id' => $user->id]) }}" class="f-education_public_profile d-block black">
                    {{ $user->testimonial->count() }} avis
                </a>
                <div class="spacer20">&nbsp;</div>
                <p class="f-addinfo_public_profile">
                    <span>Temps de réponse moyen : 4h</span><br>
                    <span>Nombres d’annonces répondues: 15</span>
                </p>
                <div class="spacer10">&nbsp;</div>
                <a href="/profile" class="black"><div id="buttonInformation-com">INFORMATIONS</div></a><div id="buttonCompte-com">COMPTE</div>
                <div class="spacer35">&nbsp;</div>
                <h1 class="f-name_list_profile caps ">{{ $user->name }} {{$user->surname}}</h1>
                <div class="spacer10">&nbsp;</div>
                <hr class="w-75">

                <!-- FOR for Check PROF or STUDENT -->
                <form class="" action="{{ route('prof') }}" method="post" role="form" id="compte-form">
                    @csrf
                    <div id="Prof P switch" class="d-block vert-top text-center w-100 overflow-hidden">
                        <div class="d-inline-block" style="padding-top: 2px;">
                            <span class="profile-text d-block caps">Student / Prof particulier</span>
                        </div>
                        <div class="d-block toggles vert-top" style="padding-top: 5px; height: 34px;">
                            <input type="checkbox" name="prof" id="prof" class="ios-toggle check orangecheckbox"
                                {{ ($user->meta->prof == "yes") ? 'checked' : 'unchecked' }}
                            />
                            <label for="prof" class="checkbox-label check" data-off="" data-on=""></label>
                        </div>
                    </div>
                    <input type="submit" class="blank-button profile-text underline" value="Enregistrer" />
                </form>

                <div class="row">
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-10">
                        @include('layouts.partials.error')
                        @include('layouts.partials.success')
                        @include('layouts.partials.error-message')
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                </div>

                <hr class="w-75">
                <div class="spacer20">&nbsp;</div>
                <div id="drop">
                    @if($user->meta->prof == "yes")
                        <add-skill v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}" v-bind:options_prof="'true'"></add-skill>
                    @else
                        <add-skill v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}" v-bind:options_prof="'false'"></add-skill>
                    @endif
                </div>

                <div class="spacer20">&nbsp;</div>

                <hr class="w-75">

                @forelse($skills as $skill)
                    <form action="{{ route('del.skill') }}" method="post" role="form">
                        @csrf
                        <div class="row align-items-center">
                            <input hidden name="skill_id" value="{{$skill->id}}" />
                            <div class="col-2">&nbsp;</div>
                            <div class="col-7 text-left">
                                <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                @if($user->meta->prof == "yes")
                                    <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                    @if($skill->tarif_week == 0 or $skill->tarif_month == 0)
                                        <div class="text-left add-info-message-list">Vous devez fixer un prix supérieur à zéro, sinon votre profil pour cette compétence n'apparaîtra pas dans la recherche.</div>
                                    @endif
                                @endif
                            </div>
                            <div class="col-1">
                                <button class="blank-button" type="submit">
                                    <i class="fas fa-minus-circle" style="color: red; font-size: 22px;"></i>
                                </button>
                                <a href="" data-toggle="modal" data-target="#ModalCenter{{$skill->id}}" aria-label="Edit">
                                    <i class="far fa-edit" style="color: green; font-size: 17px; margin-left: 4px;"></i>
                                </a>
                            </div>
                            <div class="col-2">&nbsp;</div>
                        </div>
                    </form>

                    <!-- The modal window for the form to edit tariffs -->
                    <div class="modal fade" id="ModalCenter{{$skill->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-win-tariff-mob">
                                <div class="modal-header">
                                    <h5 class="modal-title f-reg text-center" id="exampleModalLongTitle">
                                        Modifier les taux pour le compétence<br/>
                                        <span class="f-boldSE">{{$skill->science->science_name}} - {{$skill->education->education}}</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- EDIT Comment Form-->
                                    <form class="form-vertical input-form" action="{{route('edit.tariffs')}}" method="post" role="form">
                                        @csrf
                                        <input hidden name="id" value="{{$skill->id}}" />
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <span>Semaine</span><br/>
                                                <input class="tarif_edit" name="tarif_week" value="{{$skill->tarif_week}}">
                                                <span>&#8364;</span>
                                            </div>
                                            <div class="col-4">
                                                <span>Mois</span><br/>
                                                <input class="tarif_edit" name="tarif_month" value="{{$skill->tarif_month}}">
                                                <span>&#8364;</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <div class="spacer40"></div>
                                                <button type="submit" class="yootyButt form-button">Sauvers</button>
                                                <div class="spacer20_right">&nbsp;</div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                <div class="spacer20"></div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    @if($user->meta->prof == "yes")
                        <div class="row">
                            <div class="col-md-1">&nbsp;</div>
                            <div class="col-md-10 text-center add-info-message-list">Si vous souhaitez devenir professeur particulier, vous devez sélectionner un ou plusieurs Matiére et le Niveau</div>
                            <div class="col-md-1">&nbsp;</div>
                        </div>
                    @endif
                @endforelse

                <div class="spacer20">&nbsp;</div>

                @include('profiles.menu-mob')

                <div class="spacer35">&nbsp;</div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="black icon-size1 blank-button"><i class="fas fa-power-off"></i>&nbsp;<span class="caps">Déconnexion</span></button>
                </form>

                <div class="spacer40">&nbsp;</div>
                <div class="spacer80">&nbsp;</div>
            </div>

        @endguest
    </div>


    <!-- Droplist logic -->
    <script src="{{ asset('js/droplist.js') }}" ></script>



@endsection


@enddesktop
