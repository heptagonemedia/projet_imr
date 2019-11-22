<ul role="navigation" aria-label="Sidenav" id="slide-out" hidden role="alert" class="sidenav draggable">

    <li>
        <div class="user-view">

            <div class="background">
                <img alt="" src="{{asset('resources\img\fond_header_navigation_side_bar.jpg')}}" height="300px">
            </div>
            <img alt="" src="{{asset('resources\img\logo_imr.png')}}" width="60px" height="50px">
            <span class="white-text name">{!! __('message.nomIMR') !!}</span>

        </div>
    </li>

    <li><a class="waves-effect waves-teal" href="accueil"><i aria-hidden="true" class="material-icons">home</i> {!! __('message.accueilNavigation') !!} </a></li>
    <li>
        <div class="divider"></div>
    </li>

    <li><a class="subheader">{!! __('message.accesCalcul') !!}</a></li>

    <li class="no-padding">
        <ul class="collapsible collapsible-accordion  waves-teal">
            <li>
                <a class="collapsible-header">{!! __('message.calculEnregistres') !!}<i aria-hidden="true" class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>

                        @for ($i = 0; $i < 6; $i++)
                            <li><a class="waves-effect waves-teal" href="resultats.php?bouee={{$i}}&type=enr"><i aria-hidden="true" class="material-icons">insert_chart_outlined</i>{!! __('message.unTelCalcul') !!} {{$i}}</a></li>
                        @endfor

                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <li><a class="waves-effect waves-teal" href="resultats.php?bouee=2&type=prev"><i aria-hidden="true" class="material-icons">new_releases</i>{!! __('message.calculEnCours') !!}</a></li>

    <li><div class="divider"></div></li>

    <li><a class="subheader">{!! __('message.faireDesCalculs') !!}</a></li>

    <li><a class="waves-effect waves-teal" href="nouveauCalcul"><i aria-hidden="true" class="material-icons">add_circle_outline</i>{!! __('message.nouveauCalcul') !!}</a></li>

    <li><div class="divider"></div></li>

    <li><a class="subheader">{!! __('message.choixLangue') !!}</a></li>

    <li><a class="waves-effect waves-teal" href="{{ url('locale/en') }}"><i aria-hidden="true" class="material-icons">language</i>{!! __('message.anglais') !!}</a></li>
    <li><a class="waves-effect waves-teal" href="{{ url('locale/fr') }}"><i aria-hidden="true" class="material-icons">language</i>{!! __('message.francais') !!}</a></li>

    <li>
        <div class="divider"></div>
    </li>
    <li><a class="sidenav-close" href="#" onclick="fermerSidenav()"><i class="material-icons">close</i> {!! __('message.fermer') !!} </a></li>

</ul>

