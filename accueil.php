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
<!---->
<!--  <div class="page-wrapper chiller-theme toggled" id="content">-->
<!---->
<!--    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">-->
<!--      <i class="fas fa-bars"></i>-->
<!--    </a>-->
<!--    <nav id="sidebar" class="sidebar-wrapper">-->
<!--      <div class="sidebar-content">-->
<!--        <div class="sidebar-brand">-->
<!--          <a href="#">IMR</a>-->
<!--          <div id="close-sidebar">-->
<!--              <i class="fas fa-times"></i>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="sidebar-menu">-->
<!--          <ul>-->
<!--              <li>-->
<!--                  <a href="accueil.php">-->
<!--                      <i class="fa fa-home"></i>-->
<!--                      <span>Accueil</span>-->
<!--                  </a>-->
<!--              </li>-->
<!--            <li class="header-menu">-->
<!--              <span>Bouées</span>-->
<!--            </li>-->
<!--            <li class="sidebar-dropdown">-->
<!--              <a href="#">-->
<!--                <i class="far fa-life-ring"></i>-->
<!--                <span>Bouées</span>-->
<!--              </a>-->
<!--              <div class="sidebar-submenu" id="scrollable">-->
<!--                <ul>-->
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
<!--                  <li>-->
<!--                    <a href="accueil.php?bouee=--><?php //echo $i+1 ?><!--">Bouée --><?php //echo($i+1); ?><!--<span class="badge badge---><?php //echo($classe); ?><!--">--><?php //echo($texte); ?><!--</span></a>-->
<!--                  <li>-->
                  <?php endfor ?>
<!--                </ul>-->
<!--              </div>-->
<!--            </li>-->
<!---->
<!--            <li class="header-menu">-->
<!--              <span>Calculs</span>-->
<!--            </li>-->
<!--            <li class="sidebar-dropdown">-->
<!--              <a href="#">-->
<!--                <i class="fa fa-calendar"></i>-->
<!--                <span>Calculs enregistrés</span>-->
<!--              </a>-->
<!--              <div class="sidebar-submenu">-->
<!--                <ul>-->
<!--                  <li>-->
<!--                    <a href="index.php?page=resultats">26-02-2018</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                    <a href="index.php?page=resultats">29-08-2019</a>-->
<!--                  </li>-->
<!--                </ul>-->
<!--              </div>-->
<!--            </li>-->
<!--              <li>-->
<!--                  <a href="index.php?page=formulaireRecherche">-->
<!--                      <i class="fa fa-calendar"></i>-->
<!--                      <span>Prévisualiser calcul</span>-->
<!--                  </a>-->
<!--              </li>-->
<!--              <li>-->
<!--                  <a href="index.php?page=formulaireRecherche">-->
<!--                      <i class="fa fa-calendar"></i>-->
<!--                      <span>Calculs non enregistrés</span>-->
<!--                  </a>-->
<!--              </li>-->
<!--            <li class="header-menu">-->
<!--              <span>Option</span>-->
<!--            </li>-->
<!--            <li class="sidebar-dropdown">-->
<!--              <a href="#">-->
<!--                <i class="fas fa-cog"></i>-->
<!--                <span>Options graphiques</span>-->
<!--              </a>-->
<!--              <div class="sidebar-submenu">-->
<!--                <ul>-->
<!--                  <li>-->
<!--                    <a href="#">Option 1</a>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                    <a href="#">Option 2</a>-->
<!--                  </li>-->
<!--                </ul>-->
<!--              </div>-->
<!--              -->
<!--            </li>-->
<!---->
<!--          </ul>-->
<!--        </div>-->
<!--      </div>-->
<!--    </nav>-->

    <ul id="slide-out" class="sidenav">
        <li><div class="user-view">
                <div class="background">
                    <img src="eau.jpg" height="300px">
                </div>
                <a href="#user"><img src="logo.png" width="60px" height="50px"></a>
                <a href="#name"><span class="white-text name">Institut Maritime de Rimouski</span></a>
            </div></li>
        <li><a class="subheader">Accéder aux calculs</a></li>
        <li><a href="resultats.php?bouee=2&type=enr"><i class="material-icons">save</i>Calculs Enregistrés</a></li>
        <li><a href="resultats.php?bouee=2&type=prev"><i class="material-icons">new_releases</i>Calcul en cours</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">Faire des calculs</a></li>
        <li><a class="waves-effect" href="formulaireRecherche.php"><i class="material-icons">add_circle_outline</i>Nouveau calcul</a></li>
    </ul>
<div id="ligne1" class="black" >
    <div class="row  ">
        <div class="col l1 center-align"><a href="#" data-target="slide-out" class="sidenav-trigger white-text" ><i class="material-icons">menu</i></a></div>
        <div class="col l10 center-align">
            <?php if(!isset($_GET['bouee'])){echo "Accueil";}else{echo "Informations Bouée ".$_GET['bouee'];} ?>
        </div>
    </div>
</div>
        <div class="container">
          <div class="row">

            <div class=" col l10">
              <h4>Dernière mise à jour : DATE et HEURE</h4>
            </div>
        </div>
            <div class="row">
                <div class="col l8">
            <div class="card">
                <div class="card-image">
                    <div class="chart" id="map" ></div>
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
                    <div class="card white center-align">
                        <div class="card-content white-text">
                            <span class="card-title black-text">Bouées non conforme</span>
                            <div class="container center-align">
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