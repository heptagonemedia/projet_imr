var fonctionDateModele = require('./fonctionDateModele');
var historique = require('../modele/Historique');

var fs = require('fs');

exports.genererXSecondes = function (dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetition) {

    var idHistorique = dernierHistorique.idHistorique;
    var dateEnCours = dernierHistorique.date;

    var contenu = "";

    for (let numeroSeconde = 0; numeroSeconde < nombreDeSecondeParRepetition; numeroSeconde++) {
        contenu = "";

        for (let idBouee = 1; idBouee <= nombreDeBouee; idBouee++) {
            idHistorique++;
            d = fonctionDateModele.toString(dateEnCours);
            contenu += "" + idHistorique + "," + idBouee + "," + d + "\n";
        }

        dateEnCours = fonctionDateModele.augmenterDateModele1Seconde(dateEnCours);
        
    }

    dernierHistorique.idHistorique = idHistorique;
    dernierHistorique.date = dateEnCours;

    return dernierHistorique;

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
