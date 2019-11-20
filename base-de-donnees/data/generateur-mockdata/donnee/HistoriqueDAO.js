var chainePreparedStatement = require('./chaineHistoriquePreparedStatement');
var fonctionDateModele = require('../fonction/fonctionDateModele');
var bdd = require('./BaseDeDonnees');

const NOM_TABLE = 'historique_donnee_bouee';

exports.enregistrer1SecondeHistorique = function(tableauHistorique) {

    // return new Promise(resolve => {

    console.log('enregistrer()');
    

            var valeurs = [];
            // var colonne = 0;
            var val = [];
            var compteur = 0;

            var dateEnCours = tableauHistorique[0].date;
            // console.log(tableauHistorique.length);


            for (let index = 0; index < tableauHistorique.length; index++) {

                if (Number.isInteger((compteur) / 24000)) {
                    // colonne = Math.floor((compteur + 1) / 24000);
                    // console.log('col :',colonne);
                    val.push(valeurs);
                    valeurs = [];
                }

                valeurs.push(tableauHistorique[index].idHistorique);
                valeurs.push(tableauHistorique[index].idBouee);
                valeurs.push(fonctionDateModele.toString(tableauHistorique[index].date));

                compteur += 3;

            }

            val.push(valeurs);
            valeurs = null;
            // console.log('val :', valeurs);
            // console.log('val :', val[10]);

            // console.log('fin');
            
            this.inserer(val, dateEnCours);
        
        // }
    // );

}


exports.inserer = async function(val, dateEnCours) {

    // return new Promise(resolve => {
        console.log('inserer()');
        
        var chaine;
        for (let colonne = 1; colonne <= 10; colonne++) {

            if (colonne == 10) {
                chaine = chainePreparedStatement.chaine9000Parametres();
            } else {
                chaine = chainePreparedStatement.chaine24000Parametres();
            }

            const INSERT_HISTORIQUE = {
                name: 'enregistrerHistorique',
                text: 'INSERT INTO ' + NOM_TABLE + ' (id_historique_donnee_bouee, id_bouee, date_saisie) VALUES ' + chaine,
                values: val[colonne]
            };

            var baseDeDonnee = bdd.connexion();
            await baseDeDonnee.query(INSERT_HISTORIQUE, (err, res) => {

                // console.log('baseDeDonnee.query');

                if (err) {

                    temps = new Date();
                    valeurInstant = `${
                        temps.getDate().toString().padStart(2, '0')}/${
                        (temps.getMonth() + 1).toString().padStart(2, '0')}/${
                        temps.getFullYear().toString().padStart(4, '0')} ${
                        temps.getHours().toString().padStart(2, '0')}:${
                        temps.getMinutes().toString().padStart(2, '0')}:${
                        temps.getSeconds().toString().padStart(2, '0')}:${
                        temps.getMilliseconds().toString().padStart(2, '0')}`;
                    // console.log(valeurInstant, ' ', bouee.etiquette);
                    console.log(err.stack);

                } else {
                    console.log(dateEnCours, ' colonne ', colonne);
                }

            });

        }

        bdd.deconnexion(baseDeDonnee);
        console.log('Fin inserer()');
        

    // });
    
}