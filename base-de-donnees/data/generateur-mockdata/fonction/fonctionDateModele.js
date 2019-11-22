var fonctionGenerique = require('./fonctionGenerique');

exports.dateModeleEgales = function(date1, date2) {

    return ((date1.seconde == date2.seconde) &&
        (date1.minute == date2.minute) &&
        (date1.heure == date2.heure) &&
        (date1.jour == date2.jour) &&
        (date1.mois == date2.mois) &&
        (date1.annee == date2.annee));

}

exports.augmenterDateModeleXSeconde = function(date, ajout) {

    var dateSuivante = date;

    dateSuivante.seconde += ajout;

    if (dateSuivante.seconde > 59) {
        
        dateSuivante.seconde = dateSuivante.seconde - 60;
        dateSuivante.minute++;

        if (dateSuivante.minute > 59) {
            
            dateSuivante.minute = 0;
            dateSuivante.heure++;

            if (dateSuivante.heure > 23) {
                
                dateSuivante.heure = 0;
                dateSuivante.jour++;

                if (
                    ((dateSuivante.mois == 2) && (dateSuivante.jour > 28) && !fonctionGenerique.estBisextile(dateSuivante.annee))
                    || ((dateSuivante.mois == 2) && (dateSuivante.jour > 29) && fonctionGenerique.estBisextile(dateSuivante.annee))
                    || (dateSuivante.jour > 30) && (((dateSuivante.mois < 8) && (dateSuivante.mois != 2) && (dateSuivante.mois % 2 == 0)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 1)))
                    || (dateSuivante.jour > 31) && (((dateSuivante.mois < 8) && (dateSuivante.mois % 2 == 1)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 0)))
                ) {

                    dateSuivante.jour = 1;
                    dateSuivante.mois++;

                    if (dateSuivante.mois > 12) {
                        
                        dateSuivante.mois = 1;
                        dateSuivante.annee++;

                    }
                    
                }

            }

        }

    }

    return dateSuivante;

}

exports.toString = function(date) {
    return (
        "" + date.annee + "-" + 
        fonctionGenerique.formatterElementDate(date.mois) + "-" +
        fonctionGenerique.formatterElementDate(date.jour) + " " +
        fonctionGenerique.formatterElementDate(date.heure) + ":" +
        fonctionGenerique.formatterElementDate(date.minute) + ":" +
        fonctionGenerique.formatterElementDate(date.seconde)
    );
}

exports.convertirEnSeconde = function(date) {
    return(
        date.seconde +
        (date.minute * 60) +
        (date.heure * 3600) +
        (date.jour * 86400) +
        (date.mois * 1036800) +
        (date.annee * 378432000)
    );
}