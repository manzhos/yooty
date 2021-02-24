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
    <!-- Block for VUE scripts -->
    <div class="hidden" id="drop"></div>
    <div class="hidden" id="pop"></div>
    <div class="hidden" id="popassist"></div>

    <div class="conversation-container">
        <div class="row">
            <!-- Conversations list -->
            <div class="col-sm-6">
                <h1 class="f-boldSE caps"> Conversations </h1>

                <!-- Search form -->
                <div class="spacer10"></div>
                <form action="{{ route('searchconversation') }}" method="post">
                    @csrf
                    <div class="conv-search">
                        <button class="blank-button" type="submit"><i class="fas fa-search d-inline-block"></i></button>
                        <input class="conv-search-txt d-inline-block" type="text" name="search" placeholder="Rechercher" />
                        <a class="d-inline-block black" href="{{ route('messagelist-conv') }}"><i class="far fa-times-circle"></i></a>
                    </div>
                </form>

                <div class="spacer35"></div>
                @include('conversations.conversations-list')
            </div>
            <!-- Conversation window -->
            <div class="col-sm-6" style="padding-left: 20px">
                @php
                    $message = App\Models\Message::find($selected_message);
                    $icon_message = 'student';
                @endphp
                @if($selected_message !== "null" AND DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first() != null)
                    <div class="conv-container">
                        <!-- check for subscription OR no -->
                        @forelse($coach_pairs as $coach_pair)
                            @if(Illuminate\Support\Facades\Auth::user()->id == $coach_pair->coach_id and $coach_pair->student_id == $message->user_id)
                                @php
                                    // the active user is coach for this message and have subscription
                                    $icon_message = 'coach';
                                @endphp
                            @elseif(Illuminate\Support\Facades\Auth::user()->id == $coach_pair->student_id
                                    and Illuminate\Support\Facades\Auth::user()->id == $message->user_id
                                    and DB::table('message_user')->where('message_id', $message->id)->where('user_id', $coach_pair->coach_id)->where('assistant', 1)->count() > 0)
                                @php
                                    // the active user is student for this message and have subscription
                                    $icon_message = 'student';
                                @endphp
                            @endif
                        @empty
                        @endforelse

                        <!-- head of dialog for message -->
                        <div class="w-100 conv-head position-relative">
                            <div id="assistant" class="position-absolute conv-head-assistant">
                                @if($message->user_id != Illuminate\Support\Facades\Auth::user()->id)
                                    <div class="f-name_list_profile caps d-inline-block">{{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}</div>
                                    @php
                                        // the active user is student for this message and have subscription
                                        $icon_message = 'student';
                                    @endphp
                                @else
                                    @php
                                        $assist = DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first()->user_id;
                                        $assistant = \App\Models\User::find($assist);
                                        $icon_message = 'coach';
                                    @endphp
                                    <div class="f-name_list_profile caps d-inline-block">{{ $assistant->name }}&nbsp;{{ Str::substr($assistant->surname, 0, 1) }}</div>
                                @endif
                                <div class="spacer20_right">&nbsp;</div>
                                <div class="review-head d-inline-block" style="padding-top: 3px;">
                                    @if($message->user->isOnline())
                                        <span>En ligne</span>
                                    @else
                                        <span style="color:#D01A33;">Hors ligne</span>
                                    @endif
                                </div>
                            </div>
                            <div id="icons" class="position-absolute conv-head-icons">
                                @if(!$message->meta->terminate)
                                    @switch($icon_message)
                                        @case('coach')
                                            <a id="already_tutor_link" href="#" class="d-inline-block" data-tooltip="Votre professeur particulier.">
                                                <img src="/images/ac_hat.svg" width="30" height="30" style="margin-left: 5px" />
                                            </a>
                                        @break
                                        @case('student')
                                            <a id="be_my_tutor_link" href="#" class="tutor-popup-open d-inline-block" data-tooltip="Offre de devenir professeur particulier." >
                                                <img src="/images/books.svg" width="30" height="30" style="margin-left: 5px" />
                                            </a>
                                        @break
                                        @default
                                            <a id="be_my_tutor_link" href="#" class="tutor-popup-open d-inline-block" data-tooltip="Offre de devenir professeur particulier." >
                                                <img src="/images/books.svg" width="30" height="30" style="margin-left: 5px"/>
                                            </a>
                                    @endswitch
                                    <a id="alert" href="#" class="alert-popup-open d-inline-block" data-tooltip="Terminer le chat ou signalez la violation." >
                                        <img src="/images/alert.svg" width="26" height="26" class="d-inline-block" style="margin-left: 20px"/>
                                    </a>
                                @endif
                                <a id="close-conv" href="/conversations" class="d-inline-block" data-tooltip="Fermer la fenêtre de chat" >
                                    <img src="/images/close.svg" width="26" height="26" class="d-inline-block" style="margin-left: 15px" />
                                </a>
                            </div>
                        </div>
                        <div class="container conv-subhead">
                            <div class="row" style="padding: 11px 15px;">
                                <div id="assistant" class="col-7">
                                    @if($message->user_id != Illuminate\Support\Facades\Auth::user()->id && !$message->meta->terminate)
                                        <div class="f-name_list_profile caps d-block">Professeur particulier</div>
                                        <div class="d-block">
                                            <a onclick="location.href='/profile/publicprofile/{{ $message->user->id }}?assistance=no&path='+window.location.href" style="cursor: pointer;">
                                                <span class="f-tarif black blank-button underline" >Voir le profil</span></a>
                                        </div>
                                    @else
                                        <div class="d-block">&nbsp;</div>
                                    @endif
                                </div>
                                <div id="icons" class="col-5">
                                    <div class="text-left position-relative">
                                        <div class="review-head d-block position-relative">Période d’essai</div>
                                        <div class="add-info-message-list d-block position-relative">
                                            <span class="caps">Temps restant</span>
                                            @php
                                                $dt_end = \Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
                                                if($dt_end)
                                                    {
                                                        $dt_end = strtotime($dt_end);
                                                        $dt_start = date('Y-m-d H:i:s');
                                                        $dt_start = strtotime($dt_start);
                                                        if($dt_end > $dt_start)
                                                            {
                                                                $int = $dt_end - $dt_start;
                                                                $d = intdiv($int/3600, 24);
                                                                $h = floor(($int - $d*24*3600)/3600);
                                                                $m = floor(($int - $d*24*3600 - $h*3600)/60);
                                                                echo $d, 'd', ', ', $h, 'h', ' : ', $m, 'min';
                                                            } else {
                                                                echo 'Le temps est écoulé';
                                                            }
                                                    } else {
                                                        echo 'Date limite non fixée';
                                                    }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- POPUPS DIALOGS -->

                        <!-- popup BE MY TUTOR -->
                        <div id="popup_be_my_tutor" class="tutor-popup-fade">
                            <div class="conv-popup">
                                <div class="row">
                                    <div id="question" class="col-md-7 f-rate_public_profile">
                                        Veux-tu demander à {{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }} de devenir ton professeur particulier?
                                    </div>
                                    <div id="answer_button" class="col-md-5 text-right">
                                        <a onclick="location.href='/profile/publicprofile/{{ $message->user->id }}?path='+window.location.href" class="button-conv-popup d-inline-block">Oui</a>
                                        <div class="spacer20_right">&nbsp;</div>
                                        <a href="#" class="button-conv-popup d-inline-block">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- popup ALERT! -->
                        <div id="alert" class="alert-popup-fade">
                            <div class="conv-popup">
                                <div class="row">
                                    <div id="question" class="col-md-5 f-rate_public_profile" style="padding-top: 10px!important;">
                                        Que veux-tu faire ?
                                    </div>
                                    <div id="answer_button" class="col-md-7 text-right">
                                        <a href="#" class="confirm-alert-popup-open button-conv-popup d-inline-block">Terminer le chat</a>
                                        <div class="spacer20_right">&nbsp;</div>
                                        <a href="#" class="signaler-popup-open link-conv-popup d-inline-block">Signaler le chat</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- popup CONFIRM ALERT! -->
                        <div id="confirm-alert" class="confirm-alert-popup-fade">
                            <div class="conv-popup">
                                <div class="row">
                                    <div id="question" class="col-md-5 f-rate_public_profile">
                                        Es-tu sûr de vouloir terminer le chat ?
                                    </div>
                                    <div id="answer_button" class="col-md-7 text-right">
                                        <a onclick="location.href='/closechat/?id={{$message->id}}'" class="button-conv-popup d-inline-block">Oui</a>
                                        <div class="spacer20_right">&nbsp;</div>
                                        <a href="#" class="confirm-alert-popup-close link-conv-popup d-inline-block">Non</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- popup Signaler la conversation -->
                        <div id="Signaler_la_conversation" class="signaler-popup-fade">
                            <div class="conv-popup">
                                <div id="question" class="container zero">
                                    <span class="f-btn_public_profile">Signaler la conversation</span>
                                    <div id="drop">
                                        <!-- Select Reason for Signaler -->
                                        <signaler-reason></signaler-reason>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ######################## -->
                        <!-- ######################## -->
                        <!-- ######################## -->

                        <!-- THE CONVERSATION FOR THS MESSAGE -->
                        <div id="chat" class="desk-chat">
                            @if($message)
                                <div class="hidden">{{$message->fresh()}}</div>
                                <chat v-bind:room_id="{{$message->id}}" v-bind:user_auth_id="{{Illuminate\Support\Facades\Auth::user()->id}}" v-bind:terminate="{{$message->meta->terminate}}"></chat>
                            @endif
                        </div>

                    </div>
                @elseif($selected_message !== "null" AND DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first() == null)
                    <div class="conv-container">
                        <div class="w-100 empty-assistant-message position-relative text-center">
                            <div class="spacer80"></div>
                            <span class="not-ok-ico"><i class="fas fa-times-circle"></i></span>
                            <div class="spacer20"></div>
                            <h2 class="f-boldSE caps">Professeur particulier<br>est absent</h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endguest

<!----- POPUP's ----->
<script src="{{ asset('lib/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/convpopup.js') }}"></script>


@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a href="/"{{--onclick="javascript:history.back(); return false;"--}} style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Сonversations</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    <div class="container-mob-inside">

        <div class="spacer20">&nbsp;</div>

        @guest
            <div class="container reg-container text-center">
                <div class="row">
                    <div class="col-12">
                        <h2 class="f-bold">Veuillez ajouter une annonce</h2>
                        <br />
                        <p><a href="{{ asset('/login') }}"> Connexion</a> ou <a href="{{ asset('/register') }}">Inscription</a></p>
                    </div>
                </div>
            </div>
        @else
            <div class="pad-inside">

                <!-- Search form -->
                <div class="spacer10"></div>
                <form action="{{ route('searchconversation') }}" method="post">
                    @csrf
                    <div class="conv-search">
                        <button class="blank-button" type="submit"><i class="fas fa-search d-inline-block"></i></button>
                        <input class="conv-search-txt d-inline-block" type="text" name="search" placeholder="Rechercher" />
                        <a class="d-inline-block black" href="{{ route('messagelist-conv') }}"><i class="far fa-times-circle"></i></a>
                    </div>
                </form>

                <div class="spacer20"></div>
            </div>
            @include('conversations.conversations-list-mob')


        @endguest

        <div class="spacer80">&nbsp;</div>

    </div>

@endsection


@enddesktop
