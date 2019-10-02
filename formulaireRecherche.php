<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="css/formulaireCss.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>Formulaire</title>

    </head>


    <script src="js/materialize.js"></script>

    <body>

        <?php
            include('navigation_side_bar_formulaire_calculs.php');
        include "header_formulaire.php";
        ?>


        <main>

            <div class="container">
                <div id="register-page" class="row">

                    <div class="col s12 z-depth-6 card-panel">

                        <form class="register-form" id="formulaire" method="post" action="resultats.php">

                            <div class="row">

                                <div class="input-field col s2">
                                    <i class="small material-icons prefix">content_paste</i>
                                    <label>Calcul</label>
                                </div>

                                <div class="input-field col s10">
                                    <p>
                                        <label id="radio">
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
                                    <input name="annee" id="annee" type="text">
                                    <label for="annee" class="center-align">Année</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="mois" name="mois" type="text">
                                    <label for="mois" class="center-align">Mois</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="jour" name="jour" type="text">
                                    <label for="jour" class="center-align">Jour</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="heure" name="heure" type="text">
                                    <label for="heure" class="center-align">Heure</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="minute" name="minute" type="text">
                                    <label for="minute" class="center-align">Minute</label>
                                </div>

                                <div class="col s2"></div>

                                <div class="col s10">
                                    <span class="helper-text" id="frequence" name=" frequence"><label id="alerte">Il faut saisir au moins une valeur et uniquement des entiers</label></span>
                                </div>

                            </div>

                            <div class="row" id="marge">

                                <div class="input-field col s2">
                                    <i class="small material-icons prefix">location_searching</i>
                                    <label>Bouée</label>
                                </div>

                                <div class="input-field col s10">
                                    <input type="number" name="bouee" id="bouee">
                                    <label for="bouee" id="labelBouee">Numero</label>
                                </div>

                                <div class="col s2"></div>

                                <div class="col s10">
                                    <span class="helper-text" id="HelperBouee"><label id="alerte">Il faut entrer un entier compris entre 1 et 75</label></span>
                                </div>

                            </div>

                            <div class="row" id="marge">

                                <div class="input-field col s2">
                                    <i class="small material-icons prefix">date_range</i>
                                    <label>Intervalle temporel</label>
                                </div>

                                <div class="input-field col s3">
                                    <input id="dateDeb" type="text"  name="dateDeb" class="datepicker">
                                    <label for="dateDeb">Date début</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="heureDeb" type="text" name="heureDeb" class="timepicker">
                                    <label for="heureDeb">Heure début</label>
                                </div>

                                <div class="input-field col s3">
                                    <input id="dateFin" type="text" name="dateFin" class="datepicker">
                                    <label for="dateFin">Date fin</label>
                                </div>

                                <div class="input-field col s2">
                                    <input id="heureFin" type="text" name="heureFin" class="timepicker">
                                    <label for="heureFin">Heure fin</label>
                                </div>

                                <div class="col s2"></div>

                                <div class="col s10">
                                    <span class="helper-text" id="heureTest"><label id="alerte">Il faut que la date de fin soit supérieure à celle de début</label></span>
                                </div>

                            </div>

                            <div class="row" id="marge">

                                <div class="input-field col s2">
                                    <i class="small material-icons prefix">save</i>
                                    <label>Enregistrer calcul</label>
                                </div>

                                <div class="input-field col s10">
                                    <!-- Switch -->
                                    <div class="switch">
                                        <label>
                                            Non
                                            <input type="checkbox" name="type" value="enr">
                                            <span class="lever"></span>
                                            Oui
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <!-- <br><br> -->

                            <div class="row" id="marge">

                                <div class="input-field col s12">
                                    <a href="#" class="btn waves-effect waves-light pastel col s12" onclick="detecterErreurs()">Valider</a>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </main>

        <?php
            include('footer.php');
        ?>

    </body>


    <script type="text/javascript" src="js/script.js"></script>

</html>
