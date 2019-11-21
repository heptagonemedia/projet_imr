<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
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
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
		<link rel="stylesheet" href="css/materialize.css">

	<title><?=$langue['titleAccueil']?></title>

	</head>

	<body>

		<?php
			include('navigation_side_bar.php')
		?>

		<!-- mock pour bouées valides, non valides -->
		<?php
			$compteurFonctionelles = 0;
			$compteurProbleme = 0;
			$classe='';
			$texte='';
			
			for ($i=0; $i < 75; $i++){
				if (rand(0,10)%2==0) {

					$compteurFonctionelles++;
					$classe='success';
					$texte=$langue['texteBoueeFonctionnelle'];//'Fonctionnelle';

				}else {
					$compteurProbleme++;
					$classe='danger';
					$texte=$langue['texteBoueeProbleme'];//'Problème';
				}
			} 
		?>
        <?php
        	include('header.php');
        ?>
			<div class="container">
				<div class=" col l10">
					<p><?=$langue['derniereMiseAjour']?>DATE et HEURE</p>
				</div>
			</div>

		<main>	

			<div class="row">

				<div class="col l8">

					<div class="card">
						<div >
							<div class="" id="map" ></div>
						</div>

						<div class="card-content">
						
							<div class="row">
								<div class="col s6 center-align"><?=$langue['titreCarte']?></div>
									<div class="col s6 center-align">
										<button class="btn green" onclick="agrandirCarte(document.getElementById('map'))"><?=$langue['boutonPleinEcran']?></button>
									</div>
								</div>
							</div>

						</div>

					</div>
					<div class="col l4 s12 m6" >

						<div class="card white">

							<div class="card-content white-text">
								<span class="card-title black-text center-align"><?=$langue['boueesNonConformes']?></span>
                                    <canvas id="camembertBouees"></canvas>
							</div>
						</div>
					</div>
			</div>


		</main>

		<?php
            include('footer.php');
        ?>

	</body>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
			integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
			crossorigin="anonymous">
	</script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="js/materialize.js"></script>
	<script src="js/script.js"></script>
	<script src="js/map.js"></script>

	<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

</html>