@extends('yooty')

@section('content')

    <div class="container reg-container">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3"><span class="not-ok-ico"><i class="fas fa-times-circle"></i></span></div>
                    <div class="col-md-9">
                        <div class="spacer20"></div>
                        <h1 class="f-boldSE caps">Choisissez au moins<br>un prof particulier</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="spacer40"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                {{--<h1 class="f-boldSE caps">Vous recevrez une<br />réponse sous 24h</h1>--}}
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="spacer40"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <form action="{{ route('searchcoach') }}">
                    <button class="yootyButt"><span class="menu-txt">Retourner à la recherche</span></button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>

    <div class="spacer80"></div><div class="spacer40"></div>

@endsection
