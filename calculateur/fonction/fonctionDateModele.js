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

exports.convertirDateEtHeureEnDate = function (dateConv, heure) {
    // Dec 27, 2019
    // 05:19 PM

    var tableauDate = dateConv.split(' ');
    var splitTableauDate = tableauDate[1].split(',');

    var tableauHeure = heure.split(' ');
    var splitTableauHeure = tableauHeure[0].split(':');
    var heureDate = parseInt(splitTableauHeure[0]);
    var minuteDate = parseInt(splitTableauHeure[1]);

    if (tableauHeure[2] === 'PM') {
        heureDate += 12;
    }

    return new date.DateModele(0, (minuteDate), heureDate, parseInt(splitTableauDate[0]), this.trouverMois(tableauDate[0]), parseInt(tableauDate[2]));

}

exports.convertirChaine = function (chaine) {

    //'Fri Nov 01 2019 00:00:00 GMT-0400 (GMT-04: 00)'

    var tableau = chaine.split(' ');
    var horaire = tableau[4].split(':');

    return new date.DateModele(parseInt(horaire[2], 10), parseInt(horaire[1], 10), parseInt(horaire[0], 10), parseInt(tableau[2], 10), this.trouverMois(tableau[1]), parseInt(tableau[3], 10));

}

exports.trouverMois = function (moisATrouver) {

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

exports.augmenterDateModeleXHeure = function (date, ajout) {

    var dateSuivante = date;

    dateSuivante.heure += ajout;

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

    // }

    // }

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

exports.convertirEnMilliseconde = function (date) {
    return (
        (date.seconde * 1000) +
        (date.minute * 60 * 1000) +
        (date.heure * 3600 * 1000) +
        (date.jour * 86400 * 1000) +
        (date.mois * 1036800 * 1000) +
        (date.annee * 378432000 * 1000)
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

exports.augmenterDate1Jour = function (date) {

    var dateSuivante = date;

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

    return dateSuivante;

}

exports.augmenterDate1An = function (date) {

    var dateSuivante = date;
    dateSuivante.annee++;

    return dateSuivante;

}

exports.augmenterDate1Semaine = function (date) {

    var dateSuivante = date;
    var jourTemporaire = dateSuivante.jour + 7;
    dateSuivante.jour += 7;

    if (((dateSuivante.mois == 2) && (dateSuivante.jour > 28) && !fonctionGenerique.estBisextile(dateSuivante.annee))) {

        dateSuivante.jour = jourTemporaire - 28;
        dateSuivante.mois++;

        if (dateSuivante.mois > 12) {

            dateSuivante.mois = 1;
            dateSuivante.annee++;

        }

    } else if (((dateSuivante.mois == 2) && (dateSuivante.jour > 29) && fonctionGenerique.estBisextile(dateSuivante.annee))) {
        dateSuivante.jour = jourTemporaire - 29;
        dateSuivante.mois++;

        if (dateSuivante.mois > 12) {

            dateSuivante.mois = 1;
            dateSuivante.annee++;

        }
    } else if ((dateSuivante.jour > 30) && (((dateSuivante.mois < 8) && (dateSuivante.mois != 2) && (dateSuivante.mois % 2 == 0)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 1)))) {
        dateSuivante.jour = jourTemporaire - 30;
        dateSuivante.mois++;

        if (dateSuivante.mois > 12) {

            dateSuivante.mois = 1;
            dateSuivante.annee++;

        }
    } else if ((dateSuivante.jour > 31) && (((dateSuivante.mois < 8) && (dateSuivante.mois % 2 == 1)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 0)))) {
        dateSuivante.jour = jourTemporaire - 31;
        dateSuivante.mois++;

        if (dateSuivante.mois > 12) {

            dateSuivante.mois = 1;
            dateSuivante.annee++;

        }
    }

    return dateSuivante;

}

exports.augmenter = function (date, annee, mois, jour, heure, minute, seconde) {

    var dateSuivante = date;

    if (seconde != 0) {

        dateSuivante.seconde += seconde;

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


    }

    if (minute != 0) {

        dateSuivante.minute += minute;

        if (dateSuivante.minute > 59) {

            dateSuivante.minute = dateSuivante.minute - 60;
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

    if (heure != 0) {

        dateSuivante.heure += heure;

        if (dateSuivante.heure > 23) {

            dateSuivante.heure = dateSuivante.heure - 24;
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

    if (jour != 0) {

        dateSuivante.jour += jour;

        if (((dateSuivante.mois == 2) && (dateSuivante.jour > 28) && !fonctionGenerique.estBisextile(dateSuivante.annee))) {

            dateSuivante.jour = dateSuivante.jour - 28;
            dateSuivante.mois++;

            if (dateSuivante.mois > 12) {

                dateSuivante.mois = 1;
                dateSuivante.annee++;

            }

        } else if (((dateSuivante.mois == 2) && (dateSuivante.jour > 29) && fonctionGenerique.estBisextile(dateSuivante.annee))) {

            dateSuivante.jour = dateSuivante.jour - 29;
            dateSuivante.mois++;

            if (dateSuivante.mois > 12) {

                dateSuivante.mois = 1;
                dateSuivante.annee++;

            }

        } else if ((dateSuivante.jour > 30) && (((dateSuivante.mois < 8) && (dateSuivante.mois != 2) && (dateSuivante.mois % 2 == 0)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 1)))) {

            dateSuivante.jour = dateSuivante.jour - 30;
            dateSuivante.mois++;

            if (dateSuivante.mois > 12) {

                dateSuivante.mois = 1;
                dateSuivante.annee++;

            }

        } else if ((dateSuivante.jour > 31) && (((dateSuivante.mois < 8) && (dateSuivante.mois % 2 == 1)) || ((dateSuivante.mois > 7) && (dateSuivante.mois % 2 == 0)))) {

            dateSuivante.jour = dateSuivante.jour - 31;
            dateSuivante.mois++;

            if (dateSuivante.mois > 12) {

                dateSuivante.mois = 1;
                dateSuivante.annee++;

            }

        }

    }

    if (mois != 0) {

        dateSuivante.mois += mois;

        if (dateSuivante.mois > 12) {

            dateSuivante.mois = dateSuivante.mois - 12;
            dateSuivante.annee++;

        }

    }

    if (annee != 0) {
        dateSuivante.annee += annee;
    }


    return dateSuivante;

}

exports.trouverToutesLesDatesEntre2Dates = function (date1, date2) {

    // console.log(date1);
    // console.log(date2);

    var resultat = [];
    var dateTemporaire = date1;
    var objet;

    while (!this.dateModeleEgales(dateTemporaire, date2)) {

        objet = { "date_saisie": this.toString(dateTemporaire) };
        resultat.push(objet);
        dateTemporaire = this.augmenterDateModeleXSeconde(dateTemporaire, 30);

    }

    // console.log('resultat',resultat);

    return resultat;

}