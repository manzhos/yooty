<!DOCTYPE html>

@desktop
<!-- Desktop view -->

@elsedesktop
<!-- Mobile view -->
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>YOOTY</title>

        <meta name="theme-color" content="#f6e34b"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/stylemob.css') }}"/>

        <link href="{{ asset('css/loaders.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/uploadPreviewer.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/numberinput.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/filtercheckbox.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/filterradio.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/payments.css') }}" rel="stylesheet" />

        <!-- NOTIFICATIONS -->
        <link href="{{ asset('css/notification.css') }}" rel="stylesheet" />

        <!-- FAVICON -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">

        <!-- MANIFEST -->
        <link rel="manifest" href="manifest.json" />

        <!-- Stripe -->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="{{ asset('lib/bootstrap.min.css') }}" />

        <!-- ICONS -->
        <script src="https://kit.fontawesome.com/11190384de.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    </head>

    <body>

        <!-- Checking if the user is blocked -->
        @auth
            @if(Auth::user()->role->blocked)
                <div class="blocked-user-screen">
                    <div v-if="showModal" class="container-popup">
                        <div class="container-note text-center">
                            <div class="text-center f-rate_public_profile">Votre compte</div>
                            <div class="spacer20"></div>
                            <h1 class="f-boldSE caps text-center">
                                {{Illuminate\Support\Facades\Auth::user()->name}}
                                {{ Str::substr(Illuminate\Support\Facades\Auth::user()->surname, 0, 1) }}
                            </h1>
                            <div class="spacer10"></div>
                            <div class="text-center f-rate_public_profile">bloqué</div>
                            <div class="spacer35"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="blank-button caps underline">{{ __('Déconnexion') }}</button>
                            </form>
                            <div class="spacer20"></div>
                            <a href="mailto:admin@yooty.fr" class="caps black underline f-14">Ecrire à l'administrateur</a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        <!-- Block for VUE scripts -->
        <div id="app">
        @guest
            <!-- user is undefined -->
        @else
            <!-- user is defined -->
                <popup-notification v-bind:id="{{Illuminate\Support\Facades\Auth::user()->id}}"></popup-notification>
                <i-coach-notification v-bind:id="{{Illuminate\Support\Facades\Auth::user()->id}}"></i-coach-notification>
            @endguest
        </div>

        @include('layouts.navmobtop')


        @yield('content')


        {{-- @include('layouts.navmobprofilbottom') --}}

        <!-- PWA -->
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker
                        .register('sw.js')
                        .then(registration => console.log(registration));
                });
            }
        </script>
{{--
        <script type="module">
            import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

            const el = document.createElement('pwa-update');
            document.body.appendChild(el);
        </script>
--}}


        <!-- Scrips for Bootstrap -->
        <script src="{{ asset('lib/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ asset('lib/popper.min.js') }}"></script>
        <script src="{{ asset('lib/bootstrap.min.js') }}"></script>
        {{--
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        --}}
        <!-- END Scrips for Bootstrap -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
    </html>
@enddesktop
