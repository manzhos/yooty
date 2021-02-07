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
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-8">
                    <h1 class="f-boldSE caps">Laisser un avis</h1> <!--Modifiez votre compte-->
                    <!-- <div id="alert"></div> -->
                    <div class="spacer40">&nbsp;</div>
                        <p class="f-name_list_profile">Commentaire</p>
                        <div class="spacer40">&nbsp;</div>
                        <h1 class="f-name_minibio caps text-left">{{ $user->name }} {{$user->surname}}</h1>
                        <div class="spacer20">&nbsp;</div>
                        <form action="{{route('profiles.add-testimonial')}}" method="post" role="form" id="edit_testimonial_form">
                            @csrf
                            {{-- method_field('put') --}}
                            @if(isset($user->meta))
                                <textarea id="testimonial" name="testimonial" class="form-control-textarea text-left textarea-minibio" placeholder=""> {{ $user->meta->minibio }} </textarea>
                            @else
                                <textarea id="testimonial" name="testimonial" class="form-control-textarea text-left textarea-minibio" placeholder="">Pouvez-vous nous parler un peu de l'enseignant?</textarea>
                            @endif
                            <div class="spacer40">&nbsp;</div>
                            <input type="submit" class="yootyBTN yooty_color" value="Envoyer">
                        </form>
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection





