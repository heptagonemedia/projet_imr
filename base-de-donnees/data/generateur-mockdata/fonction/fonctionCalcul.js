var fonctionGenerique = require('./fonctionGenerique');
var fonctionCalcul = require('./fonctionTypeCalcul');
var fonctionDateModele = require('./fonctionDateModele');

var date = require('../modele/DateModele');

const MILLISECONDS_DANS_1_SECONDE = 1000;
const MILLISECONDS_DANS_1_MINUTE = MILLISECONDS_DANS_1_SECONDE * 60;
const MILLISECONDS_DANS_1_HEURE = MILLISECONDS_DANS_1_MINUTE * 60;
const MILLISECONDS_DANS_1_JOUR = MILLISECONDS_DANS_1_HEURE * 24;
const MILLISECONDS_DANS_1_SEMAINE = MILLISECONDS_DANS_1_JOUR * 7;
const MILLISECONDS_DANS_1_MOIS = MILLISECONDS_DANS_1_SEMAINE * 4;
const MILLISECONDS_DANS_1_ANNEE = MILLISECONDS_DANS_1_MOIS * 12;

exports.genererEtiquette = function (typeCalcul, idRegion, frequenceValeur) {
    return ("" + fonctionCalcul.genererEtiquette(typeCalcul) + "" + trouverIntervaleCorrespondantMilliseconds(frequenceValeur) + "Region" + idRegion);
}

exports.genererDateDebutPlage = function(dateGenerationCalcul) {
    
    var dateDebutPlage;

    do {
        dateDebutPlage = fonctionDateModele.genererDateAleatoire();
    } while (fonctionDateModele.dateModeleParametre1EstPlusRecenteQueParametre2(dateGenerationCalcul, dateDebutPlage));    

    return dateDebutPlage;
}

exports.genererDateFinPlage = function (dateDebutPlage, frequenceValeur) {

    // console.log(dateDebutPlage);
    
    var aleatoire;
    var resultatMillisecondes;
    var seconde;
    var minute;
    var heure;
    var jour;
    var mois;
    var annee;
    var dateFinPlage;

    do {

        aleatoire = fonctionGenerique.nombreEntierAleatoire(0, 6);
        seconde = dateDebutPlage.seconde;
        minute = dateDebutPlage.minute;
        heure = dateDebutPlage.heure;
        jour = dateDebutPlage.jour;
        mois = dateDebutPlage.mois;
        annee = dateDebutPlage.annee;

        switch (aleatoire) {
            case 0: // seconde
                resultatMillisecondes = MILLISECONDS_DANS_1_SECONDE;
                seconde++;
                break;
            case 1: // minute
                resultatMillisecondes = MILLISECONDS_DANS_1_MINUTE;
                minute++;
                break;
            case 2: // heure
                resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
                heure++;
                break;
            case 3: // jour
                resultatMillisecondes = MILLISECONDS_DANS_1_JOUR;
                jour++
                break;
            case 4: // semaine
                resultatMillisecondes = MILLISECONDS_DANS_1_SEMAINE;
                jour += 7;
                break;
            case 5: // mois
                resultatMillisecondes = MILLISECONDS_DANS_1_MOIS;
                mois++;
                break;
            case 6: // annee
                resultatMillisecondes = MILLISECONDS_DANS_1_ANNEE;
                annee++;
                break;
            default:
                resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
                heure++;
                break;
        }

        dateFinPlage = new date.DateModele(seconde, minute, heure, jour, mois, annee);

    } while ((resultatMillisecondes < frequenceValeur) && fonctionDateModele.dateModeleParametre1EstPlusRecenteQueParametre2(dateFinPlage, dateDebutPlage));

    
    return dateFinPlage;

}

exports.genererDateProchaineGeneration = function(dateGeneration) {

    var aleatoire = fonctionGenerique.nombreEntierAleatoire(1, 5);
    var heure = dateGeneration.heure;
    var jour = dateGeneration.jour;
    var mois = dateGeneration.mois;
    var annee = dateGeneration.annee;

    switch (aleatoire) {
        case 1: // heure
            heure++;
            break;
        case 2: // jour
            jour++;
            break;
        case 3: // semaine
            jour += 7;
            break;
        case 4: // mois
            mois++;
            break;
        case 5: // annee
            annee++;
            break;
        default: //heure
            heure++;
            break;
    }

    return new date.DateModele(dateGeneration.seconde, dateGeneration.minute, heure, jour, mois, annee);

}

exports.genererEnregistre = function() {
    
    var aleatoire = fonctionGenerique.nombreEntierAleatoire(0,1);

    switch (aleatoire) {
        case 0:
            return "true";
        case 1:
            return "false";
        default:
            return "false";
    }

}

exports.genererIdRegion = function() {
    return fonctionGenerique.nombreEntierAleatoire(1,8);
}

// Ne sert plus
exports.genererIdBouee = function() {
    return fonctionGenerique.nombreEntierAleatoire(1,75000);
}

exports.genererIdTypeCalcul = function() {
    return fonctionGenerique.nombreEntierAleatoire(1,3);
}

exports.genererFrequenceValeur = function() {
    
    var aleatoire = fonctionGenerique.nombreEntierAleatoire(1,5);

    switch (aleatoire) {
        case 1: // heure
            return MILLISECONDS_DANS_1_HEURE;
        case 2: // jour
            return MILLISECONDS_DANS_1_JOUR;
        case 3: // semaine
            return MILLISECONDS_DANS_1_SEMAINE;
        case 4: // mois
            return MILLISECONDS_DANS_1_MOIS;
        case 5: // annee
            return MILLISECONDS_DANS_1_ANNEE;
        default:
            return MILLISECONDS_DANS_1_HEURE;
    }

}

trouverIntervaleCorrespondantMilliseconds = function(millisecondes) {

    switch (millisecondes) {
        case MILLISECONDS_DANS_1_SECONDE: // seconde
            return "Seconde";
        case MILLISECONDS_DANS_1_MINUTE: // minute
            return "Minute";            
        case MILLISECONDS_DANS_1_HEURE: // heure
            return "Heure";
        case MILLISECONDS_DANS_1_JOUR: // jour
            return "Jour";
        case MILLISECONDS_DANS_1_SEMAINE: // semaine
            return "Semaine";
        case MILLISECONDS_DANS_1_MOIS: // mois
            return "Mois";
        case MILLISECONDS_DANS_1_ANNEE: // annee
            return "Annee";            
    }

}