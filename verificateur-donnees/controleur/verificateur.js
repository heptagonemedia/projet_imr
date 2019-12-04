const bddMongo = require('../donnee/BaseDeDonneesMongoDB');
const historique = require('../modele/Historique');

exports.verifier = async function (donnees, derniersId, donneesATester) {

    var idHistorique;
    var idBouee;
    var date;
    var temperature;
    var debit;
    var salinite;
    var debit;
    var longitude;
    var latitude;
    var batterie;
    var valide;

    var nouveauxHistorique = [];

    var resultat = [];


    for (let index = 0; index < donneesATester.length; index++) {

        donnee = donneesATester[index];
        
        idHistorique = parseInt(derniersId['id_historique'], 10);
        idBouee = donnee['id_bouee'];
        temperature = donnee['temperature'];
        debit = donnee['debit'];
        salinite = donnee['salinite'];
        longitude = donnee['longitude'];
        latitude = donnee['latitude'];
        batterie = donnee['batterie'];

        nouveauxHistorique.push(new historique.Historique(idHistorique, idBouee, date, temperature, debit, salinite, longitude, latitude, batterie, valide));
        
    }

    await bddMongo.insererTableau(nouveauxHistorique, 'historique_donnee_bouee');
    
}