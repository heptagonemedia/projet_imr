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


const MongoClient = require('mongodb').MongoClient;
const assert = require('assert');

// Connection URL
// const url = 'mongodb://localhost:27017';
const url = 'mongodb://admin:password@localhost:27017?authMechanism=DEFAULT&authSource=admin&ssl=false"';

// Database Name
const dbName = 'imr';

// Create a new MongoClient
const client = new MongoClient(url);

// Use connect method to connect to the Server


// exports.inserer = async function(tableauValeur) {

//     await client.connect(async function (err, client) {

//         assert.equal(null, err);
//         console.log("Connected correctly to server");

//         await test(tableauValeur);

//     });

// }

// test = async function (tableauValeur) {

//     const db = client.db(dbName);

//     // Insert multiple documents
//     await db.collection('historique_donnee_bouee').insertMany(tableauValeur, async function (err, r) {
//         assert.equal(null, err);
//         assert.equal(75000, r.insertedCount);
//         await client.close();
//         // console.log();
//     });

// }

exports.inserer2 = async function(tableauValeur) {

    const c = await client.connect();

    const db = c.db(dbName);
    await db.collection('historique_donnee_bouee').insertMany(tableauValeur);

    // c.close();

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> OK');
    

}