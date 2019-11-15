<?php

//système de traduction
include("lang/anglais.php");
include("lang/francais.php");

$langue = array();
$langageChoisi = 'anglais'; //TODO permettre la modification de cette valeur via un menu de choix de la langue (utiliser des cookies).

if ($langageChoisi == 'francais'){
    $langue = array_merge($francais);
} else if ($langageChoisi == 'anglais'){
    $langue = array_merge($anglais);
}

if(!isset($_GET['page'])){
    include("accueil.php") ;
}else {
    include("".$_GET['page'].".php");
}


?>
