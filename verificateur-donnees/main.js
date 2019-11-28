const bddPostgres = require('./donnee/BaseDeDonneesPostgres');
const fichier = require('./fonction/fonctionFichier');
const fs = require('fs');


(function() {

    fs.readFile('./donnee/donnees.json', 'utf8', async function (err, data) {
        if (err) throw err;
            
        var donnees = JSON.parse(data);


        fs.readFile('./donnee/derniersId.json', 'utf8', async function(err, data){
            if (err) throw err;

            var dernierId = JSON.parse(data);

            // console.log(donnees[('bouee_'+1)]);
            // console.log(dernierId['id_table_paire']);

            var baseDeDonnees = bddPostgres.connexion();

            bddPostgres.selectionnerDonneesSelonParametre('heure_paire', baseDeDonnees, 'date_saisie', (dernierId['id_table_paire'] + 1));

            bddPostgres.deconnexion(baseDeDonnees);

        });

    });

})()