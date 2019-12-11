
<nav role="navigation" aria-label="header">
    <div class="nav-wrapper black">
        <div class="row">

            @php
                $titre = '';

            @endphp

            @if (strpos($_SERVER['REQUEST_URI'], "accueil") !== false)

                @php
                    $titre = __('message.accueilNavigation'); // 'Accueil';
                @endphp

                <div class="col black m1 l4 center-align">
                    <button  role="button" data-target="slide-out" onclick="ouvrirSidenav()" class="sidenav-trigger btn black white-text"><i aria-hidden="true" aria-label="{!! __('message.ouvrirMenu') !!}" class="material-icons" id="menu">menu</i></button>
                </div>

                <div class="col black m11 l4 center-align" style="font-size: 18pt"><h1>{{ $titre }}</h1></div>

            @else @if (strpos($_SERVER['REQUEST_URI'], "nouveauCalcul") !== false)

                @php
                    $titre = __('message.nouveauCalcul'); // 'Faire un nouveau calcul';
                @endphp

                <div class="col black s12 m1 l4 center-align">
                    <button role="button" data-target="slide-out" onclick="ouvrirSidenav()" class="sidenav-trigger btn black white-text"><i aria-label="{!! __('message.ouvrirMenu') !!}" aria-hidden="true" class="material-icons" id="menu">menu</i></button>
                </div>
                <div class="col black s12 m6 l4 center-align" style="font-size: 18pt"><h1>{{ $titre }}</h1></div>

                <div class="col black s12 m5 l4 black center align ">
                    <a href="accueil.php" class="breadcrumb">accueil</a>
                    <a href="#" class="breadcrumb">formulaire</a>
                </div>


            @else @if (strpos($_SERVER['REQUEST_URI'], "test") !== false)
                    @php
                        $titre = __('message.titleResultat'); // 'Résultats du calcul';
                    @endphp

                    <div class="col s1 m1 l4 center-align"><button role="button" data-target="slide-out" onclick="ouvrirSidenav()" class="sidenav-trigger btn black white-text"><i aria-label="{!! __('message.ouvrirMenu') !!}" aria-hidden="true" class="material-icons" id="menu">menu</i></button></div>
                    <div class="black col s12 m5 l3 center-align" style="font-size: 18pt"><h1>{{ $titre }}</h1></div>
                    <div class="black col s12 m6 l5 center align ">

                        <a href="accueil.php" class="breadcrumb">accueil</a>
                        <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
                        <a href="#" class="breadcrumb">Calcul : </a>
                    </div>

                @else

                    @php
                        $titre = __('message.accueilNavigation'); // 'Accueil';
                    @endphp

                    <div class="col black m1 l4 center-align">
                        <button role="button" data-target="slide-out" onclick="ouvrirSidenav()" class="sidenav-trigger btn black white-text"><i aria-label="{!! __('message.ouvrirMenu') !!}" aria-hidden="true" class="material-icons" id="menu">menu</i></button>
                    </div>
                    <div class="col black m11 l4 center-align" style="font-size: 18pt"><h1>{{ $titre }}</h1></div>

                @endif

            @endif

        </div>
    </div>
</nav>
