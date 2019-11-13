bdd = require('./donnee/BaseDeDonnees');

var baseDeDonnees = bdd.connexion();
console.log('Connexion ouverte');


bdd.selectionnerDonnees('test_select_table', baseDeDonnees);

bdd.deconnexion(baseDeDonnees);
console.log('Connexion fermée');
