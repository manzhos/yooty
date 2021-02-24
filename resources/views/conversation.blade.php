@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

    <div class="container reg-container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="f-boldSE caps"> Conversation </h1>
                <div class="spacer40"></div>
            </div>
        </div>

        <div class="row">
            <!-- Subject of Messages -->
            <div class="col-md-12">
                <p><a href="/">Back</a> please. this page only for mobile</p>
            </div>

        </div>
        <div class="spacer60"></div>
    </div>

@endsection



@elsedesktop
<!-- Mobile view -->

<!-- This page for conversations on mobile -->

@extends('yootymobtop')

@section('content')

@php
    $message = App\Models\Message::find($selected_message);
    $icon_message = 'student';
@endphp

@if($selected_message !== "null" AND DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first() != null)

    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a href="/conversations" class="black"><i class="fas fa-angle-left"></i></a>
                <span class="caps f-boldSE d-inline-block">
                    @if($message->user_id != Auth::user()->id)
                        {{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}
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
                        {{ $assistant->name }}&nbsp;{{ Str::substr($assistant->surname, 0, 1) }}
                    @endif
                </span>
                <div class="spacer10_right">&nbsp;</div>


                <!-- check for subscription OR no -->
                @forelse($coach_pairs as $coach_pair)
                    @if(Auth::user()->id == $coach_pair->coach_id and $coach_pair->student_id == $message->user_id)
                        @php
                            // the active user is coach for this message and have subscription
                            $icon_message = 'coach';
                        @endphp
                    @elseif(\Illuminate\Support\Facades\Auth::user()->id == $coach_pair->student_id
                            and \Illuminate\Support\Facades\Auth::user()->id == $message->user_id
                            and DB::table('message_user')->where('message_id', $message->id)->where('user_id', $coach_pair->coach_id)->where('assistant', 1)->count() > 0)
                        @php
                            // the active user is student for this message and have subscription
                            $icon_message = 'student';
                        @endphp
                    @endif
                @empty
                @endforelse

            </div>
            <div id="menuright">
                <div class="review-head-mob d-inline-block" style="padding-top: 7px; margin-right: 10px;">
                    @if($message->user->isOnline())
                        <span>En ligne</span>
                    @else
                        <span style="color:#D01A33;">Hors ligne</span>
                    @endif
                </div>
                <div class="d-inline-block">
                    @if(!$message->meta->terminate)
                        @switch($icon_message)
                            @case('coach')
                            <a id="already_tutor_link" href="#" class="tutor-popup-open d-inline-block">
                                <img src="/images/ac_hat.svg" width="30" height="30" class="d-inline-block conv-head-icons-mob" />
                            </a>
                            @break
                            @case('student')
                            <a id="be_my_tutor_link" href="#" class="tutor-popup-open d-inline-block">
                                <img src="/images/books.svg" width="30" height="30" class="d-inline-block conv-head-icons-mob" />
                            </a>
                            @break
                            @default
                            <a id="be_my_tutor_link" href="#" class="tutor-popup-open d-inline-block">
                                <img src="/images/books.svg" width="30" height="30" class="d-inline-block conv-head-icons-mob" />
                            </a>
                        @endswitch
                        <a id="alert" href="#" class="alert-popup-open d-inline-block">
                            <img src="/images/alert.svg" width="26" height="26" class="d-inline-block conv-head-icons-mob" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- POPUPS DIALOGS -->

    <!-- popup BE MY TUTOR -->
    <div id="popup_be_my_tutor" class="tutor-popup-fade">
        <div class="conv-popup-mob">
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
        <div class="conv-popup-mob">
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
        <div class="conv-popup-mob">
            <div class="row">
                <div id="question" class="col-md-5 f-rate_public_profile">
                    Es-tu sûr de vouloir terminer le chat&nbsp;?
                </div>
                <div id="answer_button" class="col-md-7 text-right">
                    <a onclick="location.href='/conversations'" class="button-conv-popup d-inline-block">Oui</a>
                    <div class="spacer20_right">&nbsp;</div>
                    <a href="#" class="confirm-alert-popup-close link-conv-popup d-inline-block">Non</a>
                </div>
            </div>
        </div>
    </div>

    <!-- popup Signaler la conversation -->
    <div id="Signaler_la_conversation" class="signaler-popup-fade">
        <div class="conv-popup-mob">
            <div id="question" class="container zero">
                <span class="f-btn_public_profile">Signaler la conversation</span>
                <div id="drop">
                    <!-- Select Reason for Signaler -->
                    <signaler-reason></signaler-reason>
                </div>
            </div>
        </div>
    </div>


    <!-- ### THE CONVERSATION FOR THIS MESSAGE ### -->
    <div id="mobchatbody" class="container-mob-inside zero">
        <div class="spacer10"></div>
        <div id="assistant" class="text-center">
            <h3 class="f-name_list_profile caps d-block">Les limites</h3>
            <div class="d-block">
                <a href="{{route('messages.show',$message->id)}}" class="f-tarif black underline" >Voir l’énoncé de l’annonce</a>
            </div>
        </div>
        <div id="icons" class="conv-head-icons">
            <div class="text-left position-relative" style="padding-top: 11px;">
                <div class="add-info-message-list d-block position-relative text-center">
                    <span class="caps">Temps restant</span>
                @php
                    $dt_end = DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
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

                <!-- ### PROGRESS BAR CALCULATE ### -->
                    <!-- check for student OR prof -->
                @if($message->user_id != \Illuminate\Support\Facades\Auth::user()->id)
                    @php $mark_m = 'mark-message'; $icon_message = 'blank'; $pb = 'progressBarBlack'; $pd = 'progressDoneBlack'; @endphp
                @else
                    @php $mark_m = 'mark-message-student'; $icon_message = 'blank'; $pb = 'progressBarYellow'; $pd = 'progressDoneYellow'; @endphp
                @endif
                <!-- check for subscription OR no -->
                @forelse($coach_pairs as $coach_pair)
                    @if(\Illuminate\Support\Facades\Auth::user()->id == $coach_pair->coach_id and $coach_pair->student_id == $message->user_id)
                        @php
                            // the active user is coach for this message and have subscription
                            $mark_m = 'mark-message-subscription';
                            $pb = 'progressBarOrange';
                            $pd = 'progressDoneOrange';
                            $icon_message = 'coach';
                        @endphp
                    @elseif(\Illuminate\Support\Facades\Auth::user()->id == $coach_pair->student_id
                            and \Illuminate\Support\Facades\Auth::user()->id == $message->user_id
                            and DB::table('message_user')->where('message_id', $message->id)->where('user_id', $coach_pair->coach_id)->where('assistant', 1)->count() > 0)
                        @php
                            // the active user is student for this message and have subscription
                            $mark_m = 'mark-message-subscription';
                            $pb = 'progressBarOrange';
                            $pd = 'progressDoneOrange';
                            $icon_message = 'student';
                        @endphp
                    @endif
                @empty
                @endforelse
                <!-- Calculate the progress bar -->
                    @php
                        $dt_start = strtotime(date('Y-m-d H:i:s'));
                        $message_create = strtotime($message->created_at);
                        $progress = floor(($dt_end - $dt_start)/(($dt_end - $message_create)/100));
                        if ($progress > 100) {$progress = 100;}
                        elseif ($progress < 0) {$progress = 0;}
                        // echo $progress;
                    @endphp
                    <div class="w-50 margin-center5">
                        <div id="progressBar" class="progressBar {{$pb}}">
                            <div id="progressDone" class="progressDone {{$pd}}" style="width: {{$progress}}%;"></div>
                        </div>
                    </div>
                    <!-- ### THE PROGRESS BAR ARE CALCULATED & SHOWED ### -->
                </div>
            </div>
        </div>

        <div id="chat" class="mobile-chat">
            @if($message)
                {{--<div class="hidden">{{$message->fresh()}}</div>--}}
                <mobilechat v-bind:room_id="{{$message->id}}" v-bind:user_auth_id="{{Illuminate\Support\Facades\Auth::user()->id}}" v-bind:terminate="{{$message->meta->terminate}}"></mobilechat>
            @endif
        </div>
        <div id="bottom-div" style="height: 10px">&nbsp;</div>
    </div>

@elseif($selected_message !== "null" AND DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first() == null)
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft">
                <a href="/conversations" class="black"><i class="fas fa-angle-left"></i></a>
                {{--<span class="caps f-boldSE d-inline-block">Сonversations</span>--}}
            </div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside">
        <div class="w-100 empty-assistant-message position-relative text-center">
            <div class="spacer80"></div>
            <span class="not-ok-ico"><i class="fas fa-times-circle"></i></span>
            <div class="spacer20"></div>
            <h2 class="f-boldSE caps">Professeur particulier<br>est absent</h2>
        </div>
    </div>
@endif



<!-- ##### SCRIPTS ##### -->

<!----- POPUP's ----->
<script src="{{ asset('lib/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/convpopup.js') }}"></script>

{{--<script>
/*
    var container = this.$el.querySelector("#mobchatbody");
*/
    var container = document.querySelector("#mobchatbody");
    container.scrollTop = container.scrollHeight;
</script>--}}



@endsection


@enddesktop
