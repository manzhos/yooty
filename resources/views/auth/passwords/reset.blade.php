@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')
<div class="container reg-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="f-name_list_profile text-center caps">{{ __('mot de passe oublié') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            <div class="col-12 text-center">
                                {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus> --}}
                                <div id="email" type="email" class="f-name_public_profile">{{ $email }}</div>
                                {{--
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                --}}
                            </div>
                        </div>

                        <div class="spacer20">&nbsp;</div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="spacer35">&nbsp;</div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="yootyButt">
                                    {{ __('Réinitialiser le mot de passe') }}
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

@extends('yootymob')

@section('content')
    <div class="container-mob-inside">
        <!-- menu button in menu-line -->
        <div class="mobMenu-blank">
            <div class="position-relative">
                <a href="{{ url('profile') }}" class="black"><div id="menuleft"><i class="fas fa-user-circle"></i></div></a>
                <div id="menucenter"><img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo-mob" alt="YOOTY"></div>
                <a href="{{ route('search-messages') }}" class="black"><div id="menuright"><i class="far fa-comment-dots iconbottmenu"></i></div></a>
            </div>
        </div>
        <div class="spacer40">&nbsp;</div>


        <div class="f-name_list_profile text-center caps">{{ __('mot de passe oublié') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                    <div class="col-12 text-center">
                        {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus> --}}
                        <div id="email" type="email" class="f-name_public_profile">{{ $email }}</div>
                        {{--
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        --}}
                    </div>
                </div>

                <div class="spacer20">&nbsp;</div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                    <div class="col-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez le mot de passe') }}</label>

                    <div class="col-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="spacer35">&nbsp;</div>

                <div class="form-group row mb-0">
                    <div class="col-12 text-center">
                        <button type="submit" class="yootyButt">
                            {{ __('Réinitialiser le mot de passe') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection


@enddesktop
