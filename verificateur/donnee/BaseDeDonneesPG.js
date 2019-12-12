const { Pool, Client } = require('pg');

const credentials = require('../../../credentials/CredentialsPg');
const fonctionDateModele = require('../fonction/fonctionDateModele');

const datemodele = require('../modele/DateModele');

var variablesConnexion = new credentials.Credentials();

var connexion = {
    user: variablesConnexion.user, password: variablesConnexion.password,
    host: variablesConnexion.host, port: variablesConnexion.port,
    database: variablesConnexion.database
};

exports.recupererDernierId = async function (table) {

    console.log('recupererDernierId()');

    const SELECT_TABLE_PARAMETRE = {
        name: 'selectionnerDonnees',
        text: 'SELECT ' + ('id_' + table) + ' FROM ' + table + ' ORDER BY ' + ('id_' + table) + ' DESC LIMIT 1'
    }

    var baseDeDonnees = await this.connexion();

    var resultat = await baseDeDonnees.query(SELECT_TABLE_PARAMETRE);

    await this.deconnexion(baseDeDonnees);
    // console.log(resultat.rows);

    return resultat.rows[0][('id_'+table)];
    
}

exports.supprimerDonneesTable = function (table, bdd) {

    const DELETE_TABLE = {
        name: 'supprimerDonneesTable',
        text: 'DELETE FROM ' + table + 'WHERE 1=1'
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

exports.connexion = function () {
    return new Pool(connexion);
}

exports.deconnexion = function (bdd) {
    bdd.end();
}