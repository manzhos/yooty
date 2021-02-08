@desktop
<!-- Desktop view -->


@extends('yooty')

@section('content')

@guest
    <div class="container reg-container text-center">
        <div class="row">
            <div class="col-md-12">
                <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                <br />
                <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
            </div>
        </div>
    </div>
@else
    <div class="container reg-container">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <h1 class="f-boldSE caps"> Rechercher<br />un prof particulier </h1>
                <div class="spacer40">&nbsp;</div>
                <form action="{{ route('apply.coach') }}" method="post">
                    @csrf
                    <div class="row">
                            <div class="col-md-7">
                                <p class="f-boldSE">Résultat</p>
                                @php
                                    $count_user = 0;
                                    foreach($users as $user) {
                                        if ($user->id !== Illuminate\Support\Facades\Auth::user()->id) $count_user ++;
                                        }
                                @endphp
                                <p class="f-profile ">{{ $count_user }} profs correspondent à ta recherche</p>
                                @if(Session::has('message'))
                                    {{Session::get('message')}}
                                @endif
                                <div class="spacer20">&nbsp;</div>
                                @foreach($users as $user)
                                    @if ($user->id !== Illuminate\Support\Facades\Auth::user()->id)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="spacer10">&nbsp;</div>

                                                <a href="{{ route('profiles.publicprofile', ['id' => $user->id]) }}" class="black" style="text-decoration: none;">
                                                {{--<a onclick="location.href='/profile/publicprofile/{{$user->id}}?path='+window.location.href" class="black" style="text-decoration: none;">--}}
                                                    <img src="/uploads/avatars/{{ $user->avatar }}" class="coach-list-avatar">
                                                    <div class="d-inline-block" style="width: calc(100% - 175px);">
                                                        <p class="f-name_list_profile caps"><br />{{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</p>
                                                        @foreach($user->userprof as $skill)
                                                            <div class="row align-items-center">
                                                                <div class="col-12 text-left">
                                                                    <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                                                    <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </a>
                                                <div class="d-inline-block coach-check">
                                                    <input type="checkbox" name="user[]" id="{{$user->id}}" value="{{$user->id}}" class="css-checkbox">
                                                    <label for="{{$user->id}}" name="{{$user->id}}_lbl" class="f-reg css-label check-x"></label>
                                                </div>
                                                <input type="hidden" name="duration" value="{{$duration}}">
                                                @foreach($userprof_ids as $userprof)
                                                    @if($userprof->user_id === $user->id)
                                                        <div class="hidden">{{$userprof_id = $userprof->id}}</div>
                                                    @endif
                                                @endforeach
                                                <input type="hidden" name="userprof_ids[]" value="{{ $userprof_id }}">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-5">
                                <div class="spacer40"></div>
                                @if($count_user > 0)
                                    <button type="submit" class="yootyButt">Choisir</button>
                                @endif
                            </div>
                    </div>
                </form>
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
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Rechercher un prof</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    @guest
        <div class="container reg-container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                    <br />
                    <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                </div>
            </div>
        </div>
    @else
        <div class="container-mob-inside pad-inside">
            <div class="spacer20">&nbsp;</div>
            <h2 class="f-boldSE caps text-center"> Résultat </h2>
            @php
                $count_user = 0;
                foreach($users as $user) {
                    if ($user->id !== Illuminate\Support\Facades\Auth::user()->id) $count_user ++;
                    }
            @endphp
            <p class="f-profile text-center">{{ $count_user }} profs correspondent à ta recherche</p>
            <form action="{{ route('apply.coach') }}" method="post">
                @csrf
                @if(Session::has('message'))
                    {{Session::get('message')}}
                @endif
                <div class="spacer20">&nbsp;</div>
                @foreach($users as $user)
                    @if ($user->id !== Illuminate\Support\Facades\Auth::user()->id)
                        <hr>
                        <div class="spacer10">&nbsp;</div>
{{--
                        <a href="{{ route('profiles.publicprofile', $user->id) }}" class="black" style="text-decoration: none;">
--}}
                        <a onclick="location.href='/profile/publicprofile/{{$user->id}}?path='+window.location.href" class="black" style="text-decoration: none;">
                            <img src="/uploads/avatars/{{ $user->avatar }}" class="coach-list-avatar">
                            <div class="d-inline-block" style="width: calc(100% - 175px);">
                                <p class="f-name_list_profile caps"><br />{{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</p>
                                @foreach($user->userprof as $skill)
                                    <div class="row align-items-center">
                                        <div class="col-12 text-left">
                                            <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                            <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </a>
                        <div class="d-inline-block coach-check">
                            <input type="checkbox" name="user[]" id="{{$user->id}}" value="{{$user->id}}" class="css-checkbox">
                            <label for="{{$user->id}}" name="{{$user->id}}_lbl" class="f-reg css-label check-x"></label>
                        </div>
                        <input type="hidden" name="duration" value="{{$duration}}">
                    @endif
                @endforeach
                <hr>
                <div class="spacer40"></div>
                <div class="text-center">
                    @if($count_user > 0)
                        <button type="submit" class="yootyButt">Choisir</button>
                    @endif
                </div>
                <div class="spacer80">&nbsp;</div>
                <div class="spacer60">&nbsp;</div>
            </form>
        </div>
    @endguest
@endsection


@enddesktop
