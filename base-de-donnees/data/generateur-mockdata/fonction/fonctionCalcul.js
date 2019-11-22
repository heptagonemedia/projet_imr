var fonctionGenerique = require('./fonctionGenerique');
var fonctionCalcul = require('./fonctionTypeCalcul');

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
        dateDebutPlage = fonctionGenerique.genererDateAleatoire();
    } while ((dateGenerationCalcul - dateDebutPlage) < 0);

    return dateDebutPlage;
}

exports.genererDateFinPlage = function (dateDebutPlage, frequenceValeur, dateGenerationCalcul) {

    var aleatoire;
    var resultatMillisecondes;

    do {

        aleatoire = fonctionGenerique.nombreEntierAleatoire(0, 6);

        switch (aleatoire) {
            case 0: // seconde
                resultatMillisecondes = MILLISECONDS_DANS_1_SECONDE;
                break;
            case 1: // minute
                resultatMillisecondes = MILLISECONDS_DANS_1_MINUTE;
                break;
            case 2: // heure
                resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
                break;
            case 3: // jour
                resultatMillisecondes = MILLISECONDS_DANS_1_JOUR;
                break;
            case 4: // semaine
                resultatMillisecondes = MILLISECONDS_DANS_1_SEMAINE;
                break;
            case 5: // mois
                resultatMillisecondes = MILLISECONDS_DANS_1_MOIS;
                break;
            case 6: // annee
                resultatMillisecondes = MILLISECONDS_DANS_1_ANNEE;
                break;
            default:
                resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
                break;
        }

    } while ((resultatMillisecondes < frequenceValeur) && ((dateGenerationCalcul - new Date(+(dateDebutPlage) + resultatMillisecondes)) < 0));
    // A voir si la condition est correcte 
    // Une solution est peut-être de regardé si resultat/frequence est un entier > 0 =>
    // Number.isInteger(Math.floor(resultatMillisecondes / frequenceValeur)) && Math.floor(resultatMillisecondes / frequenceValeur)>0

    return new Date(+(dateDebutPlage) + resultatMillisecondes);

}

exports.genererDateProchaineGeneration = function(dateGeneration) {

    var aleatoire = fonctionGenerique.nombreEntierAleatoire(1, 5);
    var resultatMillisecondes;

    switch (aleatoire) {
        case 1: // heure
            resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
            break;
        case 2: // jour
            resultatMillisecondes = MILLISECONDS_DANS_1_JOUR;
            break;
        case 3: // semaine
            resultatMillisecondes = MILLISECONDS_DANS_1_SEMAINE;
            break;
        case 4: // mois
            resultatMillisecondes = MILLISECONDS_DANS_1_MOIS;
            break;
        case 5: // annee
            resultatMillisecondes = MILLISECONDS_DANS_1_ANNEE;
            break;
        default:
            resultatMillisecondes = MILLISECONDS_DANS_1_HEURE;
            break;
    }

    return new Date(+(dateGeneration) + resultatMillisecondes);

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
            return MILLISECONDS_DANS_1_HEURE ;
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