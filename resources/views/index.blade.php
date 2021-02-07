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
            <a href="{{ url('profile') }}" class="black"><div id="menuleft"><i class="fas fa-user-circle"></i></div></a>
            <div id="menucenter"><img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo-mob" alt="YOOTY"></div>
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
@endsection


<!-- Redirect to mobile login page -->
{{--<script type='text/javascript'>
    location.href='http://localhost/login';
</script>--}}


@enddesktop
