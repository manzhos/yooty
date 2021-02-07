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
                            <p class="f-name_list_profile caps">Ajouter/modifier mes coordonnées bancaires</p>
                            <div class="spacer35">&nbsp;</div>
                            @include('layouts.partials.error')
                            @include('layouts.partials.success')
                            <!-- Stripe - save the card for next payments -->
                            <form action="{{ route('stripe.save') }}" method="post" id="payment-form">
                                @csrf
                                <div class="text-center">
                                    <label for="card-element" class="f-reg">
                                        Entrez le numéro de carte s'il vous plaît
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <input class="hidden" type="number" id="user_id" name="user_id" value="{{ $user->id }}">
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                <div class="spacer35"></div>
                                <div class="text-center">
                                    <button type="submit" class="yootyButt">
                                        <div class="spinner hidden" id="spinner"></div>
                                        <span>Sauvez la carte</span>
                                    </button>
                                    <div class="spacer20">&nbsp;</div>
                                    <p class="add-info-message-list">Votre paiement vous sera retourné immédiatement</p>
                                </div>
                            </form>

                            <!-- Stripe - TEST payment with saved user payment data -->
{{--
                            <form action="{{ route('stripe.testpay') }}" method="post" id="payment-form">
                                @csrf
                                <div class="text-center">
                                    <input class="hidden" type="number" id="user_id" name="user_id" value="{{ $user->id }}">
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                <div class="spacer35"></div>
                                <div class="text-center">
                                    <button type="submit" class="yootyButt">
                                        <div class="spinner hidden" id="spinner"></div>
                                        <span>Payer 100</span>
                                    </button>
                                    <div class="spacer20">&nbsp;</div>
                                </div>
                            </form>
--}}

                        </div>

                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest

    <script> var publishable_key = '{{ env('STRIPE_KEY') }}';</script>
    <script src="{{ asset('/js/card.js') }}"></script>

{{--

    <script type="text/javascript">
        // This identifies your website in the createToken call below
        Stripe.setPublishableKey('{{ env("STRIPE_KEY") }}');
        var stripeResponseHandler = function(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and re-submit
                $form.get(0).submit();
            }
        };
        jQuery(function($) {
            $('#payment-form').submit(function(e) {
                var $form = $(this);
                // Disable the submit button to prevent repeated clicks
                $form.find('button').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from submitting with the default action
                return false;
            });
        });
    </script>
--}}



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
        <div class="spacer80">&nbsp;</div>
        <div class="text-center">
            <p class="f-name_list_profile caps">Ajouter/modifier mes<br>coordonnées bancaires</p>
        </div>
    @endguest
@endsection


@enddesktop
