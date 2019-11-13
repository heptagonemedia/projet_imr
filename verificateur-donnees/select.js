bdd = require('./donnee/BaseDeDonnees');

var baseDeDonnees = bdd.connexion();


bdd.selectionnerDonnees('test_select_table', baseDeDonnees);



bdd.deconnexion(baseDeDonnees);