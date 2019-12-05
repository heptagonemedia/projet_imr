module.exports = {
    Donnee: function (idBouee, derniereDonneeTemperature, derniereDonneeValideTemperature, 
                        derniereDonneeDebit, derniereDonneeValideDebit,
                        derniereDonneeSalinite, derniereDonneeValideSalinite,
                        derniereDonneeLongitude, derniereDonneeValideLongitude,
                        derniereDonneeLatitude, derniereDonneeValideLatitude,
                        derniereDonneeBatterie, derniereDonneeValideBatterie
                        ){
        {
            this.id_bouee = idBouee;
            this.derniere_donnee_temp = derniereDonneeTemperature;
            this.derniere_donnee_valide_temp = derniereDonneeValideTemperature;
            this.derniere_donnee_debit = derniereDonneeDebit;
            this.derniere_donnee_valide_debit = derniereDonneeValideDebit;
            this.derniere_donnee_salinite = derniereDonneeSalinite;
            this.derniere_donnee_valide_salinite = derniereDonneeValideSalinite;
            this.derniere_donnee_longitude = derniereDonneeLongitude;
            this.derniere_donnee_valide_longitude = derniereDonneeValideLongitude;
            this.derniere_donnee_latitude = derniereDonneeLatitude;
            this.derniere_donnee_valide_latitude = derniereDonneeValideLatitude;
            this.derniere_donnee_batterie = derniereDonneeBatterie;
            this.derniere_donnee_valide_batterie = derniereDonneeValideBatterie;
        }
    }
}