module.exports = {
    Historique: function (idHistorique, idBouee, date, temperature, debit, salinite, longitude, latitude, batterie, valide) {
        this.idHistorique = idHistorique;
        this.idBouee = idBouee;
        this.date = date;
        this.temperature = temperature;
        this.debit = debit;
        this.salinite = salinite;
        this.longitude = longitude;
        this.latitude = latitude;
        this.batterie = batterie;
        this.valide = valide;
    }
}