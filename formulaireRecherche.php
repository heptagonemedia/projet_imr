<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="formulaireCss.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQuery -->
</head>
<title>Formulaire</title>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<nav>
    <div class="nav-wrapper grey">
        <a href="#" class="brand-logo right"><img src="https://cdn.discordapp.com/attachments/614172601337643142/615001645788430366/Final1.png" width="50px" height="50px"></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="formulaireRecherche.php">Formulaire</a></li>
        </ul>
    </div>
</nav>



<div class="container" style="padding-top: 30px">

    <div id="register-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="register-form">
                <div class="row">
                    <div class="input-field col s2">
                        <i class="small material-icons prefix">content_paste</i>
                        <label>Calcul</label>
                    </div>
                    <div class="input-field col s10">
                        <p>
                            <label style="padding-top: 10px">
                                <input name="calcul" type="radio" value="moyenne" id="moyenne" checked />
                                <span>Moyenne</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="calcul" type="radio" value="mediane" id="mediane" />
                                <span>Mediane</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="calcul" type="radio"  value = "ecart" id="ecart" />
                                <span>Ecart type</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row" id="marge">
                    <div class="input-field col s2">
                        <i class="small material-icons prefix">history</i>
                        <label>Fréquence</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="annee" type="text">
                        <label for="annee" class="center-align">Année</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="mois" type="text">
                        <label for="mois" class="center-align">Mois</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="jour" type="text">
                        <label for="jour" class="center-align">Jour</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heure" type="text">
                        <label for="heure" class="center-align">Heure</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="minute" type="text">
                        <label for="minute" class="center-align">Minute</label>
                    </div>
                    <div class="col s2">
                    </div>
                    <div class="col s10">
                        <span class="helper-text" id="frequence" style="display: none"><label style="color: red">Il faut saisir au moins une valeur et uniquement des entiers</label></span>
                    </div>
                </div>
                <div class="row" id="marge">
                    <div class="input-field col s2">
                        <i class="small material-icons prefix">location_searching</i>
                        <label>Bouée</label>
                    </div>
                    <div class="input-field col s10">
                        <input type="number" id="bouee">
                        <label for="bouee" style="width: 500px;">Numero</label>
                    </div>
                    <div class="col s2">
                    </div>
                    <div class="col s10">
                        <span class="helper-text" id="HelperBouee" style="display: none"><label style="color: red">Il faut entrer un entier compris entre 1 et 75</label></span>
                    </div>
                </div>
                <div class="row" id="marge">
                    <div class="input-field col s2">
                        <i class="small material-icons prefix">date_range</i>
                        <label>Intervalle temporel</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="dateDeb" type="text" class="datepicker">
                        <label for="dateDeb">Date début</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heureDeb" type="text" class="timepicker">
                        <label for="heureDeb">Heure début</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="dateFin" type="text" class="datepicker">
                        <label for="dateFin">Date fin</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="heureFin" type="text" class="timepicker">
                        <label for="heureFin">Heure fin</label>
                    </div>
                    <div class="col s2">
                    </div>
                    <div class="col s10">
                        <span class="helper-text" id="heureTest" style="display: none"><label style="color: red">Il faut que la date de fin soit supérieure à celle de début</label></span>
                    </div>
                </div>
                <div class="row" id="marge">
                    <div class="input-field col s2">
                        <i class="small material-icons prefix">save</i>
                        <label>Enregistrer calcul</label>
                    </div>
                    <div class="input-field col s10">
                        <!-- Switch -->
                        <div class="switch" style="padding-top: 12px">
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
                <div class="row" id="marge">
                    <div class="input-field col s12">
                        <a href="#" class="btn waves-effect waves-light pastel col s12" onclick="detecterErreurs()">Valider</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>


</html>
<script type="text/javascript" src="script.js"></script>
</html>
