<nav>
    <div class="nav-wrapper black">
        <div class="row">
            <div class="col s1 m1 l4 center-align"><button href="#" data-target="slide-out" class="sidenav-trigger btn black white-text"><i class="material-icons" id="menu">menu</i></button></div>
            <div class="black col s12 m5 l3 center-align" style="font-size: 18pt">Résultat du calcul</div>
            <div class="black col s12 m6 l5 center align ">

                <a href="accueil.php" class="breadcrumb">accueil</a>
                <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
                <a href="#" class="breadcrumb">Calcul : <?php if (isset($_POST['bouee'])){echo $_POST['bouee'];}else{echo " nom";} ?></a>
            </div>
        </div>
    </div>
</nav>