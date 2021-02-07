<div id="bottomMobMenu" class="mobMenu">
    <div class="position-relative">
        <a href="/demandes" class="black">
            <div id="demandes" class="position-absolute text-center">
                <div class="icon-size1"><i class="fas fa-question iconbottmenu"></i></div>
                <div class="main-txt">Demandes</div>
            </div>
        </a>
        <a href="{{ route('search-messages') }}" class="black">
            <div id="rechercher" class="position-absolute text-center">
                <div class="icon-size2"><i class="fas fa-search iconbottmenu"></i></div>
                <div class="main-txt">Rechercher</div>
            </div>
        </a>
        <a href="{{ route('message.create') }}" class="black">
            <div id="ajouter" class="position-absolute text-center">
                <div class="icon-size1"><i class="fas fa-plus iconbottmenu"></i></div>
                <div class="main-txt">Ajouter</div>
            </div>
        </a>
    </div>
</div>
