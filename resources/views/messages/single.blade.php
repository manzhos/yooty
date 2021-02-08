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

    @php
        $ids = $message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->get();
    @endphp
    <!--  Link to back (on search)  -->
    @if(!isset($ids[0]))
        <div class="container topblock">
            <div class="row">
                <div class="col-md-12">
                    <div style="padding-top: 20px; padding-left: 5vw;">
                        <a onclick="javascript:history.back(); return false;" style="cursor: pointer;"><i class="fas fa-angle-left" style="font-size: 12px"></i><span style="padding-left: 5px; text-decoration: underline;">Retour aux autres questions</span></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1>NULL</h1>
        <div class="container topblock">
            <div class="row">
                <div class="col-md-12">
                    <div style="padding-top: 20px; padding-left: 5vw;">
                        <a href="/message/search" style="cursor: pointer;"><i class="fas fa-angle-left black" style="font-size: 12px"></i><span style="padding-left: 5px;" class="black underline">Retour aux autres questions</span></a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!--  Body of message view  -->
    <div class="container">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-5">
                <h1 class="f-boldSE caps">Aidez moi<br />je ne trouves pas&nbsp;...</h1>
            </div>
            <div class="col-md-5">
                <div class="w-100 text-right position-relative" style="height: 100%; min-height: 20px;">
                    <div class="position-absolute" style="bottom: 0px; right: 0px;">
                        <p class="add-info-message-list d-inline-block">Signaler la question</p>
                        <img src="/images/alert.svg" width="24" height="24" class="d-inline-block" style="margin-left: 5px" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-5">
                <div class="spacer20">&nbsp;</div>
                <p class="f-name_list_profile caps" id="AuthorMessage">{{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}</p>
                <div class="spacer10">&nbsp;</div>
                <div id="DateBlock" class="d-block">
                    <!-- if the date is expiring printed the flash -->
                    @php
                        $dt_ = Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
                        if($dt_)
                            {
                                $dt_end = strtotime($dt_);
                                $dt_start = date('Y-m-d H:i:s');
                                $dt_start = strtotime($dt_start);
                                $int = $dt_end - $dt_start;
                                if($int/3600 < 24){
                                    printf('<img src="/images/flash.svg" width="25" height="25" class="d-inline-block vert-top" style="margin-right: 5px" />');
                                }
                            }
                    @endphp
                    <p class="f-info_list_profile d-inline-block">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end'))->format('d/m/y') }}</p>
                </div>
                <div class="spacer10">&nbsp;</div>
                @foreach($message->sciences()->pluck('science_name') as $science)
                    <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $science }}</div>
                @endforeach
                <div class="spacer20">&nbsp;</div>

                @php
                    $images = $message->media;
                @endphp

                @if(isset($images[0]))
                    <p class="f-info_list_profile caps">Description</p>
                    <h2 class="f-boldSE ">{{ $message->subject }}</h2>
                    <p class="f-info_list_profile">{{ $message->message }}</p>
                    <div class="spacer40">&nbsp;</div>
                @endif

                <p class="f-profile profile-data">Tarif&nbsp;:&nbsp;{{ Illuminate\Support\Facades\DB::table('payments')->where('message_id','=',$message->id)->value('amount') }}&#8364</p>
                <p class="f-profile caps">Temps restant :
                    @php
                        $dt_end = Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
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
                </p>
                <div class="spacer35">&nbsp;</div>
                <!--  Offer assistance  -->
                @php
                  $ids = $message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->get();
                @endphp
                @if(\Illuminate\Support\Facades\Auth::user()->id === $message->user_id)
                    <div>&nbsp;</div>
                @else
                    @if(isset($ids[0]))
                        <button class="yootyButtGrey inactive">Déjà appliqué</button>
                    @else
                        <form action="{{ route('assistance.apply',['id' => $message->id]) }}" method="post" role="form" id="Offer assistance">
                            @csrf
                            <button type="submit" class="yootyButt">Proposez mon aide</button>
                        </form>
                    @endif
                @endif
                <div class="spacer60">&nbsp;</div>
            </div>
            <div class="col-md-5">
                <div class="spacer20">&nbsp;</div>
                @php
                    if(isset($images[0])){
                        foreach( $images as $image ){
                            echo '
                                <a href="#" data-toggle="modal" data-target="#ModalImg' . $image->id . '">
                                <img src="/storage/uploads/' . $image->file_name . '" width="100%" height="auto"/>
                                </a>

                                <!-- Fullscreen Image -->
                                <div class="modal fade" id="ModalImg' . $image->id . '" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div>
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color:white;">&times;</span>
                                                </button>
                                                <img src="/storage/uploads/' . $image->file_name . '" width="100%" height="auto"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="spacer40">&nbsp;</div>
                                <div style="width:100%; height:1px; background-color: #000000; line-height: 1px; font-size: 1px;">&nbsp;</div>
                                <div class="spacer40">&nbsp;</div>
                                ';
                        }
                    }else{
                        echo '
                            <p class="f-info_list_profile caps">Description</p>
                            <h2 class="f-boldSE ">'.$message->subject.' </h2>
                            <p class="f-info_list_profile">'.$message->message.'</p>
                        ';
                    }
                @endphp
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
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Question</span></div>
            <div id="menuright"><img src="/images/alert.svg" width="24" height="24" class="d-inline-block conv-head-icons-mob" /></div>
        </div>
    </div>

    <div class="container-mob-inside pad-inside">

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
            <div id="MainInfo">
                <div class="spacer20">&nbsp;</div>
                <p class="f-info_list_profile caps" id="AuthorMessage">{{ $message->user->name }}&nbsp;{{ Str::substr($message->user->surname, 0, 1) }}</p>
                <h2 class="f-boldSE ">{{$message->subject}}</h2>
                <div id="DateBlock" class="d-block">
                    <!-- if the date is expiring printed the flash -->
                    @php
                        $dt_ = Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
                        if($dt_)
                            {
                                $dt_end = strtotime($dt_);
                                $dt_start = date('Y-m-d H:i:s');
                                $dt_start = strtotime($dt_start);
                                $int = $dt_end - $dt_start;
                                if($int/3600 < 24){
                                    printf('<img src="/images/flash.svg" width="25" height="25" class="d-inline-block vert-top" style="margin-right: 5px" />');
                                }
                            }
                    @endphp
                    <p class="f-btn_public_profile d-inline-block">Date limite : {{ \Carbon\Carbon::parse(DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end'))->format('d/m/y') }}</p>
                </div>
                @foreach($message->sciences()->pluck('science_name') as $science)
                    <div id="ScienceMessage" class="profile_speciality spacer10_right f-reg">{{ $science }}</div>
                @endforeach
                <div class="spacer10">&nbsp;</div>

                @php
                    $images = $message->media;
                @endphp
                @if(isset($images[0]))
                    <p class="f-info_list_profile caps">Description</p>
                    <p class="f-info_list_profile">{{ $message->message }}</p>
                    <div class="spacer40">&nbsp;</div>
                @endif

                <div id="MediaData">
                    <div class="spacer20">&nbsp;</div>
                    @php
                        if(isset($images[0])){
                            foreach( $images as $image ){
                                echo '
                                    <a href="#" data-toggle="modal" data-target="#ModalImg' . $image->id . '">
                                    <img src="/storage/uploads/' . $image->file_name . '" width="100%" height="auto"/>
                                    </a>

                                    <!-- Fullscreen Image -->
                                    <div class="modal fade" id="ModalImg' . $image->id . '" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div>
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color:white;">&times;</span>
                                                    </button>
                                                    <img src="/storage/uploads/' . $image->file_name . '" width="100%" height="auto"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="spacer40">&nbsp;</div>
                                    <div style="width:100%; height:1px; background-color: #000000; line-height: 1px; font-size: 1px;">&nbsp;</div>
                                    <div class="spacer40">&nbsp;</div>
                                    ';
                            }
                        }else{
                            echo '
                                <p class="f-info_list_profile caps">Description</p>

                                <p class="f-info_list_profile">'.$message->message.'</p>
                            ';
                        }
                    @endphp
                </div>

                <hr />

                <p class="f-profile">Tarif&nbsp;:&nbsp;<span class="f-bold">{{ Illuminate\Support\Facades\DB::table('payments')->where('message_id','=',$message->id)->value('amount') }}&#8364;</span></p>
                <p class="f-14 caps">Temps restant :
                    @php
                        $dt_end = Illuminate\Support\Facades\DB::table('message_meta')->where('message_id','=',$message->id)->value('date_end');
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
                </p>
                <div class="spacer20">&nbsp;</div>
                <!--  Offer assistance  -->
                @php
                    $ids = $message->assistance()->where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->get();
                @endphp
                <div class="text-center">
                    @if(\Illuminate\Support\Facades\Auth::user()->id === $message->user_id)
                        <div>&nbsp;</div>
                    @else
                        @if(isset($ids[0]))
                            <button class="yootyButtGrey inactive">Déjà appliqué</button>
                        @else
                            <form action="{{ route('assistance.apply',['id' => $message->id]) }}" method="post" role="form" id="Offer assistance">
                                @csrf
                                <button type="submit" class="yootyButt">Proposez mon aide</button>
                            </form>
                        @endif
                    @endif
            </div>
        @endguest
        <div class="spacer80">&nbsp;</div>
        <div class="spacer40">&nbsp;</div>

    </div>

@endsection


@enddesktop
