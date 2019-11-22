var bdd = require('./BaseDeDonnees');
var historique = require('../modele/Historique');
var fonctionDateModele = require('../fonction/fonctionDateModele');
var fonctionHistorique = require('../fonction/fonctionHistorique');

exports.genererEtInsererHistoriques = async function (idHistorique, dateEnCours, nombreDeBouee, idBouee, tableauHistorique, clef, collectionBouee, collectionHistorique, callback, dateFinHistorique) {

    if (fonctionDateModele.dateModeleEgales(dateEnCours, dateFinHistorique)) {
        return;
    }

    var client = bdd.client();

    const c = await client.connect();

    const db = c.db(bdd.dbName());

    if (idBouee <= nombreDeBouee) {

        const document = JSON.parse('{"' + clef + '":' + idBouee + '}');

        var resultat = await db.collection(collectionBouee).findOne(document);
        // console.log(idBouee, 'bdd :', resultat.id_region);
        idRegion = resultat.id_region;
        idHistorique++;

        tableauHistorique.push(new historique.Historique(
            idHistorique, 
            idBouee, 
            fonctionDateModele.toString(dateEnCours), 
            fonctionHistorique.genererTemperature(), 
            fonctionHistorique.genererDebit(), 
            fonctionHistorique.genererSalinite(idRegion), 
            fonctionHistorique.genererLongitude(idRegion), 
            fonctionHistorique.genererLatitude(idRegion), 
            fonctionHistorique.genererBatterie(),
            fonctionHistorique.genererValide()
        ));

        idBouee++;
        await callback(idHistorique, dateEnCours, nombreDeBouee, idBouee, tableauHistorique, clef, collectionBouee, collectionHistorique, callback, dateFinHistorique);

    } else {

        dateEnCours = fonctionDateModele.augmenterDateModeleXSeconde(dateEnCours, 60);
        await bdd.insererTableau(tableauHistorique, collectionHistorique);
        tableauHistorique = [];
        await callback(idHistorique, dateEnCours, nombreDeBouee, 1, tableauHistorique, clef, collectionBouee, collectionHistorique, callback, dateFinHistorique);

    }

}