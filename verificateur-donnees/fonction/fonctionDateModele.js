const fonctionGenerique = require('./fonctionGenerique');
const date = require('../modele/DateModele');

exports.dateModeleEgales = function (date1, date2) {

    return ((date1.seconde == date2.seconde) &&
        (date1.minute == date2.minute) &&
        (date1.heure == date2.heure) &&
        (date1.jour == date2.jour) &&
        (date1.mois == date2.mois) &&
        (date1.annee == date2.annee));

}

exports.convertirChaine = function (chaine) {

    //'Fri Nov 01 2019 00:00:00 GMT-0400 (GMT-04: 00)'

    var tableau = chaine.split(' ');
    var horaire = tableau[4].split(':');
    
    return new date.DateModele(parseInt(horaire[2], 10), parseInt(horaire[1], 10), parseInt(horaire[0], 10), parseInt(tableau[2], 10), this.trouverMois(tableau[1]), parseInt(tableau[3], 10));

}

exports.trouverMois = function(moisATrouver) {

    switch (moisATrouver) {
        case 'Jan':
            return 1;
        case 'Feb':
            return 2;
        case 'Mar':
            return 3;
        case 'Apr':
            return 4;
        case 'May':
            return 5;
        case 'Jun':
            return 6;
        case 'Jul':
            return 7;
        case 'Aug':
            return 8;
        case 'Sep':
            return 9;
        case 'Oct':
            return 10;
        case 'Nov':
            return 11;
        case 'Dec':
            return 12;
    }

}

exports.dateModeleParametre1EstPlusRecenteQueParametre2 = function (date1, date2) {

    return (
        (date1.annee > date2.annee) ||
        ((date1.annee == date2.annee) && (date1.mois == date2.mois) && (date1.jour == date2.jour) && (date1.heure == date2.heure) &&
            (date1.minute == date2.minute) && (date1.seconde > date2.seconde)) ||
        ((date1.annee == date2.annee) && (date1.mois == date2.mois) && (date1.jour == date2.jour) && (date1.heure == date2.heure) &&
            (date1.minute > date2.minute)) ||
        ((date1.annee == date2.annee) && (date1.mois == date2.mois) && (date1.jour == date2.jour) && (date1.heure > date2.heure)) ||
        ((date1.annee == date2.annee) && (date1.mois == date2.mois) && (date1.jour > date2.jour)) ||
        ((date1.annee == date2.annee) && (date1.mois > date2.mois))
    );

}

exports.augmenterDateModeleXSeconde = function (date, ajout) {

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

exports.toString = function (date) {
    return (
        "" + date.annee + "-" +
        fonctionGenerique.formatterElementDate(date.mois) + "-" +
        fonctionGenerique.formatterElementDate(date.jour) + " " +
        fonctionGenerique.formatterElementDate(date.heure) + ":" +
        fonctionGenerique.formatterElementDate(date.minute) + ":" +
        fonctionGenerique.formatterElementDate(date.seconde)
    );
}

exports.convertirEnSeconde = function (date) {
    return (
        date.seconde +
        (date.minute * 60) +
        (date.heure * 3600) +
        (date.jour * 86400) +
        (date.mois * 1036800) +
        (date.annee * 378432000)
    );
}

exports.genererDateAleatoire = function () {

    var heure = fonctionGenerique.nombreEntierAleatoire(0, 23);
    var minute = fonctionGenerique.nombreEntierAleatoire(0, 59);
    var seconde = fonctionGenerique.nombreEntierAleatoire(0, 59);
    var annee = fonctionGenerique.nombreEntierAleatoire(2018, 2019);
    var mois = fonctionGenerique.nombreEntierAleatoire(1, 12);
    var jour;

    if ((mois == 2) && fonctionGenerique.estBisextile(annee)) {
        jour = fonctionGenerique.nombreEntierAleatoire(1, 29);
    } else if ((mois == 2) && !fonctionGenerique.estBisextile(annee)) {
        jour = fonctionGenerique.nombreEntierAleatoire(1, 28);
    } else if (((mois < 8) && (mois != 2) && (mois % 2 == 0)) || ((mois > 7) && (mois % 2 == 1))) {
        jour = fonctionGenerique.nombreEntierAleatoire(1, 30);
    } else if (((mois < 8) && (mois % 2 == 1)) || ((mois > 7) && (mois % 2 == 0))) {
        jour = fonctionGenerique.nombreEntierAleatoire(1, 31);
    }

    chaineDate = "" + annee + "-" + mois + "-" + jour + " " + heure + ":" + minute + ":" + seconde;

    return new date.DateModele(seconde, minute, heure, jour, mois, annee);

}