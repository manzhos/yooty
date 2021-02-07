<div class="list-group">
    @forelse($messages as $message)
        <!-- the message is shown if you are the author of the message or the message is don't has an assistant -->
        @php
            $ass = $message->assistance()->where('assistant','=', 1)->count();
            $ids = $message->assistance()->where('message_id','=', $message->message_id)->count();
        @endphp
        @auth
            @if($ass === 0)
                <div id="Message" class="container">
                    <div class="row zero">
                        <div class="col col-ava zero">
                            <img src="/uploads/avatars/{{ $message->user->avatar }}" class="message-list-avatar ava">
                        </div>
                        <div class="col">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 zero">
                                        <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
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
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 zero">
                                        <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
                                            <p class="f-reg main-txt" id="AnnounceBodyMessage">{{ Str::limit($message->message,80) }}</p>
                                        </a>
                                        <!-- Science of message -->
                                        @foreach($message->sciences as $science)
                                            <div id="ScienceMessage" class=" profile_speciality spacer10_right f-reg">{{ $science->science_name }}</div>
                                        @endforeach
                                        <!-- Education of message -->
                                        @foreach($message->education as $education)
                                            <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $education->education }}</div>
                                        @endforeach
                                        @guest
                                            <div style="line-height: 0;"></div>
                                        @else

                                            @if($message->user_id == \Illuminate\Support\Facades\Auth::user()->id && $ids === 0)
                                                <div><a href="{{ route('messages.edit', ['id' => $message->message_id]) }}" class="action-message">Modifier la question</a></div>
                                            @else
                                                <div style="line-height: 0;"></div>
                                            @endif
                                        @endguest
                                    </div>
                                    <div class="col-3">
                                        <p class="cost-message-list text-center">
                                            <span class="f-bold">{{ $message->cost }}</span>&#8364;
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12"><div class="spacer10">&nbsp;</div></div>
                    </div>
                </div>

                <div class="spacer20">&nbsp;</div>
                <div id="MessageDate&Button" class="container zero">
                    <div class="row zero" id="date-temp">
                        <div class="col-6 zero">
                            <div class="row">
                                <div class="col-sm flash-ico text-left">
                                    @php
                                        $dt_end = strtotime(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'));
                                        if($dt_end)
                                            {
                                                $dt_start = strtotime(date('Y-m-d H:i:s'));
                                                $int = $dt_end - $dt_start;
                                                if($int/3600 < 24){
                                                    printf('<img src="/images/flash.svg" width="30" height="30" class="d-block vert-top" />');
                                                }
                                            }
                                    @endphp
                                </div>
                                <div class="col-sm w-75">
                                    <p class="add-info-message-list caps">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'))->format('d/m/y') }}</p>
                                    <p class="add-info-message-list">Temps restant :
                                        @php
                                            if($dt_end)
                                                {
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
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right vert-top">

                        @if($message->user_id === \Illuminate\Support\Facades\Auth::user()->id)
                            <!--  You are the AUTHOR of the ad's message  -->
                                <!--  Is the offers present? How much?  -->
                            @php
                                /*$ids = $message->assistance()->where('message_id','=', $message->message_id)->count();*/
                                /*$ass = $message->assistance()->where('assistant','=', 1)->count();*/
                            @endphp
                            @if($ass > 0)
                                <!--  Offer applied  -->
                                    <a href="/conversations?selected_message={{$message->message_id}}">
                                        <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">Conversation</button>
                                    </a>
                            @elseif($ids > 0)
                                <!--  Offers are present  -->
                                    <form action="{{route('selectassistant',$message->message_id)}}" role="form" target="_self" method="post">
                                        @csrf
                                        <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">{{$ids}} Propositions</button>
                                    </form>
                                {{--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>--}}
                            @else
                                <!--  No offers  -->
                                    <button type="button" class="yooty-small-BTN message-list-button w-message-list-button inactive">Aucune proposition</button>
                                {{--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>--}}
                            @endif
                        @else
                            <!--  You are NOT the AUTHOR of the ad's message  -->
                            @php
                                /*$ids = $message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->count();*/
                                /*$ass = $message->assistance()->where('assistant','=', 1)->count();*/
                            @endphp
                            @if($ass > 0)
                                <!--  Offer applied  -->
                                @if($message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->count() > 0)
                                    <!-- You can join to conversation -->
                                    <a href="/conversations?selected_message={{$message->message_id}}">
                                        <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">Conversation</button>
                                    </a>
                                @endif
                            @elseif($ids > 0)
                                <!--  You ALREADY made the offer  -->
                                <form action="{{route('messages.show', ['id' => $message->message_id])}}" target="_self">
                                    <button type="submit" class="yooty-small-BTN message-list-button-orange inactive w-message-list-button">En attente</button>
                                </form>
                                <!--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>-->
                            @else
                                <!--  You CAN make an offer  -->
                                @if($message->assistance()->where('message_id','=', $message->message_id)->count() > 0)
                                    <form action="{{route('messages.show', ['id' => $message->message_id])}}" target="_self">
                                        <button type="submit" class="yooty-small-BTN message-list-button-orange w-message-list-button">Postuler</button>
                                    </form>
                                    <!--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>-->
                                @else
                                    <form action="{{route('messages.show', ['id' => $message->message_id])}}" target="_self">
                                        <button type="submit" class="yooty-small-BTN message-list-button-yellow w-message-list-button">Postuler</button>
                                    </form>
                                    <!--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>-->
                                @endif
                            @endif
                        @endif

                        </div>
                    </div>
                    <div class="spacer10">&nbsp;</div>
                    <hr>
                    <div class="spacer20">&nbsp;</div>
                </div>
            @else
                @if($message->user_id === \Illuminate\Support\Facades\Auth::user()->id)
                    <!-- the user is the author of the message -->
                    <div id="Message" class="container">
                        <div class="row zero">
                            <div class="col col-ava zero">
                                <img src="/uploads/avatars/{{ $message->user->avatar }}" class="message-list-avatar ava">
                            </div>
                            <div class="col">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 zero">
                                            <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
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
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-9 zero">
                                            <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
                                                <p class="f-reg main-txt" id="AnnounceBodyMessage">{{ Str::limit($message->message,80) }}</p>
                                            </a>
                                            <!-- Science of message -->
                                            @foreach($message->sciences as $science)
                                                <div id="ScienceMessage" class=" profile_speciality spacer10_right f-reg">{{ $science->science_name }}</div>
                                            @endforeach
                                            <!-- Education of message -->
                                            @foreach($message->education as $education)
                                                <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $education->education }}</div>
                                            @endforeach
                                            @guest
                                                <div style="line-height: 0;"></div>
                                            @else
                                                @if($message->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                    <div>{{--<a href="{{ route('messages.edit', ['id' => $message->message_id]) }}" class="action-message">Modifier la question</a>--}}</div>
                                                @else
                                                    <div style="line-height: 0;"></div>
                                                @endif
                                            @endguest
                                        </div>
                                        <div class="col-3">
                                            <p class="cost-message-list text-center">
                                                <span class="f-bold">{{ $message->cost }}</span>&#8364;
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12"><div class="spacer10">&nbsp;</div></div>
                        </div>
                    </div>

                    <div class="spacer20">&nbsp;</div>
                    <div id="MessageDate&Button" class="container zero">
                        <div class="row zero" id="date-temp">
                            <div class="col-6 zero">
                                <div class="row">
                                    <div class="col-sm flash-ico text-left">
                                        @php
                                            $dt_end = strtotime(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'));
                                            if($dt_end)
                                                {
                                                    $dt_start = strtotime(date('Y-m-d H:i:s'));
                                                    $int = $dt_end - $dt_start;
                                                    if($int/3600 < 24){
                                                        printf('<img src="/images/flash.svg" width="30" height="30" class="d-block vert-top" />');
                                                    }
                                                }
                                        @endphp
                                    </div>
                                    <div class="col-sm w-75">
                                        <p class="add-info-message-list caps">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'))->format('d/m/y') }}</p>
                                        <p class="add-info-message-list">Temps restant :
                                            @php
                                                if($dt_end)
                                                    {
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-right vert-top">

                                <!--  You are the AUTHOR of the ad's message  -->
                                <!--  Is the offers present? How much?  -->
                                @php
                                    /*$ids = $message->assistance()->where('message_id','=', $message->message_id)->count();*/
                                    /*$ass = $message->assistance()->where('assistant','=', 1)->count();*/
                                @endphp
                                @if($ass > 0)
                                    <!--  Offer applied  -->
                                        <a href="/conversations?selected_message={{$message->message_id}}">
                                            <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">Conversation</button>
                                        </a>
                                @elseif($ids > 0)
                                    <!--  Offers are present  -->
                                        <form action="{{route('selectassistant',$message->message_id)}}" role="form" target="_self" method="post">
                                            @csrf
                                            <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">{{$ids}} Propositions</button>
                                        </form>
                                    {{--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>--}}
                                @else
                                    <!--  No offers  -->
                                        <button type="button" class="yooty-small-BTN message-list-button w-message-list-button inactive">Aucune proposition</button>
                                    {{--<div class="qestion-rang" id="QuestionRang">Question rang 50</div>--}}
                                @endif

                            </div>
                        </div>
                        <div class="spacer10">&nbsp;</div>
                        <hr>
                        <div class="spacer20">&nbsp;</div>
                    </div>
                @elseif($message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->count() > 0)
                    <!-- the user is NOT author of the message -->
                    <!-- but the user is the assistance for this message -->
                    <div id="Message" class="container">
                        <div class="row zero">
                            <div class="col col-ava zero">
                                <img src="/uploads/avatars/{{ $message->user->avatar }}" class="message-list-avatar ava">
                            </div>
                            <div class="col">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 zero">
                                            <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
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
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-9 zero">
                                            <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
                                                <p class="f-reg main-txt" id="AnnounceBodyMessage">{{ Str::limit($message->message,80) }}</p>
                                            </a>
                                            <!-- Science of message -->
                                            @foreach($message->sciences as $science)
                                                <div id="ScienceMessage" class=" profile_speciality spacer10_right f-reg">{{ $science->science_name }}</div>
                                            @endforeach
                                            <!-- Education of message -->
                                            @foreach($message->education as $education)
                                                <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $education->education }}</div>
                                            @endforeach
                                            @guest
                                                <div style="line-height: 0;"></div>
                                            @else
                                                @if($message->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                    <div><a href="{{ route('messages.edit', ['id' => $message->message_id]) }}" class="action-message">Modifier la question</a></div>
                                                @else
                                                    <div style="line-height: 0;"></div>
                                                @endif
                                            @endguest
                                        </div>
                                        <div class="col-3">
                                            <p class="cost-message-list text-center">
                                                <span class="f-bold">{{ $message->cost }}</span>&#8364;
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12"><div class="spacer10">&nbsp;</div></div>
                        </div>
                    </div>

                    <div class="spacer20">&nbsp;</div>
                    <div id="MessageDate&Button" class="container zero">
                        <div class="row zero" id="date-temp">
                            <div class="col-6 zero">
                                <div class="row">
                                    <div class="col-sm flash-ico text-left">
                                        @php
                                            $dt_end = strtotime(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'));
                                            if($dt_end)
                                                {
                                                    $dt_start = strtotime(date('Y-m-d H:i:s'));
                                                    $int = $dt_end - $dt_start;
                                                    if($int/3600 < 24){
                                                        printf('<img src="/images/flash.svg" width="30" height="30" class="d-block vert-top" />');
                                                    }
                                                }
                                        @endphp
                                    </div>
                                    <div class="col-sm w-75">
                                        <p class="add-info-message-list caps">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'))->format('d/m/y') }}</p>
                                        <p class="add-info-message-list">Temps restant :
                                            @php
                                                if($dt_end)
                                                    {
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-right vert-top">
                                <a href="/conversations?selected_message={{$message->message_id}}">
                                    <button type="submit" class="yooty-small-BTN message-list-button-green w-message-list-button">Conversation</button>
                                </a>
                            </div>
                        </div>
                        <div class="spacer10">&nbsp;</div>
                        <hr>
                        <div class="spacer20">&nbsp;</div>
                    </div>
                @endif
            @endif

        @else

            @if($ass === 0)
                <div id="Message" class="container">
                    <div class="row zero">
                        <div class="col col-ava zero">
                            <img src="/uploads/avatars/{{ $message->user->avatar }}" class="message-list-avatar ava">
                        </div>
                        <div class="col">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 zero">
                                        <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
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
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 zero">
                                        <a href="{{route('messages.show', ['id' => $message->message_id])}}" class="black" target="_self">
                                            <p class="f-reg main-txt" id="AnnounceBodyMessage">{{ Str::limit($message->message,80) }}</p>
                                        </a>
                                        <!-- Science of message -->
                                        @foreach($message->sciences as $science)
                                            <div id="ScienceMessage" class=" profile_speciality spacer10_right f-reg">{{ $science->science_name }}</div>
                                        @endforeach
                                        <!-- Education of message -->
                                        @foreach($message->education as $education)
                                            <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $education->education }}</div>
                                        @endforeach
                                        @guest
                                            <div style="line-height: 0;"></div>
                                        @else
                                            @if($message->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                <div>{{--<a href="{{ route('messages.edit', ['id' => $message->message_id]) }}" class="action-message">Modifier la question</a>--}}</div>
                                            @else
                                                <div style="line-height: 0;"></div>
                                            @endif
                                        @endguest
                                    </div>
                                    <div class="col-3">
                                        <p class="cost-message-list text-center">
                                            <span class="f-bold">{{ $message->cost }}</span>&#8364;
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12"><div class="spacer10">&nbsp;</div></div>
                    </div>
                </div>

                <div class="spacer20">&nbsp;</div>
                <div id="MessageDate&Button" class="container zero">
                    <div class="row zero" id="date-temp">
                        <div class="col-6 zero">
                            <div class="row">
                                <div class="col-sm flash-ico text-left">
                                    @php
                                        $dt_end = strtotime(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'));
                                        if($dt_end)
                                            {
                                                $dt_start = strtotime(date('Y-m-d H:i:s'));
                                                $int = $dt_end - $dt_start;
                                                if($int/3600 < 24){
                                                    printf('<img src="/images/flash.svg" width="30" height="30" class="d-block vert-top" />');
                                                }
                                            }
                                    @endphp
                                </div>
                                <div class="col-sm w-75">
                                    <p class="add-info-message-list caps">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->message_id)->value('date_end'))->format('d/m/y') }}</p>
                                    <p class="add-info-message-list">Temps restant :
                                        @php
                                            if($dt_end)
                                                {
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
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right vert-top">
                            <!--  Are you not logged in?  -->
                                <form action="{{ route('login') }}" target="_self">
                                    <button type="submit" class="yooty-small-BTN message-list-button">S'identifier</button>
                                </form>
                        </div>
                    </div>
                    <div class="spacer10">&nbsp;</div>
                    <hr>
                    <div class="spacer20">&nbsp;</div>
                </div>
            @endif

        @endauth
    @empty
        <h5>Pas de fils</h5>
    @endforelse

    <div>
        {{ $messages->render() }}
    </div>


</div>
