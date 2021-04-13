@desktop
<!-- Desktop view -->


@extends('yooty')

@section('content')

    <section class="headBlock">
        <div class="headBlockInf">
            <div class="InfPosition">
                <img src="images/YootyWhite.svg" class="headImgLogo">
                <p class="f-boldSE messageHead caps">De l’aide à portée de clic</p>
                <form action="{{ route('search-messages') }}" target="_self">
                    <button type="submit" class="yootyButt">
                        <i class="fas fa-search"></i>
                        <span class="menu-txt">Rechercher</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="fullWD">
        <div class="container">
            <div class="spacer"></div>
            <h1 class="f-boldSE caps">En quoi consiste yooty ?</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi commodo dui ac enim varius finibus. Quisque rutrum ex nisl, in interdum massa dignissim id. Aliquam tortor sem, rhoncus at maximus at, commodo at metus. Integer varius, lacus ut condimentum sagittis, ligula tellus rhoncus arcu, non posuere odio eros vitae dolor. Ut et egestas ligula. Etiam fermentum ornare posuere. Duis sit amet velit pretium, mollis dolor eu, viverra sapien.
            </p>
            <p>
                Quisque iaculis nulla eget lorem placerat, sed maximus urna aliquam. Sed turpis quam, sagittis ac malesuada sed, fringilla sit amet mi. Phasellus quis est id velit eleifend euismod. Aliquam turpis nisl, dapibus luctus lacus eget, egestas vestibulum orci. Integer suscipit justo nec blandit posuere. Aenean elementum diam in vestibulum rutrum. Aliquam vel sem quis erat finibus rhoncus dapibus at ex. Aenean aliquet lobortis maximus. Quisque gravida felis vitae condimentum placerat. Suspendisse maximus molestie turpis, viverra viverra lacus tincidunt quis. Maecenas suscipit orci vitae mattis fermentum. Proin at ante non lectus condimentum tempus. Donec commodo mauris purus, ac cursus enim gravida non. Cras sem turpis, dignissim sed turpis et, scelerisque placerat diam.
            </p>
            <div class="spacer"></div>
        </div>
    </section>

@endsection



@elsedesktop

<!-- Mobile view -->

@extends('yootymob')

@section('content')

    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <a href="{{ url('profile') }}" class="black">
                <div id="menuleft">
                    <i class="fas fa-user-circle"></i>
                </div>
            </a>
            <div id="menucenter">
                <img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo-mob" alt="YOOTY">
            </div>
            <a href="/conversations" class="black"><div id="menuright"><i class="far fa-comment-dots iconbottmenu"></i></div></a>
        </div>
    </div>

    <section class="headBlock">
        <div class="headBlockInf">
            <div class="InfPosition">
                <img src="images/YootyWhite.svg" class="headImgLogo">
                <p class="f-boldSE messageHead caps">De l’aide à portée de clic</p>
                <form action="{{ route('search-messages') }}" target="_self" style="width: 100vw!important;">
                    <button type="submit" class="yootyButt">
                        <i class="fas fa-search"></i>
                        <span class="menu-txt">Rechercher</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="fullWD">
        <div class="container">
            <div class="spacer"></div>
            <h1 class="f-boldSE caps">En quoi consiste yooty&nbsp;?</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi commodo dui ac enim varius finibus. Quisque rutrum ex nisl, in interdum massa dignissim id. Aliquam tortor sem, rhoncus at maximus at, commodo at metus. Integer varius, lacus ut condimentum sagittis, ligula tellus rhoncus arcu, non posuere odio eros vitae dolor. Ut et egestas ligula. Etiam fermentum ornare posuere. Duis sit amet velit pretium, mollis dolor eu, viverra sapien.
            </p>
            <p>
                Quisque iaculis nulla eget lorem placerat, sed maximus urna aliquam. Sed turpis quam, sagittis ac malesuada sed, fringilla sit amet mi. Phasellus quis est id velit eleifend euismod. Aliquam turpis nisl, dapibus luctus lacus eget, egestas vestibulum orci. Integer suscipit justo nec blandit posuere. Aenean elementum diam in vestibulum rutrum. Aliquam vel sem quis erat finibus rhoncus dapibus at ex. Aenean aliquet lobortis maximus. Quisque gravida felis vitae condimentum placerat. Suspendisse maximus molestie turpis, viverra viverra lacus tincidunt quis. Maecenas suscipit orci vitae mattis fermentum. Proin at ante non lectus condimentum tempus. Donec commodo mauris purus, ac cursus enim gravida non. Cras sem turpis, dignissim sed turpis et, scelerisque placerat diam.
            </p>
            <div class="spacer"></div>
        </div>
    </section>


{{-- iOS install prompt banner block --}}
    <!-- iOS install banner -->
    <div id="iOSinstallBanner" class="iOSinstallBanner"
         style="
                display: none;
                background-color: #E4E4E4;
                border: 0 solid #F9F9F9;
                border-radius: 10px;
                color: #131313;
                position: fixed;
                width: 90vw;
                padding: 15px;
                bottom:20px;
                left: 5vw;
                z-index: 9999;
                box-shadow: 0 0 30px 0 rgba(0,0,0,0.35);
            ">

        <div>
            <div class="d-inline-block vert-top" style="width: 32px">
                <img src="{{ asset('images/add_plus.svg') }}" width="100%" height="auto">
            </div>
            <div class="d-inline-block vert-top" style="width: calc(100% - 55px); margin-left: 15px">
                <span class="f-14">Installez cette webapp sur votre iPhone :</span>
                <br/>
                <span class="f-14">
                        tapez <img src="{{ asset('images/Share.svg') }}" width="32" height="auto" class="icon-install-banner"> et ensuite
                        <br/>
                        "Ajouter à l'écran d'accueil" <img src="{{ asset('images/Add.svg') }}" width="32" height="auto" class="icon-install-banner">
                    </span>
            </div>
        </div>
        <div style="
                background-image: url(../images/bannerarr.svg);
                background-size: contain;
                background-repeat: no-repeat;
                position: fixed;
                bottom: 1px;
                left: 50%;
                margin-left: -20px;
                width: 40px;
                height: 40px;
            ">
        </div>

        <div id="closeIosBanner">
            <div class="w-100 text-center f-14 text-uppercase" onclick=" document.getElementsByClassName('iOSinstallBanner')[0].style='display: none;' " >
                <hr class="w-25" />
                Plus tard
            </div>
        </div>
    </div>

    <!-- script for iOS install banner -->
    <script>
        $(window).ready(function(){
            // Detects if device is on iOS
            const isIos = () => {
                const userAgent = window.navigator.userAgent.toLowerCase();
                return /iphone|ipad|ipod/.test( userAgent );
            }
            // Detects if device is in standalone mode
            const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

            this.wanttoclose = false;

            // Checks if should display install popup notification:
            if (isIos() && !isInStandaloneMode()) {
                document.getElementsByClassName('iOSinstallBanner')[0].style= "" +
                    "display: block;" +
                    "background-color: #E4E4E4;" +
                    "border: 0 solid #F9F9F9;" +
                    "border-radius: 10px;" +
                    "color: #131313;" +
                    "position: fixed;" +
                    "width: 90vw;" +
                    "padding: 15px;" +
                    "bottom:20px;" +
                    "left: 5vw;" +
                    "z-index: 9999;" +
                    "box-shadow: 0 0 30px 0 rgba(0,0,0,0.35)";
            }
        });

        $(document).ready(
            close = () => {
                console.log('Close the banner');
                if (this.wanttoclose) {
                    document.getElementsByClassName('iOSinstallBanner')[0].style= "" +
                        "display: none;"
                }
            }
        )

    </script>

{{-- end --}}

@endsection


<!-- Redirect to mobile login page -->
{{--
<script type='text/javascript'>
    location.href='http://localhost/login';
</script>
--}}


@enddesktop
