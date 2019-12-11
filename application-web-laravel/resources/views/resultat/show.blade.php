<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('resources\css\EJSChart.css')}}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="{{asset('resources\css\materialize.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('resources\css\proto.css')}}">
    <link rel="stylesheet" href="{{asset('resources\css\headerCss.css')}}">


    <script src="https://kit.fontawesome.com/e14504e0cd.js"></script>
    <script type="text/javascript" src="{{asset('resources\js\EJSChart.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="{{asset('resources\js\materialize.js')}}"></script>


    <title>Resultat du calcul</title>

</head>

<body>

<div id="coordonnees" hidden >
    <?php
    if (isset($coordonnees)){
        foreach ($coordonnees as $coordonnee){
            echo($coordonnee."&");
        }
    }
    ?>
</div>

<header>

    <nav role="navigation" aria-label="header">
        <div class="nav-wrapper black">
            <div class="row">
                <div class="col s1 m1 l4 center-align"><button role="button" data-target="slide-out" onclick="ouvrirSidenav()" class="sidenav-trigger btn black white-text"><i aria-label="{!! __('message.ouvrirMenu') !!}" aria-hidden="true" class="material-icons" id="menu">menu</i></button></div>
                <div class="black col s12 m5 l3 center-align" style="font-size: 18pt"><h1>{!! __('message.resultatCalcul') !!}</h1></div>
                <div class="black col s12 m6 l5 center align ">

                    <a href="accueil.php" class="breadcrumb">{!! __('message.accueilMenu') !!}</a>
                    <a href="formulaireRecherche.php" class="breadcrumb">{!! __('message.formulaire') !!}</a>
                    <a href="#" class="breadcrumb">{!! __('message.calculDeuxPoints') !!}</a>
                </div>
            </div>
        </div>
    </nav>

</header>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
@include('navigation_side_bar')
<main role="main">
    <!-- Ligne de la carte et du premier Graphique -->
    <div  id="col1">
        <div class="row">

            <div class="map col s6 " role="geomap" id="map"></div>

            <div class="stat1 col s6 ">
                <div class="card">

                    <div class="card-image">
                        <div role="linegraph" class="chart" id="myChart" ></div>
                    </div>

                    <div class="card-content">
                        <p>{!! __('message.agrandirCarte') !!}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Ligne du bandeau au milieu de la page -->
    <div class="container-fluid black" id='ligne2' >
        <div class="row ">

            <div class="col s6 colLigne2">
                <a href="#" id="btnCarte" class="lien" onclick="agrandirCarte(document.getElementById('map'))" >{!! __('message.vitesseCourant') !!}</a>
            </div>

            <div class='col s6 colLigne2' >

            </div>

        </div>
    </div>
    <div>
        <div class="row">

            <div class="col s6 chart" >
                <div class="card">

                    <div class="card-image">
                        <div class="chart" role="linegraph" id="myChart2" ></div>
                    </div>

                    <div class="card-content">
                        <p>{!! __('message.salinite') !!}</p>
                    </div>

                </div>
            </div>

            <div class="col s6 chart" >
                <div class="card">

                    <div class="card-image">
                        <div class="chart" role="linegraph" id="myChart3" ></div>
                    </div>

                    <div class="card-content">
                        <p>{!! __('message.temperature') !!}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="fixed-action-btn">

        <a class="btn-floating btn-large red">
            <i aria-hidden="true" class="large material-icons">more_vert</i>
        </a>

        <ul>
            <li><button class="btn-floating purple tooltipped waves-effect waves-orange" data-position="left" data-tooltip="Agrandir la carte"  onfocusin="afficherLiens()" onclick="agrandirCarte(document.getElementById('map'))"><i  aria-label="Bouton agrandir la carte" aria-hidden="true"  class="material-icons">crop_free</i></button></li>
            <li><a class="btn-floating blue tooltipped waves-effect waves-orange" data-position="left" data-tooltip="Nouveau calcul" href="formulaireRecherche.php"><i aria-hidden="true"  aria-label="Faire un nouveau calcul"  class="material-icons" >  add_circle_outline</i></a></li>
            <li><a class="btn-floating pink tooltipped waves-effect waves-orange" data-position="left" data-tooltip="Accueil" href="accueil.php"><i aria-hidden="true"  aria-label="Lien vers l'accueil"  class="material-icons">home</i></a></li>

            @php if(isset($enregistre) && !$enregistre ): @endphp
            <li><a class="btn-floating yellow darken-1 tooltipped waves-effect waves-orange" data-position="left" data-tooltip="Retourner au formulaire" onclick="retourFormulaire()"><i aria-hidden="true"  aria-label="Retour au formulaire"  class="material-icons">arrow_back</i></a></li>
            <li><a class="btn-floating green waves-effect waves-light btn modal-trigger tooltipped waves-effect waves-orange" data-position="left" data-tooltip="Enregistrer le calcul" href="{{action('ResultatController@enregistrerCalcul', $calcul->getId())}}"><i aria-hidden="true"  aria-label="Enregistrer le calcul"  class="material-icons">save</i></a></li>
            @php endif;@endphp
        </ul>

    </div>

</main>


@include('footer')

<div id="texteSucces" hidden>
    {!! __('message.calculBienEnregistre') !!}
</div>
</body>


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

<script type="text/javascript" src="{{asset('resources\js\script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


</html>
