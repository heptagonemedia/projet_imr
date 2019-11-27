const { Pool, Client } = require('pg');

credentials = require('../../../credentials/CredentialsPg');
verificateur = require('../verificateur');

var variablesConnexion = new credentials.Credentials();

var connexion = {
    user: variablesConnexion.user, password: variablesConnexion.password,
    host: variablesConnexion.host, port: variablesConnexion.port,
    database: variablesConnexion.database
};

// exports.enregistrerDonnee = async function (bouees, bdd) {}

exports.selectionnerDonnees = function(table, bdd) {
    console.log('selectionnerDonnees');
    
    const SELECT_TOUTE_LA_TABLE = {
        name: 'selectionnerDonnees',
        text: 'SELECT * FROM '+ table
    }
    // callback
    bdd.query(SELECT_TOUTE_LA_TABLE, (err, res) => {
        if (err) {
            console.log('Erreur Select', err);
        } else {
            // console.log(res.rows);
            verificateur.lancerVerification(res.rows);
        }
    })


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
