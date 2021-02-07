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
                            <p class="f-name_list_profile caps">Modifier ma minibio</p>
                            <div class="spacer40">&nbsp;</div>
                            <h1 class="f-name_minibio caps text-center">{{ $user->name }} {{$user->surname}}</h1>
                            <div class="spacer20">&nbsp;</div>
                            <form action="{{route('profiles.update-minibio')}}" method="post" role="form" id="edit_user_minibio_form">
                                @csrf
                                {{-- method_field('put') --}}
                                @if(isset($user->meta))
                                    <textarea id="minibio" name="minibio" class="form-control-textarea text-left textarea-minibio" placeholder="Pouvez-vous nous parler un peu de vous.."> {{ $user->meta->minibio }} </textarea>
                                @else
                                    <textarea id="minibio" name="minibio" class="form-control-textarea text-left textarea-minibio" placeholder="Pouvez-vous nous parler un peu de vous..">Pouvez-vous nous parler un peu de vous..</textarea>
                                @endif
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
@endsection





