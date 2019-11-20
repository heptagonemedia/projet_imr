var chainePreparedStatement = require('./chaineHistoriquePreparedStatement');
var fonctionDateModele = require('../fonction/fonctionDateModele');
var bdd = require('./BaseDeDonnees');

const NOM_TABLE = 'historique_donnee_bouee';

exports.preparerEnregistrementHistorique = async function(tableauHistorique, idPreparedStatement) {

    // console.log('enregistrer()');
    
    var idStatement = idPreparedStatement;
    var valeurs = [];
    // var colonne = 0;
    var val = [];
    var compteur = 0;

    var insertion;
    var chaine;

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

    
    for (let colonne = 1; colonne <= 10; colonne++) {
        idStatement++;
        if (colonne == 10) {
            chaine = chainePreparedStatement.chaine9000Parametres();
        } else {
            chaine = chainePreparedStatement.chaine24000Parametres();
        }

        insertion = {
            name: 'enregistrerHistorique_' + idStatement,
            text: 'INSERT INTO ' + NOM_TABLE + ' (id_historique_donnee_bouee, id_bouee, date_saisie) VALUES ' + chaine,
            values: val[colonne]
        };

        await bdd.insererHistorique(insertion);

        insertion = null;

    }

}

