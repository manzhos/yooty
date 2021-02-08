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
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-8">
                    <!--  Link to back (on profile)  -->
                    <a href="{{ route('profiles.publicprofile', ['id' => $user->id, 'path' => $backpath]) }}" style="cursor: pointer;"><i class="fas fa-angle-left" style="font-size: 12px"></i><span style="padding-left: 5px; text-decoration: underline;">Retour</span></a>
                    <div class="spacer35">&nbsp;</div>

                    <h1 class="f-boldSE caps">Laisser un avis</h1>
                    <div class="spacer35"></div>
                    <form action="{{ route('testimonial.store', ['id' => $user->id]) }}" method="post" role="form" id="edit_testimonial_form">
                        @csrf
                        <textarea id="testimonial" name="testimonial" class="form-control-textarea text-left textarea-testimonial" placeholder="Vous pouvez en dire un peu plus sur lui.."></textarea>

                        <div class="spacer35">&nbsp;</div>
                        <!-- Star Rating of user -->
                        <div id="reviewStars-input" style=" left: 50%; margin-left: -128px;">
                            <input id="star-4" type="radio" name="rating" value="5" />
                            <label title="Exsellent" for="star-4"></label>

                            <input id="star-3" type="radio" name="rating" value="4" />
                            <label title="good" for="star-3"></label>

                            <input id="star-2" type="radio" name="rating" value="3" />
                            <label title="normal" for="star-2"></label>

                            <input id="star-1" type="radio" name="rating" value="2" />
                            <label title="no bad" for="star-1"></label>

                            <input id="star-0" type="radio" name="rating" value="1" />
                            <label title="bad" for="star-0"></label>
                        </div>
                        <div class="spacer35">&nbsp;</div>

                        <div class="spacer40">&nbsp;</div>
                        <input type="submit" class="yootyBTN yooty_color" value="Envoyer" />
                    </form>
                </div>
                <div class="col-md-2">&nbsp;</div>
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
            <div id="menuleft"><a href="{{ route('profiles.publicprofile', ['id' => $user->id, 'path' => $backpath]) }}" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Laisser un avis</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside text-center">
        <div class="spacer35">&nbsp;</div>
        <form action="{{ route('testimonial.store', ['id' => $user->id, 'path' => $backpath]) }}" method="post" role="form" id="edit_testimonial_form">
            @csrf
            <textarea id="testimonial" name="testimonial" class="form-control-textarea text-left textarea-testimonial" placeholder="Vous pouvez en dire un peu plus sur lui.."></textarea>

            <div class="spacer35">&nbsp;</div>
            <!-- Star Rating of user -->
            <div id="reviewStars-input" style=" left: 50%; margin-left: -128px;">
                <input id="star-4" type="radio" name="rating" value="5" />
                <label title="Exsellent" for="star-4"></label>

                <input id="star-3" type="radio" name="rating" value="4" />
                <label title="good" for="star-3"></label>

                <input id="star-2" type="radio" name="rating" value="3" />
                <label title="normal" for="star-2"></label>

                <input id="star-1" type="radio" name="rating" value="2" />
                <label title="no bad" for="star-1"></label>

                <input id="star-0" type="radio" name="rating" value="1" />
                <label title="bad" for="star-0"></label>
            </div>
            <div class="spacer35">&nbsp;</div>

            <div class="spacer40">&nbsp;</div>
            <input type="submit" class="yootyBTN yooty_color" value="Envoyer" />
        </form>

        <div class="spacer80">&nbsp;</div>

    </div>

@endsection


@enddesktop

