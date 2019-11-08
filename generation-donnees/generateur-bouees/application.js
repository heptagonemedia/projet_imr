var bdd = require('./donnee/BaseDeDonnees');
var bouee = require('./model/Bouee');
var fonction = require('./fonction');

var nombreBouee = process.argv[2];
// var nombreBouee = 20;

var debut = new Date();

var compteur = 0;

for (let index = 0; index < nombreBouee; index++) {

    var array = [];

    for (let index2 = 0; index2 < 1500; index2++) {
        array.push(fonction.genererBouee(compteur));
        compteur++;
    }

    var baseDeDonnes = bdd.connexion();
    
    bdd.enregistrerDonnee(array, baseDeDonnes);

    var temps = new Date();

    valeurInstant = `${
        (temps.getMonth() + 1).toString().padStart(2, '0')}/${
        temps.getDate().toString().padStart(2, '0')}/${
        temps.getFullYear().toString().padStart(4, '0')} ${
        temps.getHours().toString().padStart(2, '0')}:${
        temps.getMinutes().toString().padStart(2, '0')}:${
        temps.getSeconds().toString().padStart(2, '0')}`;

    // console.log('[', valeurInstant, ']', ' Bouee ', index);
    
    bdd.deconnexion(baseDeDonnes);
}

var fin = new Date();

console.log('Temps de génération des valeurs : ', Math.floor((fin - debut) / 1000), ' seconds');
