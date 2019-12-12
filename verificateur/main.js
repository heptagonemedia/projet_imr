const bddPostgres = require('./donnee/BaseDeDonneesPG');

(async function() {

    var nomTable;

    var dateMaintenant = new Date();
    if (dateMaintenant.getHours()%2 == 0) {
        nomTable = 'heure_paire';
    } else {
        nomTable = 'heureImpaire';
    }

    var dernierIdTablePg = await bddPostgres.recupererDernierId(nomTable);

    console.log(dernierIdTablePg);
    

})()