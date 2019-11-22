var fonctionGenerique = require('./fonctionGenerique');
var fonctionBouee = require('./fonctionBouee');

exports.genererTemperature = function() {
    return fonctionGenerique.nombreAleatoire(-15,25);
}

exports.genererDebit = function () {
    return fonctionGenerique.nombreEntierAleatoire(12000, 15*Math.pow(10,7));
}

exports.genererSalinite = function (idRegion) {

    switch (idRegion) {
        case 1: /*Atl_S*/ case 2://Atl_N
            return fonctionGenerique.nombreAleatoire(33.5, 37.4);
        case 3: /*Pac_N*/ case 4: //Pac_S
            return fonctionGenerique.nombreAleatoire(34.5, 36.9);
        case 5: //Oc_Ind
            return fonctionGenerique.nombreAleatoire(35.5, 36.7);
        case 6: /*Oc_Au*/ case 7: //Oc_Ar
            return fonctionGenerique.nombreAleatoire(33.5, 41.2);
        case 8: //M_Medit
            return fonctionGenerique.nombreAleatoire(38.4, 41.2);
    }

}

exports.genererLongitude = function (idRegion) {
    return fonctionBouee.genererLongitude(idRegion)
}

exports.genererLatitude = function (idRegion) {
    return fonctionBouee.genererLatitude(idRegion);
}

exports.genererBatterie = function () {
    return fonctionGenerique.nombreEntierAleatoire(0,100);
}

exports.genererValide = function () {

    var aleatoire = fonctionGenerique.nombreEntierAleatoire(0,2);

    if (aleatoire == 0 || aleatoire == 1) {
        return true;
    }

    return false;

}