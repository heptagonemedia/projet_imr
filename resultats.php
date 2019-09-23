<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="EJSCharts/EJSChart.css">
    <script src="https://kit.fontawesome.com/e14504e0cd.js"></script>

    <script type="text/javascript" src="EJSCharts/EJSChart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="proto.css">

    <!-- Compiled and minified JavaScript -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Resultats</title>
</head>
<body>

<!-- Ligne en haut de la page -->
<div id="ligne1" class="black" >
    <div class="row  ">

        <div class="col l3  ">
            <a href="accueil.php" class="breadcrumb">accueil</a>
            <a href="formulaireRecherche.php" class="breadcrumb">formulaire</a>
            <a href="#" class="breadcrumb">résultat</a>
        </div>
        <div class="col l6">
            <?php
            if (isset($_GET['type']) && $_GET['type'] == 'prev'):
                echo 'Prévisualisation';
            else:
                echo 'Calcul enregistré';
            endif;
            ?></div>
        <div class="col l3  right-align"><?php if (isset($_GET['bouee'])): echo 'Bouée '.$_GET['bouee']; endif; ?></div>
    </div>
</div>

<!-- Ligne de la carte et du premier Graphique -->
<div  id="col1">
    <div class="row">
        <div class="map col s6 " id="map"  >
        </div>
        <div class="stat1 col s6 "  >
            <div class="card">
                <div class="card-image">
                    <div class="chart" id="myChart" ></div>
                </div>
                <div class="card-content">
                    <p>Vitesse du courant</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ligne du bandeau au milieu de la page -->
<div class="container-fluid black" id='ligne2' >
    <div class="row ">
        <div class="col s6 colLigne2">
            <a href="#" id="btnCarte" class="lien" onclick="agrandirCarte(document.getElementById('map'))" >Agrandir la Carte</a>
        </div>
        <div class='col s6 colLigne2' >
            <a class="lien" href="" >Consulter les données brutes</a>  <!-- TODO Changer le style -->
        </div>
    </div>
</div>

<!-- Ligne du bas avec les 2 derniers Graphiques -->
<div>
    <div class="row">
        <div class="col s6 chart" >
            <div class="card">
                <div class="card-image">
                    <div class="chart" id="myChart2" ></div>
                </div>
                <div class="card-content">
                    <p>Salinité</p>
                </div>
            </div>
        </div>

        <div class="col s6 chart" >
            <div class="card">
                <div class="card-image">
                    <div class="chart" id="myChart3" ></div>
                </div>
                <div class="card-content">
                    <p>Température</p>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">more_vert</i>
    </a>
    <ul>

        <li><a class="btn-floating purple tooltipped" data-position="left" data-tooltip="Agrandir la carte" onclick="agrandirCarte(document.getElementById('map'))"><i class="material-icons">crop_free</i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-tooltip="Nouveau calcul" href="formulaireRecherche.php"><i class="material-icons">add_circle_outline</i></a></li>
        <li><a class="btn-floating pink tooltipped" data-position="left" data-tooltip="Accueil" href="accueil.php"><i class="material-icons">home</i></a></li>

        <?php if(isset($_GET["type"]) && $_GET['type']=='prev' ): ?>
        <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-tooltip="Retourner au formulaire" onclick="retourFormulaire()"><i class="material-icons">arrow_back</i></a></li>
        <li><a class="btn-floating green waves-effect waves-light btn modal-trigger tooltipped" data-position="left" data-tooltip="Enregistrer le calcul" href="#modal1" onclick = "enregistrer()"><i class="material-icons">save</i></a></li>
        <?php endif;?>
    </ul>
</div>

<footer class="page-footer white foot">
    <div class="footer-copyright foot black pied">
        <div class="container valign-wrapper">
            © 2019 Heptagone Media
        </div>
    </div>
</footer>
<form method="post" id='formulaire' action="resultats.php">
    <input type="hidden" value="enr" name="type">
</form>

<?php

if(isset($_GET["type"])):
    $type = $_GET["type"];
    if($type == "prev"):
        ?>
        <div id="modal1" class="modal row s6">
            <div class="modal-content col s12">
                <h4>Calcul enregistré</h4>
                <p>le calcul a bien été enregitré</p>
            </div>
            <div class="modal-footer green col s12">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">ok</a>
            </div>
        </div>

        <?php
//    elseif($type == "enr"):
//        ?>
        <!--        <div id='message' class="container-fluid">-->
        <!--            <div class = "row">-->
        <!--                <div class="col-sm-4"></div>-->
        <!--                <button class="col-sm alert alert-success pulse" role="alert" onclick="fermer()";>-->
        <!--                    Le calcul a bien été enregistré-->
        <!--                </button>-->
        <!--                <div class="col-sm-4"></div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    --><?php
    endif;
endif;

?>






<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
<script type="text/javascript">

    window.onload = function(){
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
    };

</script>

<script>
    var myChart1 = new EJSC.Chart( 'myChart' , {
        title: "Sample Line Chart" ,
        axis_bottom: { caption: "Frequency (Hz)" , crosshair: { show: true } } ,
        axis_left: { caption: "Velocity (in/s)" , crosshair: { show: false } } ,
        auto_zoom: 'y' ,
        auto_find_point_by_x: true
    } );
    myChart1.addSeries( new EJSC.LineSeries(
        new EJSC.XMLDataHandler("EJSCharts/examples/includes/data/fullData.xml") , {
            title: "Line 1",
            padding: { x_min: 0, y_min: 1, x_max: 0, y_max: 5 }
        } ) );
    myChart1.show_legend = false;


    var myChart2 = new EJSC.Chart( 'myChart2' , {
        title: "Sample Line Chart" ,
        axis_bottom: { caption: "Frequency (Hz)" , crosshair: { show: true } } ,
        axis_left: { caption: "Velocity (in/s)" , crosshair: { show: false } } ,
        auto_zoom: 'y' ,
        auto_find_point_by_x: true
    } );
    myChart2.addSeries( new EJSC.LineSeries(
        new EJSC.XMLDataHandler("EJSCharts/examples/includes/data/fullDataPie.xml") , {
            title: "Line 2",
            padding: { x_min: 0, y_min: 1, x_max: 0, y_max: 5 }
        } ) );
    myChart2.show_legend = false;


    var myChart3 = new EJSC.Chart( 'myChart3' , {
        title: "Sample Line Chart" ,
        axis_bottom: { caption: "Frequency (Hz)" , crosshair: { show: true } } ,
        axis_left: { caption: "Velocity (in/s)" , crosshair: { show: false } } ,
        auto_zoom: 'y' ,
        auto_find_point_by_x: true
    } );
    myChart3.addSeries( new EJSC.LineSeries(
        new EJSC.XMLDataHandler("EJSCharts/examples/includes/data/shortData.xml") , {
            title: "Line 3",
            padding: { x_min: 0, y_min: 1, x_max: 0, y_max: 5 }
        }
    ) );
    myChart3.show_legend = false;

</script>
<script type="text/javascript" src="script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


</body>
</html>