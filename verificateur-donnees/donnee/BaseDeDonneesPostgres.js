const { Pool, Client } = require('pg');
const fs = require('fs');

const credentials = require('../../../credentials/CredentialsPg');
const fonctionDateModele = require('../fonction/fonctionDateModele');
const verificateur = require('../controleur/verificateur');

var variablesConnexion = new credentials.Credentials();

var connexion = {
    user: variablesConnexion.user, password: variablesConnexion.password,
    host: variablesConnexion.host, port: variablesConnexion.port,
    database: variablesConnexion.database
};

// exports.enregistrerDonnee = async function (bouees, bdd) {}

// ###### Fonction pour le test
// exports.selectionnerDonnees = function(table, bdd) {
//     console.log('selectionnerDonnees');
    
//     const SELECT_TOUTE_LA_TABLE = {
//         name: 'selectionnerDonnees',
//         text: 'SELECT * FROM ' + table
//     }
//     // callback
//     bdd.query(SELECT_TOUTE_LA_TABLE, (err, res) => {
//         if (err) {
//             console.log('Erreur Select', err);
//         } else {
//             // console.log(res.rows[0]['date_saisie']);
//             // verificateur.lancerVerification(res.rows);
//         }
//     })


// }

exports.selectionnerDonneesId = async function (table, bdd, donnees, derniersId, callback) {
    
    var id = 'id_' + table;
    console.log((derniersId[id]+1));
    

    const SELECT_TABLE_PARAMETRE = {
        name: 'selectionnerDonnees',
        text: 'SELECT * FROM ' + table + ' WHERE ' + id + '= '+ (derniersId[id] + 1)
    }
    
    await bdd.query(SELECT_TABLE_PARAMETRE, async function(err, res) {
       
        if (err) throw err;
        // console.log(''+res.rows[0]['date_saisie']);

        // console.log(fonctionDateModele.convertirChaine('' + res.rows[0]['date_saisie']));
        
        var date = res.rows[0]['date_saisie'];
        date = fonctionDateModele.convertirChaine(date);
        
        var dateFin = fonctionDateModele.augmenterDateModeleXSeconde(date, 3600);

        await callback(donnees, derniersId, bdd, table, id, date, dateFin, callback);

    });

}

exports.selectionner = async function (donnees, derniersId, bdd, table, idTable, date, dateFin, callback) {

    if (fonctionDateModele.dateModeleEgales(date, dateFin)) {
        
        const SELECT_TABLE_PARAMETRE = {
            name: 'selectionnerDonnees',
            text: 'SELECT * FROM ' + table + ' WHERE date_saisie = ' + date
        }

        await bdd.query(SELECT_TABLE_PARAMETRE, async function (err, res) {

            if (err) throw err;

            var resultat = res.rows;
            var valeursAModifiees;

            for (let index = 0; index < resultat.length; index++) {

                valeursAModifiees = await verificateur.verifier(donnees, derniersId, resultat[index], table);

                donnees[index] = valeursAModifiees[0];
                derniersId['id_historique'] = valeursAModifiees[1];
                derniersId[idTable] = valeursAModifiees[2];
                
            }

            await callback(donnees, derniersId, bdd, table, idTable, date, dateFin, callback);

        });

    } else {
        try {
            if (fs.existsSync('./donnees.json')) {
                //file exists
                // delete file named 'sample.txt'
                fs.unlink('./donnees.json', function (err) {
                    if (err) throw err;
                    // if no error, file has been deleted successfully
                    console.log('File deleted!');

                    fs.appendFile('donnees.json', donnees, (err) => {
                        if (err) throw err;
                        console.log('Appended to file!');

                        try {
                            if (fs.existsSync('./derniersId.json')) {
                                //file exists
                                // delete file named 'sample.txt'
                                fs.unlink('./derniersId.json', function (err) {
                                    if (err) throw err;
                                    // if no error, file has been deleted successfully
                                    console.log('File deleted!');

                                    fs.appendFile('derniersId.json', derniersId, (err) => {
                                        if (err) throw err;
                                        console.log('Appended to file!');
                                    });

                                });
                            } else {
                                console.log('Fichier n\'existe pas ');

                            }
                        } catch (err) {
                            console.error(err)
                        }



                    });

                });
            } else {
                console.log('Fichier n\'existe pas ');

            }
        } catch (err) {
            console.error(err)
        }


        return; 
    }

}

exports.supprimerDonneesTable = function(table, bdd) {
    
    const DELETE_TABLE = {
        name: 'supprimerDonneesTable',
        text: 'DELETE FROM '+ table + 'WHERE 1=1'
    }
    // callback
    bdd.query(DELETE_TABLE, (err, res) => {
        if (err) {
            console.log('Erreur suppr', err);

        } else {
            console.log(res);
            
        }
    })

}

exports.connexion = function() {
    return new Pool(connexion);
}

exports.deconnexion = function(bdd) {
    bdd.end();
}
