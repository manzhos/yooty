@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

<!-- CONTENT -->

    <div class="container reg-container">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-10">
                <h1 class="f-boldSE caps">Rechercher<br />un prof particulier</h1>
                <div class="spacer20"></div>
                <h2 class="f-boldSE caps">Que recherches-tu ?</h2>

                <div id="drop">
                    <drop-down-select v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}"></drop-down-select>
                </div>

            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>
        <div class="spacer80">&nbsp;</div>
    </div>

<!-- END CONTENT -->


@endsection



@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')

    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a href="{{ route('search-messages') }}" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Rechercher un prof</span></div>
            <div id="menucenter">&nbsp;</div>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>

    <!-- main content -->
    <div class="text-center">
        <h2 class="f-boldSE caps">Que recherches-tu ?</h2>

        <div id="drop">
            <drop-down-select v-bind:options_science="{{$science_tags}}" v-bind:options_education="{{$education_tags}}"></drop-down-select>
        </div>

    </div>

    <div class="spacer80">&nbsp;</div>


@endsection

@enddesktop
