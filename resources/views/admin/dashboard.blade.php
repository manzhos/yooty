@extends('admin.layouts.yooty-admin')

@section('content')
    @guest
        <div class="container text-center">
            <div class="admin-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                        <br />
                        <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container admin-container">
            <div class="row">
                <div class="col">
                    <h2 class="f-boldSE caps">dashboard</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    @include('layouts.partials.error')
                    @include('layouts.partials.success')
                    @include('layouts.partials.error-message')
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <p class="text-center" style="color: magenta">You are not administrator</p>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection
