const bddMongo = require('../donnee/BaseDeDonneesMongoDB');
const historique = require('../modele/Historique');
const donnee = require('../modele/Donnee');

exports.verifier = async function (donnees, derniersId, donneesATester, table) {
    
    var dernierIdTable = parseInt(derniersId[('id_') + table], 10) +1;

    var idHistorique = parseInt(derniersId['id_historique'], 10) + 1;

    var idBouee = parseInt(donneesATester['id_bouee']);
    var temperature = parseFloat(donneesATester['temperature']);
    var debit = parseFloat(donneesATester['debit']);
    var salinite = parseFloat(donneesATester['salinite']);
    var longitude = parseFloat(donneesATester['longitude']);
    var latitude = parseFloat(donneesATester['latitude']);
    var batterie = parseInt(donneesATester['batterie']);

    var donneeComparaison = donnees[('bouee_' + idBouee)];

    var temperatureValide = parseFloat(donneeComparaison['derniere_donnee_valide_temp']);
    var debitValide = parseFloat(donneeComparaison['derniere_donnee_valide_debit']);
    var saliniteValide = parseFloat(donneeComparaison['derniere_donnee_valide_salinite']);
    var longitudeValide = parseFloat(donneeComparaison['derniere_donnee_valide_longitude']);
    var latitudeValide = parseFloat(donneeComparaison['derniere_donnee_valide_latitude']);
    var batterieValide = parseInt(donneeComparaison['derniere_donnee_valide_batterie']);

    var derniereTemperature = parseFloat(donneeComparaison['derniere_donnee_temp']);
    var derniereDebit = parseFloat(donneeComparaison['derniere_donnee_debit']);
    var derniereSalinite = parseFloat(donneeComparaison['derniere_donnee_salinite']);
    var derniereLongitude = parseFloat(donneeComparaison['derniere_donnee_longitude']);
    var derniereLatitude = parseFloat(donneeComparaison['derniere_donnee_latitude']);
    var derniereBatterie = parseInt(donneeComparaison['derniere_donnee_batterie']);

    var validiteTemperature;
    var validiteDebit;
    var validiteSalinite;
    var validiteLongitude;
    var validiteLatitude;
    var validiteBatterie;

    var valideTemperatureDonnee;
    var valideDebitDonnee;
    var valideSaliniteDonnee;
    var valideLongitudeDonnee;
    var valideLatitudeDonnee;
    var valideBatterieDonnee;

    // Temperature
    if (temperatureValide == derniereTemperature) {
        validiteTemperature = this.verifierValeur(temperature, derniereTemperature);
    } else {
        validiteTemperature = this.verifierValeur(temperature, temperatureValide);
    }

    if (validiteTemperature) {
        valideTemperatureDonnee = temperature;
    } else {
        valideTemperatureDonnee = temperatureValide;
    }

    // Debit
    if (debitValide == derniereDebit) {
        validiteDebit = this.verifierValeur(debit, derniereDebit);
    } else {
        validiteDebit = this.verifierValeur(debit, debitValide);
    }

    if (validiteDebit) {
        valideDebitDonnee = debit;
    } else {
        valideDebitDonnee = debitValide;
    }
    
    // Salinite
    if (saliniteValide == derniereSalinite) {
        validiteSalinite = this.verifierValeur(salinite, derniereSalinite);
    } else {
        validiteSalinite = this.verifierValeur(salinite, saliniteValide);
    }

    if (validiteSalinite) {
        valideSaliniteDonnee = salinite;
    } else {
        valideSaliniteDonnee = saliniteValide;
    }
    
    // Longitude
    if (longitudeValide == derniereLongitude) {
        validiteLongitude = this.verifierValeur(longitude, derniereLongitude);
    } else {
        validiteLongitude = this.verifierValeur(longitude, longitudeValide);
    }

    if (validiteLongitude) {
        valideLongitudeDonnee = longitude;
    } else {
        valideLongitudeDonnee = longitudeValide;
    }
    
    // Latitude
    if (latitudeValide == derniereLatitude) {
        validiteLatitude = this.verifierValeur(longitude, derniereLatitude);
    } else {
        validiteLatitude = this.verifierValeur(longitude, latitudeValide);
    }
    
    if (validiteLatitude) {
        valideLatitudeDonnee = latitude;
    } else {
        valideLatitudeDonnee = latitudeValide;
    }

    // Batterie
    if (batterieValide == derniereBatterie) {
        validiteBatterie = this.verifierBatterie(batterie, derniereBatterie);
    } else {
        validiteBatterie = this.verifierBatterie(batterie, batterieValide);
    }

    if (validiteBatterie) {
        valideBatterieDonnee = batterie;
    } else {
        valideBatterieDonnee = batterieValide;
    }

    
    var valide = validiteTemperature || validiteDebit || validiteSalinite || validiteLongitude || validiteLatitude || validiteBatterie;

    var historiqueTemporaire = new historique.Historique(idHistorique, idBouee, date, temperature, debit, salinite, longitude, latitude, batterie, valide);
    
    var donneeTemporaire = new donnee.Donnee(idBouee,
        temperature,valideTemperatureDonnee,
        debit,valideDebitDonnee,
        salinite,valideSaliniteDonnee,
        longitude,valideLongitudeDonnee,
        latitude,valideLatitudeDonnee,
        batterie,valideBatterieDonnee);

    var resultat = [];
    resultat.push(donneeTemporaire);
    resultat.push(idHistorique);
    resultat.push(dernierIdTable);
   

    await bddMongo.insererDocument(historiqueTemporaire, 'historique_donnee_bouee');

    return resultat;
    
}


exports.verifierValeur = function(valeur, valeurComparaison) {
    return ((valeur > valeurComparaison * 1.5) && (valeur < valeurComparaison * 0.95));
}

exports.verifierBatterie = function(batterie, batterieComparaison) {
    return ((batterie < batterieComparaison) && (batterie > 0));
}