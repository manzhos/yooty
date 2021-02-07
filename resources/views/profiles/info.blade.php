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

                        <div class="col-md-1">&nbsp;</div>

                        <div class="col-md-4 text-center">
                            <form action="{{route('users.update', ['id' => $user->id])}}" method="post" role="form" id="edit_user_info_form">
                                @csrf
                                {{--method_field('put')--}}
                                <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar">
                                <div class="spacer20">&nbsp;</div>

                                <input type="text" id="name" name="name" class="f-name_list_profile caps my_profile_input text-center w-100" value="{{ $user->name }}" />
                                <input type="text" id="surname" name="surname" class="f-name_list_profile caps my_profile_input text-center w-100" value="{{ $user->surname }}" />
                                <div class="spacer20">&nbsp;</div>

                                <p class="f-profile profile-text">Téléphone</p>
                                @if(isset($user->meta))
                                    <input type="text" id="phone" name="phone" class="f-profile profile-input my_profile_input text-center w-100" value="{{ $user->meta->phone }}" />
                                @else
                                    <input type="text" id="phone" name="phone" class="f-profile profile-input my_profile_input text-center w-100" value=" " />
                                @endif
                                <div class="spacer20">&nbsp;</div>

                                <p class="f-profile profile-text">E-mail</p>
                                <input type="text" id="email" name="email" class="f-profile profile-input my_profile_input text-center w-100" value="{{ $user->email }}" />
                                <div class="spacer20">&nbsp;</div>

                                <div class="spacer40">&nbsp;</div>
                                <input type="submit" class="yootyBTN yooty_color" value="Modifier le profil">
                            </form>
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

                </div>
            </div>
            <div class="spacer20">&nbsp;</div>


            <div class="text-center">
                <div class="spacer40">&nbsp;</div>
                <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar">

                <form enctype="multipart/form-data" action="/change-avatar-mob" method="POST">
                    <div>
                        <input type="file" hidden name="avatar" id="upload_avatar">
                        <label for="upload_avatar" class="d-inline-block position-relative" style="width: 35vw; max-width: 150px;">
                            <span><div class="edit-avatar-btn position-absolute edit-avatar-btn-pos"><i class="fas fa-pencil-alt"></i></div></span>
                        </label>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="d-inline-block text-center blank-button add-info-message-list underline" value="Rafraîchir">
                    </div>
                </form>

                <div class="spacer20">&nbsp;</div>

                <form action="{{route('users.update', ['id' => $user->id])}}" method="post" role="form" id="edit_user_info_form" class="editinfomob">
                    @csrf
                    <button type="submit" href="{{ route('profiles.info') }}" class="blank-button"><div id="menuright"><i class="far fa-save topmobsumit"></i></div></button>
                    <input type="text" id="name" name="name" class="f-name_list_profile caps my_profile_input text-center w-100" value="{{ $user->name }}" />
                    <input type="text" id="surname" name="surname" class="f-name_list_profile caps my_profile_input text-center w-100" value="{{ $user->surname }}" />
                    <div class="spacer20">&nbsp;</div>

                    <p class="f-profile profile-text">Téléphone</p>
                    @if(isset($user->meta))
                        <input type="text" id="phone" name="phone" class="f-profile profile-input my_profile_input text-center w-100" value="{{ $user->meta->phone }}" />
                    @else
                        <input type="text" id="phone" name="phone" class="f-profile profile-input my_profile_input text-center w-100" value=" " />
                    @endif
                    <div class="spacer20">&nbsp;</div>

                    <p class="f-profile profile-text">E-mail</p>
                    <input type="text" id="email" name="email" class="f-profile profile-input my_profile_input text-center w-100" value="{{ $user->email }}" />
                    <div class="spacer20">&nbsp;</div>

                    <div class="spacer40">&nbsp;</div>
                    <input type="submit" class="yootyBTN yooty_color" value="Modifier le profil">
                </form>
            </div>
            <div class="spacer80">&nbsp;</div>
            <div class="spacer40">&nbsp;</div>
        @endguest
    </div>

<!-- Droplist logic -->
<script src="{{ asset('js/droplist.js') }}" ></script>

<!----- Upload Icon styling ----->
<script src="{{ asset('js/uploadIcon.js') }}"></script>


@endsection


@enddesktop

