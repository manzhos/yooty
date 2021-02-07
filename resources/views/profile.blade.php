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

                        <div class="col-md-4 text-center">
                            <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar">
                            <div class="spacer20">&nbsp;</div>
                            <h1 class="f-name_list_profile caps ">{{ $user->name }} {{$user->surname}}</h1>
                            <div class="spacer40">&nbsp;</div>
                            @if(isset($user->meta))
                                <p class="f-profile profile-text">Téléphone</p>
                                <p class="f-profile profile-data ">{{ $user->meta->phone }}</p>
                            @else
                                <!-- nothing load -->
                            @endif
                            <div class="spacer40">&nbsp;</div>
                            <p class="f-profile profile-text">E-mail</p>
                            <p class="f-profile profile-data ">{{ $user->email }}</p>
{{--
                            <div class="spacer40">&nbsp;</div>
                            <p class="f-profile profile-text">Niveau d’étude</p>
                            <p class="f-profile profile-data ">Fac</p>
                            <div class="spacer40">&nbsp;</div>
                            <p class="f-profile profile-text">Spécialité</p>
--}}
{{--
                            @foreach($user->science()->pluck('science_name') as $science_name)
                                <div class="my_profile_input d-inline-block">{{ $science_name }}</div>
                            @endforeach
--}}
                            {{--
                            <div class="spacer40">&nbsp;</div>
                            <input type="submit" class="yootyBTN yooty_color" value="Modifier le profil">
                            --}}
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
                    <div id="menuleft"><a href="{{ route('search-messages') }}" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Mon profil</span></div>
                    <div id="menucenter">&nbsp;</div>
                    <a href="{{ route('profiles.info') }}" class="black"><div id="menuright"><i class="fas fa-pencil-alt iconbottmenu"></i></div></a>
                </div>
            </div>
            <div class="spacer20">&nbsp;</div>

            <!-- main content -->
            <div class="container text-center">
                <div class="spacer40">&nbsp;</div>
                <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar">
                <div class="spacer20">&nbsp;</div>

{{--
                <p class="f-education_public_profile">{{ $user->education()->pluck('education')->implode(', ') }}</p>
--}}
                <span class="f-rate_public_profile d-block">
                    {{ Str::of($user->testimonial->avg('rating'))->limit(3, '/') }}5
                </span>
                <a href="{{ route('profiles.reviews', ['id' => $user->id]) }}" class="f-education_public_profile d-block black">
                    {{ $user->testimonial->count() }} avis
                </a>
                <div class="spacer20">&nbsp;</div>
                <p class="f-addinfo_public_profile">
                    <span>Temps de réponse moyen : 4h</span><br>
                    <span>Nombres d’annonces répondues: 15</span>
                </p>
                <div class="spacer10">&nbsp;</div>
                <div id="buttonInformation">INFORMATIONS</div><a href="{{ route('profiles.skills') }}" class="black"><div id="buttonCompte">COMPTE</div></a>
                <div class="spacer35">&nbsp;</div>
                <h1 class="f-name_list_profile caps ">{{ $user->name }} {{$user->surname}}</h1>
                <div class="spacer20">&nbsp;</div>
                @if($user->meta->count() > 0)
                    <p class="f-profile profile-text">Téléphone</p>
                    <p class="f-profile profile-data ">{{ $user->meta->phone }}</p>
                @else
                <!-- nothing load -->
                @endif
                <div class="spacer40">&nbsp;</div>
                <p class="f-profile profile-text">E-mail</p>
                <p class="f-profile profile-data ">{{ $user->email }}</p>
{{--
                <div class="spacer40">&nbsp;</div>
                <p class="f-profile profile-text">Niveau d’étude</p>
                <p class="f-profile profile-data ">Fac</p>
                <div class="spacer40">&nbsp;</div>
                <p class="f-profile profile-text">Spécialité</p>
--}}
{{--
                @foreach($user->science()->pluck('science_name') as $science_name)
                    <div class="my_profile_input d-inline-block">{{ $science_name }}</div>
                @endforeach
--}}
                <div class="spacer80">&nbsp;</div>
                <div class="spacer40">&nbsp;</div>
            </div>
        @endguest
    </div>
@endsection

@enddesktop
