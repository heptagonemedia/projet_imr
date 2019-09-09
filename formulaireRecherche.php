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
    <div class="alert alert-danger" role="alert" hidden="hidden" id="divAlerte">
        <p id="texteAlerte"></p>
    </div>
    <h1>Formulaire</h1>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3" for="calcul" id="calculErreur">Calcul* </label>
            <div class="col-sm-6">
                <label><input type="radio" name="calcul" id="mediane" value="med"> Médiane</label>
                <label><input type="radio" name="calcul" id="moyenne" value="moy"> Moyenne</label>
                <label><input type="radio" name="calcul" id="ecartType" value="eca"> Ecart type</label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="frequence" id="frequenceErreur">Fréquence* </label>
            <div class="col-sm-8">
                <label id="anneeErreur">Année<input type="text" class="form-control" name="frequence" id="annee" value="0"></label>
                <label id="moisErreur">Mois<input type="text" class="form-control" name="frequence" id="mois" value="0"></label>
                <label id="jourErreur">Jour<input type="text" class="form-control" name="frequence" id="jour" value="0"></label><br>
                <label id="heureErreur">Heure<input type="text" class="form-control" name="frequence" id="heure" value="0"></label>
                <label id="minuteErreur">Minute<input type="text" class="form-control" name="frequence" id="minute" value="0"></label>
                <label id="secondeErreur">Seconde<input type="text" class="form-control" name="frequence" id="seconde" value="0"></label><br>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="bouee" id="boueeErreur">Bouée* </label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="bouee">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="intervalle" id="intervalleErreur">Intervalle temporel* </label>
            <div class="col-sm-8">
                <label>Date de départ<input type="date" class="form-control" id="dateDepart"></label><br>
                <label>Heure de départ<input type="time" class="form-control" id="heureDepart"></label><br>
                <label>Date de fin<input type="date" class="form-control" id="dateFin"></label><br>
                <label>Heure de fin<input type="time" class="form-control" id="heureFin"></label><br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" onclick="detecterErreurs()">Prévisualiser calcul</button>
                <button type="button" class="btn btn-primary" onclick="detecterErreurs()">Enregister calcul</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>
<!--
<script>
    function detecterErreurs(type){
        //apres la detection d erreurs
        var annee = $('#annee').val();
        var mois = $('#mois').val();
        var jour = $('#jour').val();
        var heure = $('#heure').val();
        var minute = $('#minute').val();
        var seconde = $('#seconde').val();
        var calcul = $('input[name=calcul]:checked').val();
        var bouee = $('#bouee').val();
        var dateDep = $('#dateDepart').val();
        var heureDep = $('#heureDepart').val();
        var dateFin = $('#dateFin').val();
        var heureFin = $('#heureFin').val();
        var lien = "resultats.php?";
        lien += 'annee='+annee;
        lien += '&mois='+mois;
        lien += '&jour='+jour;
        lien += '&heure='+heure;
        lien += '&minute='+minute;
        lien += '&seconde='+seconde;
        lien += '&calcul='+calcul;
        lien += '&bouee='+bouee;
        lien += '&dateDep='+dateDep;
        lien += '&heureDep='+heureDep;
        lien += '&dateFin='+dateFin;
        lien += '&heureFin='+heureFin;
        lien += '&type='+type;
        

        console.log(lien);
        window.location.href = lien;
    }
</script>
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</html>