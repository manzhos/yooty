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

                        <div class="col-md-7 text-center">
                            <p class="f-name_list_profile caps">Voir mes abonnements en cours</p>
                            <div class="spacer20">&nbsp;</div>
                            <table class="table text-left">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center">Durée</th>
                                    <th scope="col" class="text-right">Compétence</th>
                                </tr>
                                </thead>
                                @foreach($students as $student)
                                <tr>
                                    @if(null !== $student[0])
                                        <td scope="row">{{$student[0]->name}} {{ Str::substr($student[0]->surname, 0, 1) }}</td>
                                        <td class="text-center">{{ $student[1] }}</td>
                                        <td class="text-right">{{ \App\Models\Science::find(\App\Models\Userprof::find($student[2])->science_id)->science_name }} -
                                            {{ \App\Models\Education::find(\App\Models\Userprof::find($student[2])->education_id)->education }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </table>

                        </div>

                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
@endsection


@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft">
                <a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a>
                <span class="caps f-boldSE d-inline-block">&nbsp;</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
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
        <div class="container">
            <div class="row">
                <div class="col-1">&nbsp;</div>
                <div class="col-10">
                    <p class="f-name_list_profile caps">Voir mes abonnements<br>en cours</p>
                    <div class="spacer10">&nbsp;</div>
                    <table class="table text-left">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Durée</th>
                            <th scope="col">Compétence</th>
                        </tr>
                        </thead>
                        @foreach($students as $student)
                            <tr>
                                @if(null !== $student[0])
                                    <td scope="row">{{$student[0]->name}} {{ Str::substr($student[0]->surname, 0, 1) }}</td>
                                    <td>{{ $student[1] }}</td>
                                    <td>{{ \App\Models\Science::find(\App\Models\Userprof::find($student[2])->science_id)->science_name }} -
                                        {{ \App\Models\Education::find(\App\Models\Userprof::find($student[2])->education_id)->education }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endguest
@endsection


@enddesktop


