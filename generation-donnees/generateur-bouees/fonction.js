var bouee = require('./model/Bouee');

exports.nombreAleatoire = function (min, max) {
    return (Math.random() * (max - min) + min);
}

exports.nombreEntierAleatoire = function (min, max) {
    return (Math.floor(Math.random() * (max - min + 1)) + min);
}

exports.genererEtiquette = function(id) {
    return ('Bouee ' + (id + 1));
}

exports.genererLongitude = function (region) {

    switch (region) {
        case 1: //Atl_N
            return this.nombreAleatoire(-55.00,-16.00);
        case 2: //Atl_S
            return this.nombreAleatoire(-50.00, 7.00);
    }

}

exports.genererLatitude = function (region) {
    
    switch (region) {
        case 1:
            return this.nombreAleatoire(5.00, 45.00);
        case 2:
            return this.nombreAleatoire(-45.00, -4.00);
    }

}

exports.genererBatterie = function () {
    return this.nombreEntierAleatoire(20, 101);
}

exports.genererBouee = function(index) {

    region = this.nombreEntierAleatoire(1, 2);

    etiquette = this.genererEtiquette(index);
    longitude = this.genererLongitude(region);
    latitude = this.genererLatitude(region);
    // batterie = this.genererBatterie();

    return (new bouee.Bouee(etiquette,
        longitude,
        latitude,
        0,
        region));

}