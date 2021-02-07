@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')
<div class="container">
    <div class="row justify-content-center reg-container">
        <div class="col-md-12">
            <div class="reg-card">
                <div class="reg-header f-boldSE">{{ __('S’inscrire') }}</div>
                <div class="spacer20"></div>
                <div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label> --}}

                            <div class="col-md-12">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus placeholder="Nom">

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label> --}}
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Prénom">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="spacer20"></div>

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label> --}}
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label> --}}
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation mot de passe') }}</label> --}}
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation mot de passe">
                            </div>
                        </div>

                        <div class="spacer40"></div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="yootyButt menu-txt">
                                    {{ __('Inscription') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
    <a href="/"><img src="{{ asset('/images/YootyBlack.svg') }}" class="loginLogo-mob" alt="YOOTY"></a>

    <div class="reg-card">
        <div class="main-txt">{{ __('S’inscrire') }}</div>
        <div class="spacer10"></div>
        <div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    {{-- <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label> --}}
                    <div>
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus placeholder="Nom">

                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label> --}}
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Prénom">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="spacer20"></div>

                <div class="form-group">
                    {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label> --}}
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label> --}}
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation mot de passe') }}</label> --}}
                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation mot de passe">
                    </div>
                </div>

                <div class="spacer40"></div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="yootyButtWhite menu-txt">
                            {{ __('Inscription') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>

@enddesktop
