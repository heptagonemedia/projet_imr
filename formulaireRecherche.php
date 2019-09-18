<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="formulaireCss.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQuery -->
</head>
<title>webdamn.com : Create Material Design Login and Register Form</title>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>


<nav>
    <div class="nav-wrapper grey">
        <a href="#!" class="brand-logo right"><img src="https://cdn.discordapp.com/attachments/614172601337643142/615001645788430366/Final1.png" width="50px" height="50px"></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse">
            <i class="material-icons">menu</i>
        </a>
        <ul class="left hide-on-med-and-down">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Formulaire</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Formulaire</a></li>
        </ul>
    </div>
</nav>


<div class="container" style="padding-top: 50px">

    <div id="register-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="register-form">
                <div class="row margin">
                    <div class="input-field col s2">
                        <i class="mdi-content-add prefix"></i>
                        <label>Calcul</label>
                    </div>
                    <div class="input-field col s10">
                        <input type="checkbox" id="moyenne" />
                        <label for="moyenne">Moyenne</label><br>
                        <input type="checkbox" id="mediane" />
                        <label for="mediane">Mediane</label><br>
                        <input type="checkbox" id="ecartType" />
                        <label for="ecartType">Ecart-Type</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s2">
                        <i class="mdi-action-settings-backup-restore prefix"></i>
                        <label>Fréquence</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="annee" type="number">
                        <label for="annee" class="center-align">Année</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="mois" type="number">
                        <label for="mois" class="center-align">Mois</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="jour" type="number">
                        <label for="jour" class="center-align">Jour</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heure" type="number">
                        <label for="heure" class="center-align">Heure</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="minute" type="number">
                        <label for="minute" class="center-align">Minute</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s2">
                        <i class="mdi-action-list prefix"></i>
                        <label>Bouée</label>
                    </div>
                    <div class="input-field col s10">
                        <input id="bouee" type="number">
                        <label id="bouee" for="bouee" style="width: 500px">Numero</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s2">
                        <i class="mdi-editor-insert-invitation prefix"></i>
                        <label>Intervalle temporel</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="dateDebut" type="date" class="datepicker">
                        <label for="dateDebut" data-error="Please enter your first name.">Date début</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heureDebut" type="text">
                        <label for="heureDebut">Heure début</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="dateFin" type="date" class="datepicker">
                        <label for="dateFin">Date fin</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heureFin" type="text">
                        <label for="heureFin">Heure fin</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s2">
                        <i class="mdi-content-save prefix"></i>
                        <label>Enregistrer calcul</label>
                    </div>
                    <div class="input-field col s10">
                        <!-- Switch -->
                        <div class="switch">
                            <label>
                                Non
                                <input type="checkbox">
                                <span class="lever"></span>
                                Oui
                            </label>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row margin">
                    <div class="input-field col s12">
                        <a href="#" class="btn waves-effect waves-light pastel col s12" onclick="detecterErreurs('prev')">Valider</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>


</html>
<script type="text/javascript" src="script.js"></script>
<script>$('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
</script>
<script>

    $(".button-collapse").sideNav();
</script>
</html>
