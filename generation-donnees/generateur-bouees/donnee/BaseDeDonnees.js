var classBouee = require('../model/Bouee.js');

const {Pool, Client} = require('pg');

var connexion = {
    user: 'generation_scenario', password: 'scenario',
    host: 'localhodt', port: 5432,
    database: 'generation_donnees'
}


exports.enregistrerBouee = async function (bouee) {

    console.log('Enregistrer Bouée');

    var baseDeDonnees = new Pool(connexion);
    console.log('Connexion ouverte');

    const requete_sql = {
        name: 'enregistrerDonnee',
        text: 'INSERT INTO bouee (etiquette, valeur_depart_longitude, valeur_depart_latitude, valeur_depart_batterie) VALUES ($1, $2, $3, $4)',
        values: [bouee.etiquette, bouee.longitude, bouee.latitude, bouee.batterie]
    }

    console.log(requete_sql);

    // callback
    baseDeDonnees.query(requete_sql, (err, res) => {
        if (err) {
            console.log(err.stack);
        } else {
            console.log(res.rows[0]);
        }
    })

    
    baseDeDonnees.end();
    console.log('Connexion fermée');

    console.log('Fin enregistrerBoeue');
}