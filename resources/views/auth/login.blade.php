@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center reg-container">
            <div class="col-md-12">
                <div class="reg-card">
                    <div class="reg-header f-boldSE">{{ __('Se connecter') }}</div>
                    <div class="spacer20"></div>
                    <div class="reg-txt f-reg">{{ __('Connexion avec') }}</div>
                    <div class="spacer10"></div>
                    <div style="text-align: center;">
                        <a href="{{ route('auth.social', 'facebook') }}" title="Facebook" class="yootyBTN social-btn-login txt_white facebook_color"><i class="fab fa-facebook-f"></i> Continue avec Facebook</a>
                        <a href="{{ route('auth.social', 'google') }}" title="Google" class="yootyBTN social-btn-login txt_white google_color"><i class="fab fa-google"></i> Continue avec Google</a>
                        {{--
                        <a href="{{ route('auth.social', 'twitter') }}" title="Twitter" class="yootyBTN txt_white twitter_color"><i class="fab fa-twitter"></i> Twitter</a>
                        <div class="spacer20_right"></div>
                        --}}

                        <!-- Snapchat registration -->
                        <div>
                            <div id="sc-login-button"></div>
                            <div id="sc-profile" class="sc-hidden">
                                <img id="sc-picture" src="#" />
                                <p id="sc-welcome">Welcome!</p>
                            </div>
                        </div>


                    </div>
                    {{--
                    <div style="text-align: center;">
                        <div class="spacer20"></div>
                        <a href="{{ route('auth.social', 'github') }}" title="Github" class="yootyBTN txt_white facebook_color">GITHUB</a>
                        <div class="spacer20"></div>
                    </div>
                    --}}
                    <div class="spacer20"></div>
                    <div class="reg-txt f-reg">{{ __('OU') }}</div>
                    <div class="spacer20"></div>
                    <div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Souviens-toi de moi') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="spacer20"></div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="yootyButt menu-txt">
                                        {{ __('Connexion') }}
                                    </button>
                                </div>
                                <div class="spacer60"></div>
                                <div class="row col-md-12" style="text-align: center;">
                                        <div class="col-md-12">
                                            <span>
                                                Pas encore membre ? <a href="{{ route('register') }}">Inscription</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                            </span>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">
                                                    {{ __('Mot de passe oublié?') }}
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Snapchat registration -->
<script src="{{ asset('/js/snap_kit.js') }}"></script>


@elsedesktop

<!-- Mobile view -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>YOOTY</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/stylemob.css') }}"/>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">

    <!-- MANIFEST -->
    <link rel="manifest" href="manifest.json" />

    <!-- PWA -->
    <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

        const el = document.createElement('pwa-update');
        document.body.appendChild(el);
    </script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- ICONS -->
    <script src="https://kit.fontawesome.com/11190384de.js" crossorigin="anonymous"></script>

</head>

<body background="#f6e34b" style="background: #f6e34b;">
    <div class="container-mob text-center">
        <img src="{{ asset('/images/YootyBlack.svg') }}" class="loginLogo-mob" alt="YOOTY">

        <div class="reg-card">
            <div style="text-align: center;">
                <a href="{{ route('auth.social', 'facebook') }}" title="Facebook" class="yootyBTN social-btn-login txt_white facebook_color"><i class="fab fa-facebook-f"></i> Continue avec Facebook</a>
                <a href="{{ route('auth.social', 'google') }}" title="Google" class="yootyBTN social-btn-login txt_white google_color"><i class="fab fa-google"></i> Continue avec Google</a>

            <!-- Snapchat registration -->
                <div>
                    <div id="sc-login-button"></div>
                    <div id="sc-profile" class="sc-hidden">
                        <img id="sc-picture" src="#" />
                        <p id="sc-welcome">Welcome!</p>
                    </div>
                </div>


            </div>
            <div class="reg-txt f-reg">{{ __('OU') }}</div>
            <div>
                <form method="POST" action="{{ route('login') }}" class="email-form-mob">
                    @csrf
                    <div class="form-group">
                        {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label> --}}

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label> --}}

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                        <div style="font-size: 12px; text-align: right; width: 100%; margin: 5px 0;">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="black underline">{{ __('Mot de passe oublié?') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check text-center">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label f-reg" for="remember">
                                {{ __('Souviens-toi de moi') }}
                            </label>
                        </div>
                    </div>

                    <div class="spacer10"></div>

                    <div class="form-group">
                        <button type="submit" class="yootyButtWhite menu-txt">
                            {{ __('Connexion') }}
                        </button>
                        <div class="spacer6x"></div>
                        <div class="col-md-12">
                            <span class="reg-txt caps">
                                Pas encore membre ? <a href="{{ route('register') }}" class="black underline">Inscription</a>
                            </span>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>


    <script src="{{ asset('/js/snap_kit.js') }}"></script>
</body>
</html>

@enddesktop

