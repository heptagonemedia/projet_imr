<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Daily UI 001 Sign Up Form</title>


    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/style.css">

    <?php require_once("BaseDeDonnees.php"); ?>


</head>

<body>

    <?php

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    // $connection = null;
    // $c = null;

    // if (!empty($_POST) /*&& empty($erreur)*/) {

    //     $connection = new BaseDeDonnees();
    //     //Connection à la BDD
    //     $connection->connect();

    //     //Récupération du lien
    //     $c = $connection->getLien();

    //     if ($connection) {
    //         $connection->insert($_POST, "scenario", $c);
    //     } else {
    //         die("Erreur de connection");
    //     }

    //     $connection->disconnect();
    // }

    ?>

    <div class="signupSection">

        <form action="#" method="POST" class="signupForm" name="signupform">

            <h2>Nouveau Scénario</h2>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="type-scenario"></label>
                    <input type="text" class="inputFields" id="type-scenario" name="type-scenario" placeholder="Type du scenario" value="" oninput="testerSiNombre(this.value, this.id)" required />
                </div>

                <div class="droite">
                    <label for="prendre-compte"></label>
                    <select name="prendre-compte" id="prendre-compte" class="inputFields">
                        <option value="true">Oui</option>
                        <option value="false">Non</option>
                    </select>
                </div>

            </div>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="temperature"></label>
                    <input type="text" class="inputFields" id="temperature" name="temperature" placeholder="Temperature valeur par défaut" value="" oninput="testerSiNombre(this.value, this.id)" required />
                </div>

                <div class="droite">
                    <label for="erreur-temp"></label>
                    <input type="text" class="inputFields" id="erreur-temp" name="erreur-temp" placeholder="Temperature erreur" value="" oninput="erreurValidation(this.value, this.id)" required />
                </div>

            </div>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="salinite"></label>
                    <input type="text" class="inputFields" id="salinite" name="salinite" placeholder="Salinité valeur par défaut" value="" oninput="testerSiNombre(this.value, this.id)" required />
                </div>

                <div class="droite">
                    <label for="erreur-salinite"></label>
                    <input type="text" class="inputFields" id="erreur-salinite" name="erreur-salinite" placeholder="Salinité erreur" value="" oninput="erreurValidation(this.value, this.id)" required />
                </div>

            </div>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="debit"></label>
                    <input type="text" class="inputFields" id="debit" name="debit" placeholder="Débit valeur par défaut" value="" oninput="testerSiNombre(this.value, this.id)" required />
                </div>

                <div class="droite">
                    <label for="erreur-debit"></label>
                    <input type="text" class="inputFields" id="erreur-debit" name="erreur-debit" placeholder="Débit erreur" value="" oninput="erreurValidation(this.value, this.id)" required />
                </div>

            </div>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="erreur-longitude"></label>
                    <input type="text" class="inputFields" id="erreur-longitude" name="erreur-longitude" placeholder="Longitude erreur" value="" oninput="erreurValidation(this.value, this.id)" required />
                </div>

                <div class="droite">
                    <label for="erreur-latitude"></label>
                    <input type="text" class="inputFields" id="erreur-latitude" name="erreur-latitude" placeholder="Latitude erreur" value="" oninput="erreurValidation(this.value, this.id)" required />
                </div>

            </div>

            <div class="conteneur-input">

                <div class="gauche">
                    <label for="decr-batterie"></label>
                    <input type="text" class="inputFields" id="decr-batterie" name="decr-batterie" placeholder="Batterie décrémentation" value="" oninput="erreurEntreeDecrementationBatterie(this.value)" required />
                </div>

                <div class="droite">
                    <label for="description"></label>
                    <textarea name="description" id="description" class="inputFields" placeholder="Description du scénario" value="" oninput="estDescriptionRemplie(this.value)" required></textarea>
                </div>

            </div>

            <div>
                <input type="submit" id="ajouter-btn" name="ajouter" alt="ajouter" value="Ajouter">
            </div>

        </form>


    </div>

    <script src="js/index.js"></script>

</body>

</html>