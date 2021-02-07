<div class="list-group">
    @forelse($users as $user)
        <!-- Messages Users -->
        <div class="container zero">
            <div class="row">
                <div class="col message-avatar">
                    <img src="/uploads/avatars/{{ $user->avatar }}" class="message-list-avatar">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col" >
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="f-name_list_profile caps" id="UserNamne">{{ $user->name }} {{$user->surname}}</p>
                                    <!-- check if there are reviews and print it -->
                                    @if(isset($user->testimonial[0]))
                                        <p class="f-rate_public_profile" id="UserRadting">{{ Str::of(DB::table('testimonials')->where('user_id','=',$user->id)->avg('rating'))->limit(3, '/') }}5</p>
                                    @else
                                        <p class="f-rate_public_profile" id="UserRadting">Pas de notes</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('profiles.publicprofile', $user->id) }}" method="get" role="form">
                                        @csrf
                                        <input hidden id="message_id" name="message_id" value="{{$message->id}}" />
                                        <input hidden id="assistance" name="assistance" value="yes" />
                                        <button type="submit" class="yooty-small-BTN message-list-button-yellow">Voir le profil</button>
                                    </form>
                                </div>
                            </div>
                            <div class="spacer10"></div>
                            <p class="f-education_public_profile">Nombres d’annonces répondues : 15</p>
                            @foreach($user->userprof as $skill)
                                <div class="row align-items-center">
                                    <div class="col-12 text-left">
                                        <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                        <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Button block -->
                        <div class="col button-assistance-col">
                            <div class="row align-items-center">
                                <div class="col-md text-right">
                                    <form action="{{ route('noassistant', $message->id) }}" method="post" role="form" id="NoAssistant" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="user" value="{{$user->id}}">
                                        <input type="submit" class="no-assist" value="">
                                    </form>
                                </div>
                                <div class="col-md text-right">
                                    <form action="{{ route('yesassistant', $message->id) }}" method="post" role="form" id="YesAssistant" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="user" value="{{$user->id}}">
                                        <input type="submit" class="yes-assist" value="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer10">&nbsp;</div>

        <div id="UnderLine"></div>
    @empty
        <h5>Pas de fils</h5>
    @endforelse
</div>
