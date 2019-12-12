const bddPostgres = require('./donnee/BaseDeDonneesPG');
const bddMongo = require('./donnee/BaseDeDonneeMongo');


(async function() {

    var nomTable = 'heure_paire';

    // var dateMaintenant = new Date();
    // if (dateMaintenant.getHours()%2 == 0) {
    //     nomTable = 'heure_paire';
    // } else {
    //     nomTable = 'heureImpaire';
    // }

    // var dernierIdTablePg = await bddPostgres.recupererDernierId(nomTable);
    // console.log(dernierIdTablePg);

    // var dernierIdHistorique = await bddMongo.recupererDernierIdHistorique();
    // console.log(dernierIdHistorique);

    var t = await bddMongo.t();
    console.log(t);

    // bddMongo.insererTableauElement(t,'donnee_validite_historique');
    
    

})()