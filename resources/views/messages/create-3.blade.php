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
                <div class="col-md-12">
                    <h1 class="f-boldSE caps">ça y est, vous pouvez payer&nbsp;!</h1>
                </div>
            </div>
            <div class="spacer40"></div>

            <!-- Progress Block -->
            <div class="row-cols-4">
                <div class="col d-inline-block">
                    <h3 class="f-boldSE caps lightgrey">étape 1</h3>
                </div>
                <div class="col d-inline-block">
                    <h3 class="f-boldSE caps lightgrey">étape 2</h3>
                </div>
                <div class="col d-inline-block">
                    <h3 class="f-boldSE caps">étape 3</h3>
                </div>
                <div class="col d-inline-block">
                    <h3 class="f-boldSE caps"></h3>
                </div>
            </div>
            <div class="row-cols-4">
                <div class="col d-inline-block" style="vertical-align: center;">
                    <div class="progression position-absolute"></div>
                    <div class="rond position-absolute"></div>
                </div>
                <div class="col d-inline-block" style="vertical-align: center;">
                    <div class="progression position-absolute"></div>
                    <div class="rond position-absolute"></div>
                </div>
                <div class="col d-inline-block" style="vertical-align: center;">
                    <div class="progression position-absolute"></div>
                    <div class="rond position-absolute"></div>
                </div>
            </div>
            <!-- End Progress Block -->
            <div class="spacer60"></div>


            <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                {{ csrf_field() }}
                <div class="form-row row">
                    <div class="col-md-6">
                        <label for="card-element" class="f-reg">
                            Entrez le numéro de carte s'il vous plaît
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <input class="hidden" type="number" id="cost" name="cost" value="{{ $cost }}">
                        <input class="hidden" type="number" id="message_id" name="message_id" value="{{ $message_id }}">
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="spacer35"></div>
                        <button class="yootyButt">
                            <div class="spinner hidden" id="spinner"></div>
                            <img src="{{ asset('images/Lock.svg') }}" class="d-inline-block" width="20px" height="auto">
                            <div class="spacer10_left"></div> Payer {{ $cost }}&#8364
                        </button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </form>

        </div>

    @endguest

    <script> var publishable_key = '{{ $pk }}';</script>
    <script src="{{ asset('/js/card.js') }}"></script>

@endsection


@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Poser&nbsp;votre&nbsp;question</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>

    <div class="container-mob-content">
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
            <h3 class="f-boldSE caps text-center">étape 3</h3>
            <div class="spacer10"></div>

            <h2 class="f-boldSE caps text-left">ça y est, vous<br />pouvez payer !</h2>

            <div class="spacer40"></div>

            <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                @csrf
                <div class="text-center">
                    <label for="card-element" class="f-reg">
                        Entrez le numéro de carte s'il vous plaît
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <input class="hidden" type="number" id="cost" name="cost" value="{{ $cost }}">
                    <input class="hidden" type="number" id="message_id" name="message_id" value="{{ $message_id }}">
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="spacer35"></div>
                <div class="text-center">
                    <button class="yootyButt">
                        <div class="spinner hidden" id="spinner"></div>
                        <img src="{{ asset('images/Lock.svg') }}" class="d-inline-block" width="20px" height="auto">
                        <div class="spacer10_left"></div> Payer {{ $cost }}&#8364
                    </button>
                </div>
            </form>

            <div class="spacer80"></div>

            <div class="text-center">
                <div class="create-circle active d-inline-block"></div>
                <div class="create-circle active d-inline-block"></div>
                <div class="create-circle active d-inline-block"></div>
            </div>
            <div class="spacer80"></div>
        @endguest
    </div>

    <script> var publishable_key = '{{ $pk }}';</script>
    <script src="{{ asset('/js/card.js') }}"></script>

@endsection

@enddesktop
