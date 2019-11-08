module.exports = {
    Bouee: function (etiquette, longitude, latitude, batterie, region) {
        this.etiquette = etiquette;
        this.valeur_depart_longitude = longitude;
        this.valeur_depart_latitude = latitude;
        this.valeur_depart_batterie = batterie;
        this.id_region = region;
    }
}