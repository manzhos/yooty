@forelse($messages as $message)
    @if($message->assistance()->where('assistant','=', 1)->count() > 0)
        <div class="container-fluid col-conv-left">
            <div class="row {{ ($message->id == $selected_message) ? 'active-message' : null }} main-conv-container zero overflow-hidden" id="message">
                <div class="col col-conv-left">
                    <div class="row col-conv-left">
                        <div class="col-10">
                            <form action="{{ route('conversation', $message->id) }}" method="get" role="form">
                                <input type="hidden" name="selected_message" value="{{$message->id}}">
                                <button class="blank-button row zero">
                                    <!-- check & calculate block for student OR prof -->
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
                                    <div class="col {{ $mark_m }} zero col-avatar">
                                        <div class="{{ ($message->id == $selected_message) ? 'active-divider-avatar' : 'divider-avatar' }} d-inline-block">&nbsp;</div>
                                        <img src="/uploads/avatars/{{ $message->user->avatar }}" class="conv-message-avatar d-inline-block">
                                    </div>
                                    <div class="col right-zero">
                                        <div class="row right-zero">
                                            <div class="col-md-12 text-left right-zero">
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
                        <div class="col-2 text-center conv-right zero">
                            @switch($icon_message)
                                @case('coach')
                                <img src="{{ asset('/images/ac_hat.svg') }}" class="conv-list-icon conv-list-icon-img">
                                @break
                                @case('student')
                                <img src="{{ asset('/images/books.svg') }}" class="conv-list-icon conv-list-icon-img">
                                @break
                                @default
                                <p class="cost-message-list conv-list-icon">
                                    {{ $message->meta()->pluck('cost')->implode('') }}&#8364
                                </p>
                            @endswitch
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

                        <div class="col-5 text-right">
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
    @endif
@empty
    <h5>Pas de fils</h5>
@endforelse

<div class="black">
    {{ $messages->links() }}
</div>



