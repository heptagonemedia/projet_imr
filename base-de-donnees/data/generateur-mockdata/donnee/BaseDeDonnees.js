const { Pool, Client } = require('pg');
// var connexion = {
//     user: 'heptagonemedia', password: 'Motivation*',
//     host: 'vpsloic.loicbertrand.net', port: 2232,
//     database: 'imr'
// };

var connexion = {
    user: 'postgres', password: 'Cvgcqy891',
    host: 'localhost', port: 5432,
    database: 'test_select'
};

exports.connexion = function() {
    return new Client(connexion);
}

exports.deconnexion = function(bdd) {
    bdd.end();
}
