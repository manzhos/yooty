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
                            <h1 class="f-name_list_profile caps">{{ $user->name }} {{$user->surname}}</h1>
                            <div class="spacer20">&nbsp;</div>
                            <form enctype="multipart/form-data" action="/change-avatar" method="POST">
                                <label for="upload_avatar">Mettre à jour l'image de profil</label>
                                <div class="text-center">
                                    <input hidden type="file" name="avatar" id="upload_avatar">
                                    <label class="f-reg underline" style="cursor: pointer;" for="upload_avatar">Load the image</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                                <div class="spacer40"></div>
                                <div>
                                    <input type="submit" class="yootyBTN yooty_color" value="Rafraîchir">
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection
