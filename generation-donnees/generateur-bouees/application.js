var bdd = require('./donnee/BaseDeDonnees');
var bouee = require('./model/Bouee');
var fonction = require('./fonction');

var nombreBouee = process.argv[2];

var debut = new Date();

for (let index = 0; index < nombreBouee; index++) {
     
    bdd.enregistrerBouee(new bouee.Bouee(fonction.genererEtiquette(index),
                                         fonction.genererLongitude(),
                                         fonction.genererLatitude(),
                                         fonction.genererBatterie()));

    console.log('Bouee');
    
    
}