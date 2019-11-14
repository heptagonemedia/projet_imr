// var region = require('./model/Region');
var fonctionRegion = require('./fonction/fonctionRegion');
var fonctionBouee = require('./fonction/fonctionBouee');
var fonctionGenerique = require('./fonction/fonctionGenerique');

var fs = require('fs');


var cheminMockdata = "../mockdata/";

var nombreDeRegion = 8;
var nombreDeBouee = 75000

var contenu = "";
//######################################### Génération des Régions

// for (let index = 1; index <= nombreDeRegion; index++) {
//     contenu += "" + index + "," + fonctionRegion.genererEtiquette(index) + "\n";
// }

// fs.appendFile((''+cheminMockdata+'region.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('region.csv générer');
// });

contenu = "";
//######################################### Génération des Bouées
for (let index = 1; index <= nombreDeBouee; index++) {
    region = fonctionGenerique.nombreEntierAleatoire(1,8);
    contenu += "" + index + "," + fonctionBouee.genererEtiquette(index) + "," + fonctionBouee.genererLongitude(region) + "," +
                fonctionBouee.genererLatitude(region) + "," + region + "\n";
}

fs.appendFile((''+cheminMockdata+'bouee_test.csv'), contenu, (err) => {
    if (err) throw err;
    console.log('bouee_test.csv générer');
});