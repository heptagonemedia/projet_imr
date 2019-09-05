<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Recherche</title>

</head>
<body>

<div class="container">

    <h1>Effectuer une recherche</h1>
    <form method="post" action="resultats.php" class="form-horizontal">
        <h3>Intervalle :</h3>

        <div class="form-group">
            <label for="dateDepart" class="control-label col-sm-2">Date de départ :</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="dateDepart" name="dateDepart">
            </div>
        </div>

        <div class="form-group">
            <label for="heureDepart" class="control-label col-sm-2">Heure de départ :</label>
            <div class="col-sm-5">
                <input type="time" class="form-control" name="heureDepart" id="heureDepart" placeholder="hh:mm:ss">
            </div>
        </div>

        <div class="form-group">
            <label for="date_fin" class="control-label col-sm-2">Date de fin :</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="date_fin" placeholder="Entrer une date" name="dateFin">
            </div>
        </div>

        <div class="form-group">
            <label for="heureFin" class="control-label col-sm-2">Heure de fin :</label>
            <div class="col-sm-5">
                <input type="time" class="form-control" name="heureFin" id="heureFin" placeholder="hh:mm:ss">
            </div>
        </div>


        <div class="form-group">
            <label for="choixStat" class="control-label col-sm-3">Calcul(s) à effectuer :</label>
            <div class="col-sm-4">
                <select class="form-control" id="choixStat">
                    <option>Moyenne + Mediane + Ecart-type</option>
                    <option>Moyenne</option>
                    <option>Mediane</option>
                    <option>Ecart-type</option>        
                </select>
            </div>
        </div> 

        <div class="form-group">
            <label for="selectionBouee" class="control-label col-sm-3">Selectionner une bouée :</label>
            <div class="col-sm-4">
                <select class="form-control" id="selectionBouee">
                    <?php  for ($i=0; $i < 75; $i++): ?>
                    <option>Bouée <?php echo($i+1); ?></option>
                    <?php endfor; ?>
                    
                </select>
            </div>
        </div>

        <h3>Fréquence :</h3>
        <div class="form-group">
            <label for="freq_A" class="control-label col-sm-1">Année :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_A" id="freq_A">
            </div>

            <label for="freq_Mois" class="control-label col-sm-1">Mois :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_Mois" id="freq_Mois">
            </div>

            <label for="freq_J" class="control-label col-sm-1">Jour :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_J" id="freq_J">
            </div>

            <label for="freq_H" class="control-label col-sm-1">Heure :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_H" id="freq_H">
            </div>

            <label for="freq_Min" class="control-label col-sm-1">Minute :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_Min" id="freq_Min">
            </div>

            <label for="freq_S" class="control-label col-sm-1">Seconde :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="freq_S" id="freq_S">
            </div>
        </div>

        <div class="form-group">
            <label for="enregistrer" class="control-label col-sm-4">Voulez-vous enregistrer cette recherche : &nbsp&nbsp<input type="checkbox" id="enregistrer" value=""></label>
        </div>

        
        <div class="row" style="height: 4%;"></div>

        <div class="col-sm-1">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1">
            <a role="button" class="btn btn-secondary" href="index.php?page=accueil">Retour à la page d'accueil</a>
        </div>
        
    </form>

</div>

    
</body>
</html>