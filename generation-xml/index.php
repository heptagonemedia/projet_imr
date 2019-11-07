<?php

require_once("BaseDeDonnees.php");

$connection = new BaseDeDonnees();
//Connection à la BDD
$connection->connection();

//Récupération du lien
$c = $connection->getLien();

//Requete et stockage
$result = pg_query($c,"SELECT * FROM account");
$row = pg_fetch_row($result);

// TESTS
// echo $row[0];
// echo '<pre>';
// print_r($row);
// echo '</pre>';


//Creation du DOMDocument
$doc = new DOMDocument();

$racine = $doc->createElement('G');
$noeudL = $doc->createElement('L');
$noeudP = $doc->createElement('P');

$elementAttribute1 = $doc->createAttribute('x');
$elementAttribute1->value = $row[1];
$elementAttribute2 = $doc->createAttribute('y');
$elementAttribute2->value = $row[2];

$noeudP->appendChild($elementAttribute1);
$noeudP->appendChild($elementAttribute2);

$noeudL->appendChild($noeudP);
$racine->appendChild($noeudL);

$doc->appendChild($racine);


$doc->save('test4.xml');

$connection->deconnection();

?>