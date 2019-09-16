<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />

  <title>AccueilIMR</title>

</head>

<body id="body">

  <div class="page-wrapper chiller-theme toggled" id="content">

    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="#">IMR</a>
          <div id="close-sidebar">
              <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
              <li>
                  <a href="accueil.php">
                      <i class="fa fa-home"></i>
                      <span>Accueil</span>
                  </a>
              </li>
            <li class="header-menu">
              <span>Bouées</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="far fa-life-ring"></i>
                <span>Bouées</span>
              </a>
              <div class="sidebar-submenu" id="scrollable">
                <ul>
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
                  <li>
                    <a href="accueil.php?bouee=<?php echo $i+1 ?>">Bouée <?php echo($i+1); ?><span class="badge badge-<?php echo($classe); ?>"><?php echo($texte); ?></span></a>
                  <li>
                  <?php endfor ?>
                </ul>
              </div>
            </li>

            <li class="header-menu">
              <span>Calculs</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Calculs enregistrés</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="index.php?page=resultats">26-02-2018</a>
                  </li>
                  <li>
                    <a href="index.php?page=resultats">29-08-2019</a>
                  </li>
                </ul>
              </div>
            </li>
              <li>
                  <a href="index.php?page=formulaireRecherche">
                      <i class="fa fa-calendar"></i>
                      <span>Prévisualiser calcul</span>
                  </a>
              </li>
              <li>
                  <a href="index.php?page=formulaireRecherche">
                      <i class="fa fa-calendar"></i>
                      <span>Calculs non enregistrés</span>
                  </a>
              </li>

            <li class="header-menu">
              <span>Option</span>
            </li>
              <!--
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-cog"></i>
                <span>Options graphiques</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">Option 1</a>
                  </li>
                  <li>
                    <a href="#">Option 2</a>
                  </li>
                </ul>
              </div>
              -->
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <main class="page-content" id='page' >
        <div class="container-fluid">
          <h1><?php if(!isset($_GET['bouee'])){echo "Accueil";}else{echo "Informations Bouée ".$_GET['bouee'];} ?></h1>
          <hr>
          <div class="row">
            <div class="form-group col-md-12">
              <h4>Dernière mise à jour : DATE et HEURE</h4>
            </div>
        </div>
        <div id="map" >
            <!-- Ici s'affichera la carte -->
        </div>
            <div class="row" >
                <div class="col-sm" align="center" id="boutonCarte">
                    <button class="btn btn-success" onclick="agrandirCarte(document.getElementById('map'))">
                        Plein ecran
                    </button>
                </div>
            </div>
            <div class="row">
                <div class='col-sm justify-content-center' align="center">
                    <div class='col-sm justify-content-center' align="center">
                        <B>Fonctionnelles</B>
                    </div>
                  <div class=" test">
                    <div class="circle" id="true"><?php echo $compteurFonctionelles; ?></div>
                  </div>

                </div>
                <div class='col-sm justify-content-center' align="center">
                    <div class='col-sm justify-content-center' align="center">
                        <B>Défaillantes</B>
                    </div>
                <div class="test">
                    <div class="circle" id="false"><?php echo $compteurProbleme; ?></div>
                </div>
                </div>
            </div>
        </div>
      </div>
      </main>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous">
  </script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous">
  </script>

  <script src="script.js"></script>
  <script src="map.js"></script>

  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

</body>

</html>