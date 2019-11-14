// var region = require('./model/Region');
var fonctionRegion = require('./fonction/fonctionRegion');
var fonctionBouee = require('./fonction/fonctionBouee');
var fonctionTypeDonneeMesuree = require('./fonction/fonctionTypeDonneeMesuree');
var fonctionTypeCalcul = require('./fonction/fonctionTypeCalcul');

var fonctionGenerique = require('./fonction/fonctionGenerique');

var fs = require('fs');


var cheminMockdata = "../mockdata/";

var nombreDeRegion = 8;
var nombreDeBouee = 75000
var nombreDeDonneeMesuree = 6;
var nombreDeCalcul = 3;

var contenu = "";
//######################################### Génération des Régions

// for (let index = 1; index <= nombreDeRegion; index++) {
//     contenu += "" + index + "," + fonctionRegion.genererEtiquette(index) + "\n";
// }

// fs.appendFile((''+cheminMockdata+'region.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('region.csv générer');
// });

// contenu = "";
//######################################### Génération des Bouées
// for (let index = 1; index <= nombreDeBouee; index++) {
//     region = fonctionGenerique.nombreEntierAleatoire(1,8);
//     contenu += "" + index + "," + fonctionBouee.genererEtiquette(index) + "," + fonctionBouee.genererLongitude(region) + "," +
//                 fonctionBouee.genererLatitude(region) + "," + region + "\n";
// }

// fs.appendFile((''+cheminMockdata+'bouee.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('bouee.csv générer');
// });

// contenu = "";
// //######################################### Génération des Types de données mesurées
// for (let index = 1; index <= nombreDeDonneeMesuree; index++) {
//     contenu += "" + index + "," + fonctionTypeDonneeMesuree.genererEtiquette(index) + "," +
//         fonctionTypeDonneeMesuree.genererUnite(index) + "\n";
// }

// fs.appendFile(('' + cheminMockdata + 'type_donnee_mesuree.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('type_donnee_mesuree.csv générer');
// });

contenu = "";
//######################################### Génération des Types de calcul
for (let index = 1; index <= nombreDeCalcul; index++) {
    contenu += "" + index + "," + fonctionTypeCalcul.genererEtiquette(index) + "\n";
}

fs.appendFile(('' + cheminMockdata + 'type_calcul_test.csv'), contenu, (err) => {
    if (err) throw err;
    console.log('type_calcul.csv générer');
});