module.exports = {
    Bouee: function (idBouee, etiquette, longitude, latitude, idRegion){
        this.id_bouee = idBouee;
        this.etiquette = etiquette;
        this.longitude_reference = longitude;
        this.latitude_reference = latitude;
        this.id_region = idRegion;
    }
}