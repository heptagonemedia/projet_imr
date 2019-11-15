var fonctionDateModele = require('./fonctionDateModele');
var historique = require('../modele/HistoriqueTransition');

var fs = require('fs');

exports.genererXSecondes = function (dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetition, cheminFichier) {

    var idHistorique = dernierHistorique.idHistorique;
    var dateEnCours = dernierHistorique.date;

    var contenu = "";

    for (let numeroSeconde = 1; numeroSeconde <= nombreDeSecondeParRepetition; numeroSeconde++) {
        
        dateEnCours = fonctionDateModele.augmenterDateModele1Seconde(dateEnCours);
        // contenu = "";

        for (let idBouee = 1; idBouee <= nombreDeBouee; idBouee++) {
            idHistorique++;
            contenu += "" + idHistorique + "," + idBouee + "," + fonctionDateModele.toString(dateEnCours) + "\n";
        }
        
    }

    fs.appendFile(cheminFichier, contenu, (err) => {
        if (err) throw err;
        console.log('historique_donnee_bouees.csv générer');
    });

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
