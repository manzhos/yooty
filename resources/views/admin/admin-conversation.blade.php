@extends('admin.layouts.yooty-admin')

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
    <div class="conversation-container">
        <div class="row">
            <!-- Conversations list -->
            <div class="col-sm-6">
                <h1 class="f-boldSE caps"> Conversations </h1>

                <!-- Search form -->
{{--
                <div class="spacer10"></div>
                <form action="{{ route('searchconversation') }}" method="post">
                    @csrf
                    <div class="conv-search">
                        <button class="blank-button" type="submit"><i class="fas fa-search d-inline-block"></i></button>
                        <input class="conv-search-txt d-inline-block" type="text" name="search" placeholder="Rechercher" />
                        <a class="d-inline-block black" href="{{ route('messagelist-conv') }}"><i class="far fa-times-circle"></i></a>
                    </div>
                </form>
--}}

                <div class="spacer35"></div>

                @forelse($messages as $message)
                    <div>
                        <div class="row {{ ($message->id == $selected_message) ? 'active-message' : null }} main-conv-container overflow-hidden" id="message">
                            <div class="col col-conv-left">
                                <div class="row col-conv-left">
                                    <div class="col-sm">
                                        <form action="#{{--{{ route('messagelist-conv', $message->id) }}--}}" method="get" role="form">
                                            <input type="hidden" name="selected_message" value="{{$message->id}}">
                                            <button class="blank-button row zero">
                                                @php
                                                    $mark_m = 'mark-message';
                                                    $pb = 'progressBarBlack';
                                                    $pd = 'progressDoneBlack';
                                                    $icon_message = 'blank';
                                                @endphp
                                                <div class="col {{ $mark_m }} zero col-avatar">
                                                    <div class="{{ ($message->id == $selected_message) ? 'active-divider-avatar' : 'divider-avatar' }} d-inline-block">&nbsp;</div>
                                                    <img src="/uploads/avatars/{{ $message->user->avatar }}" class="conv-message-avatar d-inline-block">
                                                </div>
                                                <div class="col">
                                                    <div class="row right-zero">
                                                        <div class="col-md-12 text-left">
                                                            @guest
                                                                <p class="author-message caps" id="AuthorMessage">{{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}</p>
                                                            @else
                                                                @if($message->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                    <p class="author-message caps" id="AuthorVous">Vous</p>
                                                                @else
                                                                    <p class="author-message caps" id="AuthorMessageNonVous">{{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}</p>
                                                                @endif
                                                            @endguest
                                                            <p class="subject-message caps" id="subjectMessage">{{ Str::limit($message->subject,20) }}</p>
                                                            <p class="f-reg main-txt" id="AnnounceBodyMessage">{{ Str::limit($message->message,80) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm text-center conv-right">
                                        <p class="cost-message-list conv-list-icon">
                                            {{ $message->meta()->pluck('cost')->implode('') }}&#8364
                                        </p>
                                    </div>
                                </div>

                                <div class="row zero" id="date-temp">
                                    <div class="col-4 zero">
                                        <div class="d-block" style="margin-left: 26px;">
                                            <p class="add-info-message-list"><span class="caps">Temps restant</span> :
                                                @php
                                                    $dt_end = strtotime(\Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end'));
                                                    if($dt_end)
                                                        {
                                                            $dt_start = strtotime(date('Y-m-d H:i:s'));
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
                                            </p>
                                            @php
                                                $dt_start = strtotime(date('Y-m-d H:i:s'));
                                                $message_create = strtotime($message->created_at);
                                                $dm = $dt_end - $message_create;
                                                if($dm > 0) {
                                                    $progress = floor(($dt_end - $dt_start)/(($dm)/100));
                                                    if ($progress > 100) {$progress = 100;}
                                                    elseif ($progress < 0) {$progress = 0;}
                                                    //echo $progress;
                                                }
                                                else {$progress = 100;}
                                            @endphp
                                            <div id="progressBar" class="progressBar {{$pb}}">
                                                <div id="progressDone" class="progressDone {{$pd}}" style="width: {{$progress}}%;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3 text-center">
                                        {{--<a href="#" class="action-message">Chat en cours</a>--}}
                                    </div>

                                    <div class="col-5 text-right zero">
                                        @foreach($message->sciences as $science)
                                            <div id="ScienceMessage" class="f-reg skill skill-outline">{{ $science->science_name }}</div>
                                        @endforeach
                                        @foreach($message->education as $education)
                                            <div id="ScienceMessage" class="f-reg skill skill-outline">{{ $education->education }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="spacer20">&nbsp;</div>
                @empty
                    <h5>Pas de fils</h5>
                @endforelse
{{--
                <div class="black">
                    {{ $messages->links() }}
                </div>
--}}
            </div>


            <!-- Conversation window -->
            <div class="col-sm-6" style="padding-left: 20px">
                @php
                    $message = App\Models\Message::find($selected_message);
                    $icon_message = 'student';
                @endphp
                @if($selected_message !== "null" AND DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first() != null)
                    <div class="conv-container">
                        <!-- head of dialog for message -->
                        <div class="w-100 conv-head position-relative">
                            <div id="assistant" class="position-absolute conv-head-assistant">
                                @php
                                    $assist = DB::table('message_user')->where('message_id', $message->id)->where('assistant', 1)->first()->user_id;
                                    $assistant = \App\Models\User::find($assist);
                                @endphp
                                <span class="f-name_list_profile caps d-inline-block">
                                    {{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }} /
                                    {{ $assistant->name }}&nbsp;{{ Str::substr($assistant->surname, 0, 1) }}
                                </span>

{{--
                                <div class="spacer20_right">&nbsp;</div>
                                <div class="review-head d-inline-block" style="padding-top: 3px;">
                                    @if($message->user->isOnline())
                                        <span>En ligne</span>
                                    @else
                                        <span style="color:#D01A33;">Hors ligne</span>
                                    @endif
                                </div>
--}}

                            </div>
                            <div id="icons" class="position-absolute conv-head-icons">
                                <a id="save-conv" href="#{{--{{ route('admin.save-conversations') }}--}}" class="d-inline-block black" data-tooltip="Sauvez le chat" >
                                    <i class="fas fa-save" style="font-size: 24px"></i>
                                </a>
                                <div class="spacer10_right">&nbsp;</div>
                                <a id="close-conv" href="{{ route('admin.conversations') }}" class="d-inline-block black" data-tooltip="Fermer la fenêtre de chat" >
                                    <i class="fas fa-times" style="font-size: 24px"></i>
                                </a>
                            </div>
                        </div>

{{--
                        <div class="container conv-subhead">
                            <div class="row" style="padding: 11px 15px;">
                                <div id="assistant" class="col-7">
                                    @if($message->user_id != Illuminate\Support\Facades\Auth::user()->id)
                                        <div class="f-name_list_profile caps d-block">Professeur particulier</div>
                                        <div class="d-block">
                                            <form action="{{ route('profiles.publicprofile', $message->user->id) }}" method="get" role="form">
                                                @csrf
                                                <input hidden id="user_id" name="user_id" value="{{ $message->user->id }}" />
                                                <input hidden id="assistance" name="assistance" value="no" />
                                                <input type="submit" class="f-tarif black blank-button underline" value="Voir le profil"/>
                                            </form>
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
--}}


{{--

                        <!-- POPUPS DIALOGS -->

                        <!-- popup BE MY TUTOR -->
                        <div id="popup_be_my_tutor" class="tutor-popup-fade">
                            <div class="conv-popup">
                                <div class="row">
                                    <div id="question" class="col-md-7 f-rate_public_profile">
                                        Veux-tu demander à {{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }} de devenir ton professeur particulier?
                                    </div>
                                    <div id="answer_button" class="col-md-5 text-right">
                                        <a onclick="location.href='/profile/publicprofile/{{ $message->user->id }}'" class="button-conv-popup d-inline-block">Oui</a>
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

--}}

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
