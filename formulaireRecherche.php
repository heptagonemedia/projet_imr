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
    <div class="alert alert-danger" role="alert" hidden="hidden" id="alerte">
        <p id="text"></p>
    </div>
    <h1>Formulaire</h1>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3" for="calcul" id="calculError">Calcul* </label>
            <div class="col-sm-6">
                <label><input type="radio" name="calcul" id="mediane" value="Médiane"> Médiane</label>
                <label><input type="radio" name="calcul" id="moyenne" value="Moyenne"> Moyenne</label>
                <label><input type="radio" name="calcul" id="ecartType" value="Ecart type"> Ecart type</label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="frequence" id="frequenceError">Fréquence* </label>
            <div class="col-sm-8">
                <label>Année<input type="text" class="form-control" name="frequence"></label>
                <label>Mois<input type="text" class="form-control" name="frequence"></label>
                <label>Jour<input type="text" class="form-control" name="frequence"></label><br>
                <label>Heure<input type="text" class="form-control" name="frequence"></label>
                <label>Minute<input type="text" class="form-control" name="frequence"></label>
                <label>Seconde<input type="text" class="form-control" name="frequence"></label><br>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="bouee" id="boueeError">Bouée* </label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="bouee">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="intervalle" id="intervalleError">Intervalle temporel* </label>
            <div class="col-sm-8">
                <label>Date de départ<input type="date" class="form-control" name="intervalle"></label><br>
                <label>Heure de départ<input type="time" class="form-control" name="intervalle"></label><br>
                <label>Date de fin<input type="date" class="form-control" name="intervalle"></label><br>
                <label>Heure de fin<input type="time" class="form-control" name="intervalle"></label><br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" onclick="detectErrors()">Prévisualiser calcul</button>
                <button type="button" class="btn btn-primary" onclick="detectErrors()">Enregister calcul</button>
            </div>
        </div>
    </form>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-target="#exampleModal" id="marche" onclick="test()" style="display:none;">  </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Résultats du sondage : </h3>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</html>