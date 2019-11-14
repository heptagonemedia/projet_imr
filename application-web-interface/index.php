<?php

if(!isset($_GET['page'])){
    include("accueil.php") ;
}else {
    include("".$_GET['page'].".php");
}


?>
