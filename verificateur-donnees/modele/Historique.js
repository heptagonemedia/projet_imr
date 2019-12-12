module.exports = {
    Historique: function (idHistorique, idBouee, idRegion, date, temperature, debit, salinite, longitude, latitude, batterie, valide) {
        this.id_istorique_bouee = idHistorique;
        this.id_bouee = idBouee;
        this.id_region = idRegion;
        this.date_saisie = date;
        this.temperature = temperature;
        this.debit = debit;
        this.salinite = salinite;
        this.longitude = longitude;
        this.latitude = latitude;
        this.batterie = batterie;
        this.valide = valide;
    }
}