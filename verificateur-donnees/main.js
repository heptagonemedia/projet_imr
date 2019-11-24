const bddPostgres = require('./donnee/BaseDeDonneesPostgres');

var baseDeDonnees = bddPostgres.connexion();
console.log('Connexion ouverte');


bddPostgres.selectionnerDonnees('test_select_table', baseDeDonnees);

bddPostgres.deconnexion(baseDeDonnees);
console.log('Connexion fermée');
