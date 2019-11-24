const MongoClient = require('mongodb').MongoClient;
// const assert = require('assert');

// Connection URL
// const url = 'mongodb://localhost:27017';
// const url = 'mongodb://admin:password@localhost:27017?authMechanism=DEFAULT&authSource=admin&ssl=false"';

exports.url = function () {
    return 'mongodb://admin:password@homebert.fr:27017?authMechanism=DEFAULT&authSource=admin&ssl=false"';
}

// Database Name
// const dbName = 'imr';

exports.dbName = function() {
    return 'imr';
}

// Create a new MongoClient
// const client = new MongoClient(url);

exports.client = function() {
    return new MongoClient(this.url());
}

exports.insererTableau = async function(tableauValeur, collection) {

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());
    await db.collection(collection).insertMany(tableauValeur);

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Inserer dans la base de données');

    // client.close();
    
}

exports.selectionnerDocument = async function(clef, valeur, collection) {

    var client = this.client();
    const document = JSON.parse('{"'+clef+'":'+valeur+'}');

    const c = await client.connect();

    const db = c.db(this.dbName());
    var resultat = await db.collection(collection).findOne(document).toArray();
    // console.log('bdd :', resultat);
    
    return resultat;

}

exports.selectionnerDocumentsCollection = async function(collection) {

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());
    var resultat = await db.collection(collection).find({}).toArray();

    return resultat;

}



// ####################################################################### Ancienne version


// const { Pool, Client } = require('pg');
// // var connexion = {
// //     user: 'heptagonemedia', password: 'Motivation*',
// //     host: 'vpsloic.loicbertrand.net', port: 2232,
// //     database: 'imr'
// // };

// var historiqueDAO = require('./HistoriqueDAO');

// var connexion = {
//     user: 'postgres', password: 'Cvgcqy891',
//     host: 'localhost', port: 5432,
//     database: 'test_select'
// };

// const pool = new Pool(connexion);



// exports.insererHistorique = async function (query) {

//     const client = await pool.connect();
//     await client.query(query);
//     client.release();
//     // console.log('insertion : ', query.name);

// }