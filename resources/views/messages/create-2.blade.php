@desktop
<!-- Desktop view -->

@extends('yooty')

@section('head')
    <!-- script for resolve bug date-type input field in Safari -->
    <script type="text/javascript">
        var datefield=document.createElement("input")
        datefield.setAttribute("type", "date")
        if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
            document.write('<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
            document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
            document.write('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
        }
    </script>

    <script type="text/javascript">
        if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
            jQuery(function($){ //on document.ready
                $('#datelim').datepicker();
            })
        }
    </script>
@endsection



@section('content')

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
        <div class="container reg-container">

            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="f-boldSE caps">Posez votre question</h1>
                        </div>
                    </div>
                    <div class="spacer40"></div>
                    <div class="row-cols-4">
                        <div class="col d-inline-block">
                            <h3 class="f-boldSE caps lightgrey">étape 1</h3>
                        </div>
                        <div class="col d-inline-block">
                            <h3 class="f-boldSE caps">étape 2</h3>
                        </div>
                        <div class="col d-inline-block">
                            <h3 class="f-boldSE caps lightgrey">étape 3</h3>
                        </div>
                        <div class="col d-inline-block">
                            <h3 class="f-boldSE caps"></h3>
                        </div>
                    </div>
                    <div class="row-cols-4">
                        <div class="col d-inline-block" style="vertical-align: center;">
                            <div class="progression position-absolute"></div>
                            <div class="rond position-absolute"></div>
                        </div>
                        <div class="col d-inline-block" style="vertical-align: center;">
                            <div class="progression position-absolute"></div>
                            <div class="rond position-absolute"></div>
                        </div>
                    </div>
                    <div class="spacer60"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="f-boldSE caps">Livraison et tarif</h2>
                        </div>
                    </div>
                    <div class="spacer20"></div>

                    <form class="form-vertical input-form" action="{{ route('messages.create-3') }}" method="post" role="form" id="cost-message-form" enctype="multipart/form-data" >
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <div class="vert-middle">
                                    <div class="f-reg d-inline-block">Date limite</div>
                                    <input id="datelim" type="date" name="datelim" class="form-control-date" placeholder="dd-mm-yyyy" pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)" value="" />
                                </div>
                                <div class="spacer20"></div>

                                {{-- take the message ID --}}
                                <input class="hidden" id="messaage_id" name="messaage_id" type="number" value="{{ $message_id }}">

                                <!-- Livrasion ROW -->
                                <div>
                                    <img src="{{ asset('images/flash.svg') }}" width="38px" height="auto" alt="Livraison rapide" class="d-inline-block vert-top">
                                    <div class="spacer10_left"></div>
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Livraison rapide</span>
                                        <span class="f-small d-block">3&#8364; de supplément</span>
                                    </div>
                                    <div class="spacer10_left"></div>
                                    <div id="Livraison switch" class="d-inline-block vert-top">
                                        <div class="toggles vert-top">
                                            <input type="checkbox" name="Livraison" id="Livraison" class="ios-toggle check orangecheckbox" />
                                            <label for="Livraison" class="checkbox-label check" data-off="" data-on=""></label>
                                        </div>
                                    </div>
                                    <div class="spacer10_left"></div>
{{--
                                    <div id="Horaire" class="d-inline-block select haraire">

                                        <div class="select_title">
                                            <span class="select_current" data-default="Horaire">Horaire</span>
                                            <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                                        </div>

                                        <div class="select_content">
                                            <div class="d-block">
                                                <p style="font-size: 18px; line-height: 18px">&nbsp;</p>
                                            </div>
                                            <div>
                                                <input id="1" class="select_input hidden" type="radio" name="horaire" value="1" />
                                                <label for="1" class="select_label d-block select_item hour">1h</label>
                                            </div>
                                            <div>
                                                <input id="2" class="select_input hidden" type="radio" name="horaire" value="2" />
                                                <label for="2" class="select_label d-block select_item hour">2h</label>
                                            </div>
                                            <div>
                                                <input id="3" class="select_input hidden" type="radio" name="horaire" value="3" />
                                                <label for="3" class="select_label d-block select_item hour">3h</label>
                                            </div>
                                            <div>
                                                <input id="4" class="select_input hidden" type="radio" name="horaire" value="4" />
                                                <label for="4" class="select_label d-block select_item hour">4h</label>
                                            </div>
                                        </div>

                                    </div>
--}}
                                </div>

                                <div class="spacer20"></div>

                                <!-- Budget ROW -->
                                <div class="d-block">
                                    <div class="d-inline-block text-left" style="width: 30%; vertical-align: top; padding-top: 24px;">
                                        <span class="f-reg">Ajuste ton budget</span>
                                    </div>
{{--
                                    <div id="PriceCounter" class="d-inline-block" style="width: 68%;">
                                        <div class="d-inline-block position-relative" style="width: 30px;">
                                            <input type="button" id="plus" class="quantity-arrow-plus position-absolute" />
                                            <input type="button" id="minus" class="quantity-arrow-minus position-absolute" />
                                        </div>
                                        <div class="d-inline-block f-reg f-cost">
                                            <input type="number" class="quantity-num d-inline" size="3" id="Budget" name="Budget" min="1" max="999" value="5" />
                                            <span>&#8364;</span><!-- on end it's EUR symbol -->
                                        </div>
                                    </div>
--}}
                                    <div id="PriceCounter" class="d-inline-block" style="width: 68%;">
                                        <table>
                                            <tr>
                                                <td width="30px" style="vertical-align: bottom; padding-bottom: 2px;"><input type="button" id="plus" class="quantity-arrow-plus" /></td>
                                                <td rowspan="2" class="f-reg f-cost"><input type="number" class="quantity-num" size="3" id="Budget" name="Budget" min="1" max="999" value="5" /></td>
                                                <td rowspan="2" class="f-reg f-cost"><span>&#8364;</span><!-- on end it's EUR symbol --></td>
                                            </tr>
                                            <tr>
                                                <td width="30px" style="vertical-align: top; padding-top: 2px;"><input type="button" id="minus" class="quantity-arrow-minus" /></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                                <div class="spacer20"></div>

                                <div>
                                    <h2 class="f-boldSE caps">Boost ton annonce</h2>
                                </div>

                                <!-- Contacter les meilleurs professeurs -->
                                <div>
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Contacter les meilleurs professeurs</span>
                                        <span class="f-small d-block">3&#8364; de supplément</span>
                                    </div>
                                    <div class="spacer10_left"></div>
                                    <div id="Contacter les meilleurs professeurs switch" class="d-inline-block vert-top">
                                        <div class="toggles vert-top">
                                            <input type="checkbox" name="meilleurs" id="meilleurs" class="ios-toggle check orangecheckbox" />
                                            <label for="meilleurs" class="checkbox-label check" data-off="" data-on=""></label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contacter les professeurs en ligne -->
                                <div>
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Contacter les professeurs en ligne</span>
                                        <span class="f-small d-block">3&#8364; de supplément</span>
                                    </div>
                                    <div class="spacer10_left"></div>
                                    <div id="Contacter les professeurs en ligne switch" class="d-inline-block vert-top">
                                        <div class="toggles vert-top">
                                            <input type="checkbox" name="professeurs" id="professeurs" class="ios-toggle check orangecheckbox" />
                                            <label for="professeurs" class="checkbox-label check" data-off="" data-on=""></label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contacter les professeurs les plus réactifs -->
                                <div>
                                    <div class="d-inline-block">
                                        <span class="f-reg d-block">Contacter les professeurs les plus réactifs</span>
                                        <span class="f-small d-block">3&#8364; de supplément</span>
                                    </div>
                                    <div class="spacer10_left"></div>
                                    <div id="Contacter les professeurs les plus réactifs switch" class="d-inline-block vert-top">
                                        <div class="toggles vert-top">
                                            <input type="checkbox" name="reactifs" id="reactifs" class="ios-toggle check orangecheckbox"/>
                                            <label for="reactifs" class="checkbox-label check" data-off="" data-on=""></label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <!-- Apply block -->
                                <div class="apply-pay">
                                    <div class="spacer60">&nbsp;</div>
                                    <div class="uploadBlock">
                                        <div class="f-reg">Total avec options</div>
                                        <div id="CostSum" class="f-reg f-cost d-inline"></div><div class="f-reg f-cost d-inline">&#8364;</div>
                                        <div class="f-small">Tu seras débité de cette somme lorsque tu auras accepté la proposition d'aide du professeur</div>
                                    </div>
                                    <div class="spacer20">&nbsp;</div>
                                    <div class="form-button-container">
                                        <button type="submit" class="yootyButt">Payer et mettre en ligne</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>
        </div>
    @endguest
    <script src="{{ asset('lib/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/numberinput.js') }}"></script>
@endsection


@elsedesktop
<!-- Mobile view -->

@extends('yootymob')

@section('content')
    <!-- menu button in menu-line -->
    <div class="mobMenu-blank">
        <div class="position-relative">
            <div id="menuleft"><a onclick="javascript:history.back(); return false;" style="cursor: pointer;" class="black"><i class="fas fa-angle-left"></i></a><span class="caps f-boldSE d-inline-block">Poser&nbsp;votre&nbsp;question</span></div>
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
            <h3 class="f-boldSE caps text-center">étape 2</h3>
            <div class="spacer10"></div>
            <h3 class="f-boldSE caps text-left">Livraison et tarif</h3>
            <div class="spacer10"></div>

            <form class="form-vertical input-form" action="{{ route('messages.create-3') }}" method="post" role="form" id="cost-message-form" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="f-reg d-inline-block">Date limite</div>
                        <input id="DateLimite" type="date" name="datelimite" class="form-control-date" placeholder="mm-dd-yyyy" value="" />

                        <div class="spacer20"></div>

                        {{-- take the message ID --}}
                        <input class="hidden" id="messaage_id" name="messaage_id" type="number" value="{{ $message_id }}">

                        <!-- Livrasion ROW -->
                        <div>
                            <img src="{{ asset('images/flash.svg') }}" width="38px" height="auto" alt="Livraison rapide" class="d-inline-block vert-top">
                            <div class="spacer10_left"></div>
                            <div class="d-inline-block">
                                <span class="f-reg d-block">Livraison rapide</span>
                                <span class="f-small d-block">3&#8364; de supplément</span>
                            </div>
                            <div class="spacer10_left"></div>
                            <div id="Livraison switch" class="d-inline-block vert-top" style="margin-top: 8px;">
                                <div class="toggles vert-top">
                                    <input type="checkbox" name="Livraison" id="Livraison" class="ios-toggle check orangecheckbox" />
                                    <label for="Livraison" class="checkbox-label check" data-off="" data-on=""></label>
                                </div>
                            </div>
                            <div class="spacer10_left"></div>
{{--
                            <div id="Horaire" class="d-inline-block select haraire">
                                <div class="select_title">
                                    <span class="select_current" data-default="Horaire">Horaire</span>
                                    <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                                </div>

                                <div class="select_content">
                                    <div class="d-block">
                                        <p style="font-size: 18px; line-height: 18px">&nbsp;</p>
                                    </div>
                                    <div>
                                        <input id="1" class="select_input hidden" type="radio" name="horaire" value="1" />
                                        <label for="1" class="select_label d-block select_item hour">1h</label>
                                    </div>
                                    <div>
                                        <input id="2" class="select_input hidden" type="radio" name="horaire" value="2" />
                                        <label for="2" class="select_label d-block select_item hour">2h</label>
                                    </div>
                                    <div>
                                        <input id="3" class="select_input hidden" type="radio" name="horaire" value="3" />
                                        <label for="3" class="select_label d-block select_item hour">3h</label>
                                    </div>
                                    <div>
                                        <input id="4" class="select_input hidden" type="radio" name="horaire" value="4" />
                                        <label for="4" class="select_label d-block select_item hour">4h</label>
                                    </div>
                                </div>
                            </div>
--}}
                        </div>

                        <div class="spacer20"></div>

                        <!-- Budget ROW -->
                        <div class="d-block">
                            <div class="d-inline-block text-left" style="width: 30%; vertical-align: top; padding-top: 24px;">
                                <span class="f-reg">Ajuste ton budget</span>
                            </div>
                            <div id="PriceCounter" class="d-inline-block" style="width: 68%;">
                                <table>
                                    <tr>
                                        <td width="30px" style="vertical-align: bottom; padding-bottom: 2px;"><input type="button" id="plus" class="quantity-arrow-plus" /></td>
                                        <td rowspan="2" class="f-reg f-cost"><input type="number" class="quantity-num" size="3" id="Budget" name="Budget" min="1" max="999" value="5" /></td>
                                        <td rowspan="2" class="f-reg f-cost"><span>&#8364;</span><!-- on end it's EUR symbol --></td>
                                    </tr>
                                    <tr>
                                        <td width="30px" style="vertical-align: top; padding-top: 2px;"><input type="button" id="minus" class="quantity-arrow-minus" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="spacer20"></div>

                        <div>
                            <h3 class="f-boldSE caps">Boost ton annonce</h3>
                        </div>

                        <!-- Contacter les meilleurs professeurs -->
                        <div class="d-block">
                            <div class="d-inline-block w-75">
                                <span class="f-reg d-block">Contacter les meilleurs professeurs</span>
                                <span class="f-small d-block">3&#8364; de supplément</span>
                            </div>

                            <div id="Contacter les meilleurs professeurs switch" class="d-inline-block vert-middle">
                                <div class="toggles">
                                    <input type="checkbox" name="meilleurs" id="meilleurs" class="ios-toggle check orangecheckbox" />
                                    <label for="meilleurs" class="checkbox-label check" data-off="" data-on=""></label>
                                </div>
                            </div>

                        </div>

                        <div class="spacer20"></div>

                        <!-- Contacter les professeurs en ligne -->
                        <div class="d-block">
                            <div class="d-inline-block w-75">
                                <span class="f-reg d-block">Contacter les professeurs en ligne</span>
                                <span class="f-small d-block">3&#8364; de supplément</span>
                            </div>
                            <div id="Contacter les professeurs en ligne switch" class="d-inline-block vert-middle">
                                <div class="spacer10"></div>
                                <div class="toggles">
                                    <input type="checkbox" name="professeurs" id="professeurs" class="ios-toggle check orangecheckbox" />
                                    <label for="professeurs" class="checkbox-label check" data-off="" data-on=""></label>
                                </div>
                            </div>
                        </div>

                        <div class="spacer20"></div>

                        <!-- Contacter les professeurs les plus réactifs -->
                        <div class="d-block">
                            <div class="d-inline-block w-75">
                                <span class="f-reg d-block">Contacter les professeurs les plus réactifs</span>
                                <span class="f-small d-block">3&#8364; de supplément</span>
                            </div>
                            <div id="Contacter les professeurs les plus réactifs switch" class="d-inline-block vert-middle">
                                <div class="spacer10"></div>
                                <div class="toggles">
                                    <input type="checkbox" name="reactifs" id="reactifs" class="ios-toggle check orangecheckbox"/>
                                    <label for="reactifs" class="checkbox-label check" data-off="" data-on=""></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="spacer35"></div>

                    <!-- Apply block -->
                    <div class="text-center">
                        <div class="f-reg">Total avec options</div>
                        <div id="CostSum" class="f-reg f-cost d-inline"></div><div class="f-reg f-cost d-inline">&#8364;</div>
                        <div class="f-small">Tu seras débité de cette somme lorsque tu auras accepté la&nbsp;proposition d'aide du professeur</div>
                        <div class="spacer35"></div>
                        <button type="submit" class="yootyButt">Payer et mettre en ligne</button>
                    </div>

                </div>
            </form>

            <div class="spacer40"></div>

            <div class="text-center">
                <div class="create-circle active d-inline-block"></div>
                <div class="create-circle active d-inline-block"></div>
                <div class="create-circle d-inline-block"></div>
            </div>

            <div class="spacer80"></div>
        @endguest
    </div>



    <!-- SCRIPTS -->
    <script src="{{ asset('lib/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/numberinput.js') }}"></script>

    <!-- script for resolve bug date-type input field in Safari -->
    <script type="text/javascript">
        var dateClass='.datelim';
        console.log('SAFARI SCRIPT ACTIVATED');
        $(document).ready(function ()
        {
            /*if (document.querySelector(dateClass).type !== 'date')
            {*/
            var oCSS = document.createElement('link');
            oCSS.type='text/css'; oCSS.rel='stylesheet';
            oCSS.href='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css';
            oCSS.onload=function()
            {
                var oJS = document.createElement('script');
                oJS.type='text/javascript';
                oJS.src='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
                oJS.onload=function()
                {
                    $(dateClass).datepicker();
                }
                document.body.appendChild(oJS);
            }
            document.body.appendChild(oCSS);
            /*}*/
        });
    </script>


@endsection

@enddesktop
