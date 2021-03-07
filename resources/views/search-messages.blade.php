@desktop
<!-- Desktop view -->

@extends('yooty')

@section('content')

<!-- CONTENT -->
    <div class="container reg-container">
        <div class="row">
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-6">
                <div style="display: inline-block; margin: 10px 20px 0 0; vertical-align: top;">
                    <form action="{{ route('searchcoach') }}" target="_self">
                        <button type="submit" class="yooty-small-BTN message-list-button">Rechercher un prof particulier</button>
                    </form>
                </div>
                <div style="display: inline-block; vertical-align: top;">
                    <div class="d-inline-block" style="font-size: 32px;">ou</div>
                    <div class="spacer20_right">&nbsp;</div>
                    <div class="d-inline-block">
                        <div class="caps f-boldSE" style="font-size: 30px">Recherche</div>
                        {{--<a href="#" class="text-right black" style="text-decoration: underline; float: right;">Fermer les filtres</a>--}}
                    </div>
                </div>
                <div class="spacer40"></div>
                <!-- List of Messages -->
                @include('messages.messages-list')
            </div>
            <div class="col-md-4">
                <div class="spacer80">&nbsp;</div>
                <form action="{{ route('search-messages') }}">
                    <div class="w-100 text-right">
                        <button type="submit" class="yooty-grey-BTN yooty-small-BTN">Réinitialiser les filtres</button>
                    </div>
                </form>
                <div class="spacer10">&nbsp;</div>
                <form action="{{ route('search-messages') }}">
                    <div id="Block of Filters" class="filter-block">
                        <p class="chapter chapter-profil">Préférence</p>
                        <div class="filter_section_container">
                            <div class="d-block" style="padding: 2px;">
                                <input type="checkbox" name="time_expiring" id="time_expiring" value="on" class="css-checkbox"
                                    @php
                                        if($checked_time_expiring == 'checked') printf('checked="checked"');
                                        else printf(' ');
                                    @endphp
                                />
                                <label for="time_expiring" name="time_expiring_lbl" class="f-reg css-label check-x">Bientôt expiré</label>
                            </div>
                            <div class="d-block" style="padding: 2px;">
                                <input type="checkbox" name="no_offers" id="no_offers" value="on" class="css-checkbox" {{ ($checked_nooffers == 'checked') ? 'checked' : 'unchecked' }} />
                                <label for="no_offers" name="no_offers_lbl" class="f-reg css-label check-x">Aucune proposition</label>
                            </div>
                        </div>
                        <p class="chapter chapter-profil">Niveau</p>
                        <div class="filter_section_container">
                            @foreach($educations as $education)
                                <div class="filter_section d-inline-block">
                                    <input type="checkbox" name="education[]" id="{{ $education->education }}" value="{{ $education->id }}" class="css-checkbox"
                                        {{-- Look for checked checkboxes --}}
                                        @php
                                            $i = 0;
                                            while ($i < count($checked_education))
                                            {
                                                if($checked_education[$i] == $education->id) printf('checked="checked"');
                                                else printf(' ');
                                                $i++;
                                            }
                                        @endphp
                                    />
                                    <label for="{{ $education->education }}" name="{{ $education->education }}_lbl" class="f-reg css-label check-x">{{ $education->education }}</label>
                                </div>
                            @endforeach
                        </div>
                        <p class="chapter chapter-profil">Matière</p>
                        <div class="filter_section_container">
                            @foreach($sciences as $science)
                                <div class="filter_section d-inline-block">
                                    <input type="checkbox" name="science[]" id="{{ $science->science_name }}" value="{{ $science->id }}" class="css-checkbox"
                                           {{-- Look for checked checkboxes --}}
                                        @php
                                            $i = 0;
                                            while ($i < count($checked_science))
                                            {
                                                if($checked_science[$i] == $science->id) printf('checked="checked"');
                                                else printf(' ');
                                                $i++;
                                            }
                                        @endphp
                                    />
                                    <label for="{{ $science->science_name }}" name="{{ $science->science_name }}_lbl" class="f-reg css-label check-x">{{ $science->science_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="spacer10">&nbsp;</div>
                    <div class="w-100 text-right">
                        <button type="submit" class="yooty-edit-BTN yooty-small-BTN">Appliquer des filtres</button>
                    </div>
                </form>
            </div>
            <div class="col-md-1">&nbsp;</div>
        </div>

        <div class="spacer60"></div>

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
            <a href="{{ url('profile') }}" class="black">
                <div class="menuleft">
                    <i class="fas fa-user-circle"></i>
                </div>
            </a>
            <a href="{{ url('/') }}" class="black">
                <div id="menucenter">
                    <img src="{{ asset('/images/YootyBlack.svg') }}" class="menuLogo-mob" alt="YOOTY">
                </div>
            </a>
            <a href="/conversations" class="black"><div id="menuright"><i class="far fa-comment-dots iconbottmenu"></i></div></a>
        </div>
    </div>
    <div class="spacer60">&nbsp;</div>

    <div class="container">
        <div class="text-center">
            <form action="{{ route('searchcoach') }}" target="_self">
                <button type="submit" class="yooty-small-BTN message-list-button">Rechercher un prof particulier</button>
            </form>
            <p>
                <span class="add-info-message-list d-block" style="margin: 8px auto 5px;">ou</span>
                <span class="caps f-name_public_profile d-block">Recherche</span>
            </p>
        </div>


        <!-- FILTERS BLOCK -->

        <!-- Filter icon -->
        <div id="filter-togle" class="filter-icon"></div>

        <!-- Filters window -->
        <div id="filter-screen" class="filter-screen">
            <!-- menu-line -->
            <div id="topFilterMobMenu"></div>
            <div class="mobMenu-blank">
                <div class="position-relative">
                    <div id="menufilter"><span class="caps f-boldSE d-inline-block">Filtrer la recherche</span></div>
                </div>
            </div>

            <!-- filters -->
            <div class="spacer10">&nbsp;</div>
            <form action="{{ route('search-messages') }}">
                <div id="Block of Filters" class="filter-block">
                    <p class="chapter chapter-profil">Préférence</p>
                    <div class="filter_section_container">
                        <div class="d-block" style="padding: 2px;">
                            <input type="checkbox" name="time_expiring" id="time_expiring" value="on" class="css-checkbox"
                                @php
                                    if($checked_time_expiring == 'checked') printf('checked="checked"');
                                    else printf(' ');
                                @endphp
                            />
                            <label for="time_expiring" name="time_expiring_lbl" class="f-reg css-label check-x">Bientôt expiré</label>
                        </div>
                        <div class="d-block" style="padding: 2px;">

                            <input type="checkbox" name="no_offers" id="no_offers" value="on" class="css-checkbox" {{ ($checked_nooffers == 'checked') ? 'checked' : 'unchecked' }} />
                            <label for="no_offers" name="no_offers_lbl" class="f-reg css-label check-x">Aucune proposition</label>
                        </div>
                    </div>
                    <p class="chapter chapter-profil">Niveau</p>
                    <div class="filter_section_container">
                        @foreach($educations as $education)
                            <div class="filter_section d-inline-block">
                                <input type="checkbox" name="education[]" id="{{ $education->education }}" value="{{ $education->id }}" class="css-checkbox"
                                {{-- Look for checked checkboxes --}}
                                @php
                                    $i = 0;
                                    while ($i < count($checked_education))
                                    {
                                        if($checked_education[$i] == $education->id) printf('checked="checked"');
                                        else printf(' ');
                                        $i++;
                                    }
                                @endphp
                                />
                                <label for="{{ $education->education }}" name="{{ $education->education }}_lbl" class="f-reg css-label check-x">{{ $education->education }}</label>
                            </div>
                        @endforeach
                    </div>
                    <p class="chapter chapter-profil">Matière</p>
                    <div class="filter_section_container">
                        @foreach($sciences as $science)
                            <div class="filter_section d-inline-block">
                                <input type="checkbox" name="science[]" id="{{ $science->science_name }}" value="{{ $science->id }}" class="css-checkbox"
                                    {{-- Look for checked checkboxes --}}
                                @php
                                    $i = 0;
                                    while ($i < count($checked_science))
                                    {
                                        if($checked_science[$i] == $science->id) printf('checked="checked"');
                                        else printf(' ');
                                        $i++;
                                    }
                                @endphp
                                />
                                <label for="{{ $science->science_name }}" name="{{ $science->science_name }}_lbl" class="f-reg css-label check-x">{{ $science->science_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="spacer10">&nbsp;</div>
                {{-- Clear all filters button
                <a href="{{ route('search-messages') }}" class="w-50 text-left d-inline-block">
                    <div type="submit" class="yooty-grey-BTN yooty-small-BTN">Réinitialiser les filtres</div>
                </a>
                --}}
                <div class="w-100 text-center">
                    <button type="submit" class="yooty-edit-BTN yooty-small-BTN">Appliquer des filtres</button>
                </div>
            </form>
            <div class="spacer80"></div>
        </div>



        <!-- List of Messages -->
        <div id="message-screen" class="container-mob-content message-screen">
            @include('messages.messages-list')
        </div>

        <div class="spacer80"></div>
    </div>

<!-- Scrips for Menu -->
<script src="{{ asset('js/filter.js') }}"></script>

@endsection

@enddesktop

