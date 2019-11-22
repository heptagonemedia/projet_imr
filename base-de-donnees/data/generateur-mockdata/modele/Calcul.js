module.exports = {

    Calcul: function (idCalcul, etiquette, dateGeneration, dateProchaineGeneration, enregistrer, 
                        idRegion, idTypeCalcul, dateDebutPlage, dateFinPlage, frequenceValeur, 
                        xmlGraphiqueTemperature, xmlGraphiqueSalinite, xmlGraphiqueDebit) {

        this.id_calcul = idCalcul;
        this.etiquette = etiquette;
        this.date_generation = dateGeneration;
        this.date_prochaine_generation = dateProchaineGeneration;
        this.enregistrer = enregistrer;
        this.id_region = idRegion;
        this.id_type_calcul = idTypeCalcul;
        this.date_debut_palge = dateDebutPlage;
        this.date_fin_palge = dateFinPlage;
        this.frequence_valeur = frequenceValeur;
        this.xml_graphique_temperature = xmlGraphiqueTemperature;
        this.xml_graphique_salinite = xmlGraphiqueSalinite;
        this.xml_graphique_debit = xmlGraphiqueDebit;

    }
    
}