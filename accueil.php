<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="css/materialize.css">

  <title>AccueilIMR</title>

</head>

<body id="body">
                  <?php
                    $compteurFonctionelles = 0;
                    $compteurProbleme = 0;
                    $classe='';
                    $texte='';
                    for ($i=0; $i < 75; $i++):
                      if (rand(0,10)%2==0) {
                        $compteurFonctionelles++;
                        $classe='success';
                        $texte='Fonctionnelle';
                      }else {
                        $compteurProbleme++;
                        $classe='danger';
                        $texte='Problème';
                      }
                  ?>
                  <?php endfor ?>

    <ul id="slide-out" class="sidenav draggable">
        <li><div class="user-view">
                <div class="background">
                    <img src="eau.jpg" height="300px">
                </div>
                <a href="#user"><img src="logo.png" width="60px" height="50px"></a>
                <a href="#name"><span class="white-text name">Institut Maritime de Rimouski</span></a>
            </div></li>
        <li><a class="subheader">Accéder aux calculs</a></li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion  waves-green">
                <li>
                    <a class="collapsible-header">Calculs Enregistrés<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <?php for ($i = 0; $i<6;$i++):
                            echo '<li><a class="waves-effect" href="resultats.php?bouee='.$i.'&type=enr"><i class="material-icons">insert_chart_outlined</i>Calcul '.$i.'</a></li>';
                            endfor;
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li><a class="waves-effect" href="resultats.php?bouee=2&type=prev"><i class="material-icons">new_releases</i>Calcul en cours</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">Faire des calculs</a></li>
        <li><a class="waves-effect" href="formulaireRecherche.php"><i class="material-icons">add_circle_outline</i>Nouveau calcul</a></li>
    </ul>
<div id="ligne1" class="black" >
    <div class="row  ">
        <div class="col l1 center-align"><a href="#" data-target="slide-out" class="sidenav-trigger white-text" ><i class="material-icons" id="menu">menu</i></a></div>
        <div class="col l10 center-align">
            Accueil
        </div>
    </div>
</div>
        <div class="container">

            <div class=" col l10">
              <h4>Dernière mise à jour : DATE et HEURE</h4>
            </div>
        </div>
            <div class="row">
                <div class="col l8">
            <div class="card">
                <div >
                    <div class="" id="map" ></div>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col s6 center-align">Carte des bouées</div>
                        <div class="col s6 center-align"><button class="btn green" onclick="agrandirCarte(document.getElementById('map'))">
                                Plein ecran</button></div>
                    </div>
                </div>
            </div>
                </div>
                <div class="col l4">
                    <div class="card white">
                        <div class="card-content white-text">
                            <span class="card-title black-text center-align">Bouées non conforme</span>
                            <div class="container">
                                <div class="circle " id="false"><?php echo $compteurProbleme; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="card white center-align">
                        <div class="card-content white-text">
                            <span class="card-title black-text">Bouées conformes</span>
                            <div class="container center-align">
                                <div class="circle " id="true"><?php echo $compteurFonctionelles; ?></div>
                                <div/>
                        </div>
                    </div>
                </div>

                </div>


        </div>
<footer class="page-footer white foot">
    <div class="footer-copyright foot black pied">
        <div class="container valign-wrapper">
            © 2019 Heptagone Media
        </div>
    </div>
</footer>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous">
</script>

<script src="js/materialize.js"></script>
<script src="script.js"></script>
<script src="map.js"></script>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

</html>