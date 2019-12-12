const { Pool, Client } = require('pg');

const credentials = require('../../../credentials/CredentialsPg');
const fonctionDateModele = require('../fonction/fonctionDateModele');

const dateModele = require('../modele/DateModele');

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

exports.supprimerDonneesTableAvantId = async function (table, id) {

    const DELETE_TABLE = {
        name: 'supprimerDonneesTable',
        text: 'DELETE FROM ' + table + 'WHERE ' + ('id_' + table) + '<' + id
    }
    
    var baseDeDonnees = await this.connexion();

    await baseDeDonnees.query(DELETE_TABLE);

    await this.deconnexion(baseDeDonnees);

}

exports.connexion = function () {
    return new Pool(connexion);
}

exports.deconnexion = function (bdd) {
    bdd.end();
}