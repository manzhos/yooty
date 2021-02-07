@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')
<div class="container reg-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="spacer40"></div>
            <div>
                <div class="f-name_list_profile text-center caps">{{ __('mot de passe oublié') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row text-center">
                            <div class="spacer10">&nbsp;</div>
                            <div class="col-md-2">&nbsp;</div>
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                            <div class="col-md-8 text-center">
                                <input id="email" type="email" class="text-center form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">&nbsp;</div>
                            <div class="spacer20">&nbsp;</div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="yootyButt">
                                    {{ __('Envoyer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="spacer40"></div>
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

        <div class="container reg-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="spacer40"></div>
                    <div>
                        <div class="f-name_list_profile text-center caps">{{ __('mot de passe oublié') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row text-center">
                                    <div class="spacer10">&nbsp;</div>
                                    <div class="col-md-2">&nbsp;</div>
                                    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
                                    <div class="col-md-8 text-center">
                                        <input id="email" type="email" class="text-center form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="spacer20">&nbsp;</div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="yootyButt">
                                            {{ __('Envoyer') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="spacer40"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@enddesktop
