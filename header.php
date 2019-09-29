<nav>
    <div class="nav-wrapper black">
        <div class="row">

            <div class="col l4 center-align">
                <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button>
            </div>

            <?php
            $titre = '';

            if (strpos($_SERVER['REQUEST_URI'], "accueil") !== false) :
                $titre = 'Accueil';
                ?>
                <div class="col l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

            <?php
            elseif (strpos($_SERVER['REQUEST_URI'], "formulaireRecherche") !== false) :
                $titre = 'Formulaire de Recherche';
                ?>

                <div class="col l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

                <div class="col l4 center align ">
                    <a href="accueil.php" class="breadcrumb">accueil</a>
                    <a href="#" class="breadcrumb">formulaire</a>
                </div>

            <?php
            elseif (strpos($_SERVER['REQUEST_URI'], "resultats") !== false) :
                $titre = 'Résultat du calcul';
                ?>

                <div class="col l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

                <div class="col l4 center align ">
                    <a href="accueil.php" class="breadcrumb">accueil</a>
                    <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
                    <a href="#" class="breadcrumb">Calcul : nom</a>
                </div>

            <?php
            endif;
            ?>



        </div>
    </div>
</nav>