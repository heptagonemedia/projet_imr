const { Pool, Client } = require('pg');
// var connexion = {
//     user: 'heptagonemedia', password: 'Motivation*',
//     host: 'vpsloic.loicbertrand.net', port: 2232,
//     database: 'imr'
// };

var historiqueDAO = require('./HistoriqueDAO');

var connexion = {
    user: 'postgres', password: 'Cvgcqy891',
    host: 'localhost', port: 5432,
    database: 'test_select'
};

const pool = new Pool(connexion);

exports.insererHistorique = async function (query) {

    const client = await pool.connect();
    await client.query(query);
    client.release();
    // console.log('insertion : ', query.name);
    
}
