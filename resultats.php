<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="EJSCharts/EJSChart.css">
    <script src="https://kit.fontawesome.com/e14504e0cd.js"></script>

    <script type="text/javascript" src="EJSCharts/EJSChart.js"></script>
	<link rel="stylesheet" type="text/css" href="proto.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />

	<title>Resultats</title>
</head>
<body>

    <!-- Ligne en haut de la page -->
    <div class="container-fluid" style=" background-color: #1e2229; font-size: 18pt;color: white">
        <div class="row align-items-start">
            <div class="col col-lg-8">IMR</div>
            <div class="col"><a href="index.php"><i id="home" class="fas fa-home" style="width: 50px;"></i></a></div>
            <div class="col">bouée n°1</div>
        </div>
    </div>
    
    <!-- Ligne de la carte et du premier Graphique -->
	<div class="container-fluid" id="col1">
		<div class="row">
			<div class="map col-sm" id="map" style="padding: 0%">
				<img src="blanc.png" style="height: 150%;">
            </div>
            <div style="padding: 0%; width:2%"></div>
            <div class="stat1 col-sm" id="myChart" style="padding: 0%"></div>
            <div style="padding: 0%; width:0.5%"></div>
		</div>
    </div>
    
    <!-- Ligne du bandeau au milieu de la page -->
	<div class="container-fluid" id='bar1' style="background-color: #1e2229;" >
        <div class="row row align-items-start">
            <div class="col-sm" style="text-align: center;">
                Carte
            </div>
            <div class='col-sm' style="text-align: center;">
                <a href="" style="color: white;">Consulter les données brutes</a>  <!-- TODO Changer le style -->
            </div>
        </div>
    </div>
    
    <!-- Ligne du bas avec les 2 derniers Graphiques -->
	<div class="container-fluid">
		<div class="row">
            <div class="row-sm"  style="width: 0%;padding :0%; margin:0%; display: hidden"><img src="blanc.png"></div>
            <div class="col-sm" id="myChart2" style="padding: 0%"></div>
            <div style="padding: 0%; width:2%"></div>
            <div class="col-sm" id="myChart3" style="padding: 0%"></div>
            <div style="padding: 0%; width:0.5%"></div>
		</div>
    </div>

    <?php

        if(isset($_GET["type"])):
            $type = $_GET["type"];
            if($type == "prev"):
    ?>
    <form action = "resultats.php" method="get">
    <div class="container-fluid" style = "margin-top : 2%">
        <div class="row">
            <div class="col-sm">
                <button href="formulaireRecherche.php"  type="button" class="btn btn-warning" onclick = 'retourFormulaire();'><i class="fas fa-arrow-left"></i> Retour au calcul</button>
            </div>
            <div class="col-sm">
            <input type="hidden" id="type" value="enr" name="type">
                <input id="type" value = "Enregistrer" type="submit" class="btn btn-success">
            </div>
        </div>
    </div>
    </form>
    


    <?php
            elseif($type == "enr"):
    ?>
    <div id='message' class="container-fluid">
        <div class = "row">
            <div class="col-sm-4"></div>
            <div class="col-sm alert alert-success" role="alert">
                Le calcul a bien été enregistré <button style="margin-left:20px;" type="button" class="btn btn-danger"onclick='fermer()'>+</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <?php
            endif;
        endif;

    ?>

<pre>
<?php print_r($_GET); ?>
</pre>

<script>

    function fermer(){
        $('#message').remove();
    }

    function retourFormulaire(){
        var url = document.location.href;
        window.location.href = "formulaireRecherche.php"+ url.substr(url.indexOf('?'));
    }

</script>
    


    
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script type="text/javascript">
    
            // On initialise la latitude et la longitude de Paris (centre de la carte)
            var lat = 48.852969;
            var lon = -67.533555;
            var macarte = null;

            // Fonction d'initialisation de la carte
            function initMap() {

                // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 11);

                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {

                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                    
                }).addTo(macarte);

            }

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

    </script>

</body>
</html>