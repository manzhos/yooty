@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

    <div class="container reg-container">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <h1 class="f-reg caps">You are now a<br />personal tutor for</h1>
                <h1 class="f-boldSE caps">{{$student->name}}&nbsp;{{ Str::substr($student->surname, 0, 1) }}</h1>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="spacer40"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <form action="{{ route('messagelist-conv') }}">
                    <button class="yootyButt"><span class="menu-txt">Conversations</span></button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>

    <div class="spacer80"></div><div class="spacer40"></div>

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

    <div class="container-mob-inside pad-inside text-center">

        <div class="spacer60">&nbsp;</div>

        {{----}}

    </div>

@endsection


@enddesktop
