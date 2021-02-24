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
                    <h1 class="f-boldSE caps">PROFILE DE {{ $user->name }}&nbsp;{{ $user->surname }}</h1>
                    <div class="spacer35"></div>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar_public-profile">
                            <p class="f-name_public_profile caps"><br />{{ $user->name }} {{$user->surname}}</p>
                            {{--<p class="f-education_public_profile">{{ $user->education()->pluck('education')->implode(', ') }}</p>--}}

                            <!-- rating block -->

                            @if($user->testimonial->count() > 0)
                                <span class="f-rate_public_profile d-block">
                                    {{ Str::of($user->testimonial->avg('rating'))->limit(3, ' /') }}&nbsp;5
                                </span>
                                <a href="{{ route('profiles.reviews', ['id' => $user->id]) }}" class="f-education_public_profile d-block black">
                                    {{ $user->testimonial->count() }} avis
                                </a>
                            @endif

                            <br />
                            <div id="pop" class="position-absolute" style="z-index: 1000; left: 50%; margin-left: -82px; width: 164px;">
                                <confirm-profp v-bind:id="{{$user->id}}" v-bind:name="'{{$user->name}}'" v-bind:surname="'{{Str::substr($user->surname, 0, 1)}}'"></confirm-profp>
                            </div>
                        </div>
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-8">
                            <div class="f-reg d-inline-block" style="font-size: 22px;">Compétences:</div>
                            @foreach($user->userprof as $skill)
                                <div class="row align-items-center">
                                    <div class="col-12 text-left">
                                        <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                                        <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="spacer20">&nbsp;</div>
                            <div class="profile_frame">
                                <div class="d-inline-block vert-top" style="width: 85px; height: 85px;"><img src="{{ asset('images/Picto-bio.svg') }}" width="85" height="85" /></div>
                                <div class="spacer20_right">&nbsp;</div>
                                <div class="d-inline-block" style="width: calc(100% - 115px);">{{ DB::table('usermetas')->where('user_id','=',$user->id)->value('minibio') }}</div>
                            </div>
                            <div class="spacer40">&nbsp;</div>

                            @if($assist === 'yes')
                                <div id="popassist" class="position-absolute" style="z-index: 7700; left: 50%; margin-left: -82px; width: 164px;">
                                    <confirm-assist v-bind:id="{{$user->id}}" v-bind:message_id="{{$message_id}}" v-bind:name="'{{$user->name}}'" v-bind:surname="'{{Str::substr($user->surname, 0, 1)}}'" ></confirm-assist>
                                </div>
                                <div class="spacer10_left">&nbsp;</div>
                            @endif

                            <!-- check whether the profile was called from a search or from a conversation -->
                            @if($backpath !== 0)
                                <a href="{{$backpath}}"><button type="button" class="yootyButtGrey">BACK</button></a>
                            @else
                                <a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="d-inline-block"><button type="button" class="yootyButtGrey">BACK</button></a>
                            @endif

                            <!-- check whether the profile was called from a search or from a conversation -->
                            @if($backpath !== 0)
                                <div class="spacer35">&nbsp;</div>
                                <a href="{{ route('testimonial.create', ['id' => $user->id, 'path' => $backpath]) }}" id="Write the testimonial" class="f-reg d-inline black">Rédiger un avis</a>
                                <div class="spacer20_right">&nbsp;</div>
                                <a href="{{ route('testimonial.index', ['id' => $user->id, 'path' => $backpath]) }}" id="Read the testimonial" class="f-reg d-inline black">Témoignages</a>
                            @else
                                <div class="spacer20_right">&nbsp;</div>

                                <!-- put testimonials in popup window -->

                                <button data-path="{{ route('testimonial.index-popup', ['id' => $user->id, 'path' => $backpath]) }}"
                                        class="blank-button f-reg black load-ajax-modal"
                                        role="button"
                                        data-toggle="modal" data-target="#dynamic-modal">
                                    Témoignages
                                </button>

                                <div class="modal fade" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width:80vw; margin-left: 10vw; position: absolute!important; z-index: 8800;">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body"></div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script src="/js/modtesti.js"></script>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="col-md-1">&nbsp;</div>
                <div class="spacer80 w-100">&nbsp;</div>
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
{{--
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">PROFILE DE {{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</span></div>
--}}
            <div id="menuleft"><a href="{{$backpath}}" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">PROFILE DE {{ $user->name }}&nbsp;{{ Str::substr($user->surname, 0, 1) }}</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside text-center">
        <div class="spacer20">&nbsp;</div>
        <img src="/uploads/avatars/{{ $user->avatar }}" class="user_avatar_public-profile">
        <p class="f-name_public_profile caps"><br />{{ $user->name }} {{$user->surname}}</p>
        {{--<p class="f-education_public_profile">{{ $user->education()->pluck('education')->implode(', ') }}</p>--}}
        <span class="f-rate_public_profile d-block">
            @if($user->testimonial->count() > 0)
                {{ Str::of($user->testimonial->avg('rating'))->limit(3, ' /') }}&nbsp;5
            @endif
        </span>
        <a href="{{ route('profiles.reviews', ['id' => $user->id]) }}" class="f-education_public_profile d-block black">
            {{ $user->testimonial->count() }} avis
        </a>

        <div id="pop" class="position-absolute" style="z-index: 1000; left: 50%; margin-left: -82px; width: 164px;">
            <confirm-profp v-bind:id="{{$user->id}}" v-bind:name="'{{$user->name}}'" v-bind:surname="'{{Str::substr($user->surname, 0, 1)}}'"></confirm-profp>
        </div>

        <div class="spacer80">&nbsp;</div>

        <div class="f-reg d-inline-block" style="font-size: 22px;">Compétences:</div>
        @foreach($user->userprof as $skill)
            <div class="row align-items-center">
                <div class="col-12 text-left">
                    <div class="f-reg skill">{{$skill->science->science_name}} - {{$skill->education->education}}</div>
                    <p class="chapter" style="padding-left: 5px;"><span class="f-bold">Tarifs:</span> {{ $skill->tarif_week }}&#8364;&nbsp;/&nbsp;Semaine&nbsp;&nbsp;&nbsp;{{ $skill->tarif_month }}&#8364;&nbsp;/&nbsp;Mois</p>
                </div>
            </div>
        @endforeach
        <div class="spacer20">&nbsp;</div>
        <div class="profile_frame">
            <div class="d-inline-block vert-top" style="width: 85px; height: 85px;"><img src="{{ asset('images/Picto-bio.svg') }}" width="85" height="85" /></div>
            <div class="spacer20_right">&nbsp;</div>
            <div class="d-inline-block" style="width: calc(100% - 115px);">{{ DB::table('usermetas')->where('user_id','=',$user->id)->value('minibio') }}</div>
        </div>

        <div class="spacer40">&nbsp;</div>

        @if($assist === 'yes')
            <div id="popassist" class="position-absolute" style="z-index: 7700; left: 50%; margin-left: -82px; width: 164px;">
                <confirm-assist v-bind:id="{{$user->id}}" v-bind:message_id="{{$message_id}}" v-bind:name="'{{$user->name}}'" v-bind:surname="'{{Str::substr($user->surname, 0, 1)}}'" ></confirm-assist>
            </div>
            <div class="spacer10_left">&nbsp;</div>
        @endif

    <!-- check whether the profile was called from a search or from a conversation -->
        @if($backpath !== 0)
            <a href="{{$backpath}}"><button type="button" class="yootyButtGrey">BACK</button></a>
        @else
            <a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="d-inline-block"><button type="button" class="yootyButtGrey">BACK</button></a>
        @endif

    <!-- check whether the profile was called from a search or from a conversation -->
        @if($backpath !== 0)
            <div class="spacer35">&nbsp;</div>
            <a href="{{ route('testimonial.create', ['id' => $user->id, 'path' => $backpath]) }}" id="Write the testimonial" class="f-reg d-inline black">Rédiger un avis</a>
            <div class="spacer20_right">&nbsp;</div>
            <a href="{{ route('testimonial.index', ['id' => $user->id, 'path' => $backpath]) }}" id="Read the testimonial" class="f-reg d-inline black">Témoignages</a>
        @else
            <div class="spacer20_right">&nbsp;</div>

            <!-- put testimonials in popup window -->

            <button data-path="{{ route('testimonial.index-popup', ['id' => $user->id, 'path' => $backpath]) }}"
                    class="blank-button f-reg black load-ajax-modal"
                    role="button"
                    data-toggle="modal" data-target="#dynamic-modal">
                Témoignages
            </button>

            <div class="modal fade" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:80vw; margin-left: 10vw; position: absolute!important; z-index: 8800;">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body"></div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="/js/modtesti.js"></script>
        @endif

        <div class="spacer80">&nbsp;</div>

    </div>

@endsection


@enddesktop
