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
            <div class="col-md-12">
                <h2 class="f-boldSE caps">Modifier la question</h2>
                @include('layouts.partials.error')
                @include('layouts.partials.success')
            </div>
        </div>
        <div class="spacer20"></div>

        <!-- Edit the message and add a new image-->
        <div id="drop">
            <drop-down-edit v-bind:options_science="{{$science_tags}}"
                            v-bind:options_education="{{$education_tags}}"
                            v-bind:m_id="{{$message->id}}"
                            v-bind:old_subject="'{{$message->subject}}'"
                            v-bind:old_message="'{{$message->message}}'"
                            v-bind:old_science_id="{{$message->sciences()->pluck('science_id')->implode('')}}"
                            v-bind:old_education_id="{{$message->education()->pluck('education_id')->implode('')}}"
            >
            </drop-down-edit>
        </div>

        <!-- see, add or remove images for the message -->
        <div class="row align-items-center">
            <div class="col text-center">
                <!-- Take all media for the message -->
                <div class="hidden">{{ $messagemedias = \Illuminate\Support\Facades\DB::table('media_messages')->where('message_id',$message->id)->get() }}</div>

                <div class="spacer35">&nbsp;</div>
                <hr/>
                <div>Images jointes:</div>
                <div class="spacer10">&nbsp;</div>
                @foreach($messagemedias as $messagemedia)
                    <form action="{{ route('del.messageimage') }}" style="width: 29%; margin: 2%" class="d-inline-block vert-top">

                        <input hidden name="message_id" value="{{$message->id}}">
                        <input hidden name="image_id" value="{{$messagemedia->id}}">

                        <!-- preview the image -->
                        <div class="row zero align-items-start">
                            <a href="#" data-toggle="modal" data-target="#ModalImg_{{$messagemedia->id}}" class="img-in-message d-inline-block" style="text-decoration: none;">
                                <img src="/storage/uploads/{{$messagemedia->file_name}}" width="100%" height="auto"/>
                            </a>

                            <input type="submit" id="DelImageButton" class="del-image d-inline-block" value="" />
                        </div>

                        <!-- Fullscreen Image -->
                        <div class="modal fade" id="ModalImg_{{$messagemedia->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div>
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="color:white;">&times;</span>
                                        </button>
                                        <img src="/storage/uploads/{{$messagemedia->file_name}}" width="100%" height="auto"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                @endforeach
            </div>
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
            <div id="menuleft"><a href="{{ route('search-messages') }}" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Modifier la question</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>

    <div class="container-mob-content">
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

            <div id="drop">
                <drop-down-edit v-bind:options_science="{{$science_tags}}"
                                v-bind:options_education="{{$education_tags}}"
                                v-bind:m_id="{{$message->id}}"
                                v-bind:old_subject="'{{$message->subject}}'"
                                v-bind:old_message="'{{$message->message}}'"
                                v-bind:old_science_id="{{$message->sciences()->pluck('science_id')->implode('')}}"
                                v-bind:old_education_id="{{$message->education()->pluck('education_id')->implode('')}}"
                >
                </drop-down-edit>
            </div>

            <div class="spacer40"></div>
            <div class="spacer80"></div>
        @endguest
    </div>


@endsection

@enddesktop

