<nav>
    <div class="nav-wrapper black">
        <div class="row">

            <?php
            // echo($_SERVER['REQUEST_URI']);
            ?>

            <?php
            $titre = '';

            if (strpos($_SERVER['REQUEST_URI'], "accueil") !== false) :
                $titre = 'Accueil';
                ?>
                <div class="col black m1 l4 center-align">
                    <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button>
                </div>
                <div class="col black m11 l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

            <?php
            elseif (strpos($_SERVER['REQUEST_URI'], "formulaireRecherche") !== false) :
                $titre = 'Formulaire de Recherche';
                ?>

                <div class="col black s12 m1 l4 center-align">
                    <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button>
                </div>
                <div class="col black s12 m6 l4 center-align" style="font-size: 18pt"><?= $titre ?></div>

                <div class="col black s12 m5 l4 center align">
                    <a href="accueil.php" class="breadcrumb">accueil</a>
                    <a href="#" class="breadcrumb" >formulaire</a>
                </div>

            <?php
            elseif (strpos($_SERVER['REQUEST_URI'], "resultats") !== false) :
                $titre = 'Résultat du calcul';
                ?>
                <div class="col s1 m1 l4 center-align"><button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button></div>
                <div class="black col s12 m5 l3 center-align" style="font-size: 18pt">Résultat du calcul</div>
                <div class="black col s12 m6 l5 center align ">

                    <a href="accueil.php" class="breadcrumb">accueil</a>
                    <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
                    <a href="#" class="breadcrumb">Calcul : <?php if (isset($_POST['bouee'])) {
                                                                    echo $_POST['bouee'];
                                                                }elseif (isset($_GET["bouee"])){
                                                                    echo $_GET["bouee"];
                                                                }else {
                                                                    echo " nom";
                                                                } ?></a>
                </div>
            <?php
            else :
                $titre = 'Accueil';
                ?>
                <div class="col black m1 l4 center-align">
                    <button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button>
                </div>
                <div class="col black m11 l4 center-align" style="font-size: 18pt"><?= $titre ?></div>
            <?php
            endif;
            ?>



        </div>
    </div>
</nav>