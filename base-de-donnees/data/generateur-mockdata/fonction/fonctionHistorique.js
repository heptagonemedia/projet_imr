var fonctionDateModele = require('./fonctionDateModele');
var historique = require('../modele/HistoriqueTransition');

var fs = require('fs');

exports.genererXSecondes = async function (dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetition, cheminFichier) {

    var idHistorique = dernierHistorique.idHistorique;
    var dateEnCours = dernierHistorique.date;

    var contenu = "";

    for (let numeroSeconde = 0; numeroSeconde < nombreDeSecondeParRepetition; numeroSeconde++) {
        contenu = "";

        for (let idBouee = 1; idBouee <= nombreDeBouee; idBouee++) {
            idHistorique++;
            d = await fonctionDateModele.toString(dateEnCours);
            contenu += "" + idHistorique + "," + idBouee + "," + d + "\n";
        }

        dateEnCours = await fonctionDateModele.augmenterDateModele1Seconde(dateEnCours);
        await fs.appendFile(cheminFichier, contenu, (err) => {
            if (err) throw err;
            console.log('historique_donnee_bouees.csv générer');
        });
    }

    

    return new historique.HistoriqueTransition(idHistorique, dateEnCours);

}


exports.calculerNombreDeRepetition = function(dateDebut, dateFin, valeur) {
    
    var nbSecondeDateDebut = fonctionDateModele.convertirEnSeconde(dateDebut)
    var nbSecondeDateFin = fonctionDateModele.convertirEnSeconde(dateFin);

    var nombreDeRepetition = Math.floor((nbSecondeDateFin - nbSecondeDateDebut)/valeur);

    if (nombreDeRepetition%2 == 1) {
        
        nombreDeRepetition++;
    }

    return nombreDeRepetition;

}
