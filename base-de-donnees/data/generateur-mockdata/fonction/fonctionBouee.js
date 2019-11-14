var fonctionGenerique = require('./fonctionGenerique');

exports.genererEtiquette = function(id) {
    return ('Bouee ' + id);
}

exports.genererLongitude = function (region) {

    switch (region) {
        case 1: //Atl_N
            return fonctionGenerique.nombreAleatoire(-60.00,-16.00);
        case 2: //Atl_S
            return fonctionGenerique.nombreAleatoire(-50.00, 7.00);
        case 3: //Pac_N
            return fonctionGenerique.nombreAleatoire(-128.00, 150.00);
        case 4: //Pac_S
            return fonctionGenerique.nombreAleatoire(-180.00, -80.00);
        case 5: //Oc_Ind
            return fonctionGenerique.nombreAleatoire(55.00, 110.00);
        case 6: //Oc_Au
            return fonctionGenerique.nombreAleatoire(-70.00, 130.00);
        case 7: //Oc_Ar
            return fonctionGenerique.nombreAleatoire(-160.00, -17.00);
        case 8: //M_Medit
            return fonctionGenerique.nombreAleatoire(15.00, 30.00);
    }

}

exports.genererLatitude = function (region) {
    
    switch (region) {
        case 1: //Atl_N
            return fonctionGenerique.nombreAleatoire(5.00, 45.00);
        case 2: //Atl_S
            return fonctionGenerique.nombreAleatoire(-45.00, -4.00);
        case 3: //Pac_N
            return fonctionGenerique.nombreAleatoire(0.00, 50.00);
        case 4: //Pac_S
            return fonctionGenerique.nombreAleatoire(-55.00, 0.00);
        case 5: //Oc_Ind
            return fonctionGenerique.nombreAleatoire(-55.00, 2.00);
        case 6: //Oc_Au
            return fonctionGenerique.nombreAleatoire(-60.00, -45.00);
        case 7: //Oc_Ar
            return fonctionGenerique.nombreAleatoire(72.00, 83.00);
        case 8: //M_Medit
            return fonctionGenerique.nombreAleatoire(32.00, 35.00);
    }

}
