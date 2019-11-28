const bddPostgres = require('./donnee/BaseDeDonneesPostgres');

var baseDeDonnees = bddPostgres.connexion();
console.log('Connexion ouverte');


bddPostgres.selectionnerDonneesSelonParametre('historique_donnee_bouee', baseDeDonnees, 'date_saisie', '2018-01-01 00:10:10');

bddPostgres.deconnexion(baseDeDonnees);
console.log('Connexion fermée');
