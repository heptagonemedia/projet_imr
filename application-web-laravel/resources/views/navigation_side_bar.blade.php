<ul id="slide-out" class="sidenav draggable">

    <li>
        <div class="user-view">

            <div class="background">
                <img alt="" src="{{asset('resources\img\fond_header_navigation_side_bar.jpg')}}" height="300px">
            </div>
           <img alt="" src="{{asset('resources\img\logo_imr.png')}}" width="60px" height="50px">
           <span class="white-text name">Institut Maritime de Rimouski</span>

        </div>
    </li>

    <li><a class="waves-effect waves-teal" href="accueil"><i aria-hidden="true" class="material-icons">home</i>Accueil</a></li>
    <li>
        <div class="divider"></div>
    </li>

    <li><a class="subheader">Accéder aux calculs</a></li>

    <li class="no-padding">
        <ul class="collapsible collapsible-accordion  waves-teal">
            <li>
                <a class="collapsible-header">Calculs Enregistrés<i aria-hidden="true" class="material-icons">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>

                        @for ($i = 0; $i < 6; $i++)
                            <li><a class="waves-effect waves-teal" href="resultats.php?bouee={{$i}}&type=enr"><i aria-hidden="true" class="material-icons">insert_chart_outlined</i>Calcul {{$i}}</a></li>
                        @endfor

                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <li><a class="waves-effect waves-teal" href="resultats.php?bouee=2&type=prev"><i aria-hidden="true" class="material-icons">new_releases</i>Calcul en cours</a></li>

    <li><div class="divider"></div></li>

    <li><a class="subheader">Faire des calculs</a></li>

    <li><a class="waves-effect waves-teal" href="nouveauCalcul"><i aria-hidden="true" class="material-icons">add_circle_outline</i>Nouveau calcul</a></li>

</ul>
