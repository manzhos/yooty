@extends('yooty')

@section('content')

    <!--  Link to back  -->
    <div class="container topblock">
        <div class="row">
            <div class="col-md-12">
                <div style="padding-top: 20px; padding-left: 5vw;">
                    <a onclick="javascript:history.back(); return false;" style="cursor: pointer;">< <span style="padding-left: 10px; text-decoration: underline;">Retour au profil</span></a>
                </div>
            </div>
        </div>
    </div>

    <!--  Body of review list -->
    <div class="container">

        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <h1 class="f-boldSE caps">Avis</h1>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="spacer40">&nbsp;</div>

        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-5" style="padding-right: 4vw;">
                <img src="{{ asset('/images/Star.svg') }}" width="44" height="40" class="d-inline-block" style="margin-top: -15px; margin-left: 8px;" />
                <div class="spacer10_left"></div>

                <h2 class="f-avis-h2 d-inline-block">
                    @if($user->testimonial->count() > 0)
                        {{ Str::of($user->testimonial->avg('rating'))->limit(3, '/') }}5 - {{ $user->testimonial->count() }} Avis
                    @else
                        Aucun avis
                    @endif
                </h2>

                <div class="spacer20"></div>
                <ul class="review-block">
                    <li class="review review-item line position-relative">
                        <span class="position-absolute">Parfait</span>
                        <span class="review-count">{{ $user->testimonial->where('rating','=','5')->count() }}</span>
                    </li>
                    <li class="review review-item line position-relative">
                        <span class="position-absolute">Très bien</span>
                        <span class="review-count">{{ $user->testimonial->where('rating','=','4')->count() }}</span>
                    </li>
                    <li class="review review-item line position-relative">
                        <span class="position-absolute">Bien</span>
                        <span class="review-count">{{ $user->testimonial->where('rating','=','3')->count() }}</span>
                    </li>
                    <li class="review review-item line position-relative">
                        <span class="position-absolute">Décevant</span>
                        <span class="review-count">{{ $user->testimonial->where('rating','=','3')->count() }}</span>
                    </li>
                    <li class="review review-item position-relative">
                        <span class="position-absolute">A éviter</span>
                        <span class="review-count">{{ $user->testimonial->where('rating','=','1')->count() }}</span>
                    </li>
                </ul>

            </div>
            <div class="col-md-5">
                <div class="spacer60">&nbsp;</div>
                @if($user->testimonial->count() > 0)
                    @include('testimonials.userreviews')
                @else
                    &nbsp;
                @endif
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="row"><div class="col-md-12"><div class="spacer80">&nbsp;</div></div></div>
        <div class="row"><div class="col-md-12"><div class="spacer80">&nbsp;</div></div></div>

    </div>

@endsection
