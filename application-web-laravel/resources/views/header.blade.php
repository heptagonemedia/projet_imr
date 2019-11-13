<nav>
    <div class="nav-wrapper black">
        <div class="row">

            @php
                $titre = '';

            @endphp

            @if (strpos($_SERVER['REQUEST_URI'], "accueil") !== false)

                @php
                    $titre = 'Accueil';
                @endphp

                <div class="col black m1 l4 center-align">
                    <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button>
                </div>
                <div class="col black m11 l4 center-align" style="font-size: 18pt">{{ $titre }}</div>

                @else @if (strpos($_SERVER['REQUEST_URI'], "nouveauCalcul") !== false)

                            @php
                                $titre = 'Faire un nouveau calcul';
                            @endphp

                            <div class="col black s12 m1 l4 center-align">
                                <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i aria-hidden="true" class="material-icons" id="menu">menu</i></button>
                            </div>
                            <div class="col black s12 m6 l4 center-align" style="font-size: 18pt">{{ $titre }}</div>

                            <div class="col black s12 m5 l4 black center align ">
                                <a href="accueil.php" class="breadcrumb">accueil</a>
                                <a href="#" class="breadcrumb">formulaire</a>
                            </div>


                      @else @if (strpos($_SERVER['REQUEST_URI'], "test") !== false)
                                @php
                                    $titre = 'Résultats du calcul';
                                @endphp

                                <div class="col s1 m1 l4 center-align"><button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i aria-hidden="true" class="material-icons" id="menu">menu</i></button></div>
                                <div class="black col s12 m5 l3 center-align" style="font-size: 18pt">{{ $titre }}</div>
                                <div class="black col s12 m6 l5 center align ">

                                    <a href="accueil.php" class="breadcrumb">accueil</a>
                                    <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
                                    <a href="#" class="breadcrumb">Calcul : <?php if (isset($_POST['bouee'])) {
                                                                                    echo $_POST['bouee'];
                                                                                } else {
                                                                                    echo " nom";
                                                                                } ?></a>
                                </div>

                            @else

                                @php
                                    $titre = 'Accueil';
                                @endphp

                                <div class="col black m1 l4 center-align">
                                    <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i aria-hidden="true" class="material-icons" id="menu">menu</i></button>
                                </div>
                                <div class="col black m11 l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

                            @endif

            @endif

        </div>
    </div>
</nav>
