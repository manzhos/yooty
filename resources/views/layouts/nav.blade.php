<div class="header">

    <div class="header-overlay">
        <div class="nav-container yooty-yellow">

            <a href="/">
                <img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo" alt="YOOTY">
            </a>

            <!-- TOP MENU -->
            <div class="nav-wrapper">

                <!-- Menu > 1200px -->
                <ul class="nav">
                    <li class="nav__item"><a href="{{ route('search-messages') }}" class="nav__link">Rechercher</a></li>
                    <li class="nav__item"><a href="{{ route('message.create') }}" class="nav__link">Ajouter une annonce</a></li>
                    <li class="nav__item"><a href="/demandes" class="nav__link">Demandes</a></li>
                    <li class="nav__item"><a href="/conversations" class="nav__link">Messages</a></li>

                    <!-- AUTH PART Of Navbar -->
                    @guest
                        <li class="nav__item">
                            <ul class="menu-drop-main f-reg">
                                <li>
                                    <a href="#" class="f-reg black">{{ __('Connexion') }}&nbsp;<i class="fas fa-angle-down" style="font-size: 14px"></i></a>
                                    <ul class="drop-block-mainmenu">
                                        <li class="drop-item-mainmenu"><a href="{{ route('login') }}" class="black">{{ __('S`identifier') }}</a></li>
                                        <hr class="menu-divider" />
                                        <li class="drop-item-mainmenu">
                                            <a href="{{ route('register') }}" class="black">{{ __('S`inscrire') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <ul class="menu-drop-main f-reg">
                                <li>
                                    <a href="#" class="f-reg black">{{ __('Mon compte') }}&nbsp;<i class="fas fa-angle-down" style="font-size: 14px"></i></a>
                                    <ul class="drop-block-mainmenu">
                                        <li class="drop-item-mainmenu"><a href="{{ url('profile') }}" class="black">{{ __('Paramètres') }}</a></li>
                                        <hr class="menu-divider" />
                                        <li class="drop-item-mainmenu">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="blank-button">{{ __('Déconnexion') }}</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    <!-- END of AUTH PART Of Navbar -->
                </ul>


                <!-- Button for mobile menu -->
                <div id="menu-togle" class="menu-icon">
                    <div class="menu-icon-line"></div>
                </div>

                <!-- Menu < 1200px -->
                <div id="mobile-nav" class="mobile-nav">
                    <!-- <div class="mobile-nav__title">&nbsp;</div> -->
                    <ul class="mobile-nav__list">
                        <li class="mobile-nav__item"><a href="{{ route('search-messages') }}" class="mobile-nav__link">Rechercher</a></li>
                        <li class="mobile-nav__item"><a href="{{ route('message.create') }}" class="mobile-nav__link">Ajouter une annonce</a></li>
                        <li class="mobile-nav__item"><a href="/demandes" class="mobile-nav__link">Demandes</a></li>
                        <li class="mobile-nav__item"><a href="/conversations" class="mobile-nav__link">Messages</a></li>
                        <!-- AUTH PART Of Navbar -->
                        @guest
                            <div class="spacer20"></div>
                            <li class="mobile-nav__item">
                                <span class="menu-txt f-bold">Connexion</span><br />
                                <!-- Authentication Links -->
                                <a class="mobile-nav__link" href="{{ route('login') }}">{{ __('S`identifier') }}</a><br />
                                <a class="mobile-nav__link" href="{{ route('register') }}">{{ __('S`inscrire') }}</a>
                            </li>
                        @else
                            <div class="spacer20"></div>
                            <li class="mobile-nav__item">
                                <span class="menu-txt f-bold">{{ __('Mon compte') }}</span> <span class="caret"></span><br />
                                <div>
                                    <a class="mobile-nav__link" href="{{ url('profile') }}">{{ __('Paramètres') }}</a>
                                </div>
                                <div>
                                    <a class="mobile-nav__link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <!-- END of AUTH PART Of Navbar -->
                    </ul>
                </div>

            </div>
            <!-- // TOP MENU -->

        </div>
    </div>
</div>
