const calcul = require('../modele/Calcul');
const date = require('../modele/DateModele');

const baseDeDonnees = require('../donnee/BaseDeDonneesMongo');

const fonctionDate = require('../fonction/fonctionDateModele');
const fonctionGenerique = require('../fonction/fonctionGenerique');
const fonctionXml = require('../fonction/fonctionCreationXML');

module.exports = {
    CalculDAO: function() {},

    async ajouterCalcul(etiquetteCalcul, typeCalcul, annee, mois, jour, heure, minute, idRegion,
                    dateDebut, heureDebut, dateFin, heureFin, calculEnregistrer, repeter, repeterTousLesCombien) {

        console.log();
        
        var frequenceValeur = fonctionGenerique.convertirDonneeEnMilliseconde('annee',annee,annee,mois) + 
            fonctionGenerique.convertirDonneeEnMilliseconde('mois', mois, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('jour', jour, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('heure', heure, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('minute', minute, annee, mois);

        
        var dateDebutPlage = fonctionDate.convertirDateEtHeureEnDate(dateDebut, heureDebut);
        var dateFinPlage = fonctionDate.convertirDateEtHeureEnDate(dateFin, heureFin);
        
        
        var temps = new Date();
        var dateGeneration = new date.DateModele(temps.getSeconds(), temps.getMinutes(), temps.getHours(), 
                                                temps.getDate(), (temps.getMonth() + 1), temps.getFullYear());

        // console.log();
        var dateProchaineGeneration = null;

        if (repeter) {

            switch (repeterTousLesCombien) {
                case 1:
                    dateProchaineGeneration = fonctionDate.augmenterDate1Jour(dateGeneration);
                    break;
                case 2:
                    dateProchaineGeneration = fonctionDate.augmenterDate1Semaine(dateGeneration);
                    break;
                case 3:
                    dateProchaineGeneration = fonctionDate.augmenterDate1An(dateGeneration);
                    break;
            }

        }

        var xmls = this.calculer();


        
        // baseDeDonnees.insererDocument(
        //     new calcul.Calcul(0, etiquetteCalcul, dateGeneration, dateProchaineGeneration, calculEnregistrer, idRegion,
        //         typeCalcul, dateDebutPlage, dateFinPlage, frequenceValeur, xmlT,xmlS,xmlD), 'calcul'
        // );

    },

    calculer() {

        var xmlTemp = fonctionXml.version();
        xmlTemp += fonctionXml.debutRoot();
        xmlTemp += fonctionXml.debutLigne();

        var compteur = 0;

        while (condition) {
            compteur++;

            // select des données
            // faire le calcul

            xmlTemp += fonctionXml.point(compteur,valeur);
            


        }

        xmlTemp += fonctionXml.finLigne();
        xmlTemp += fonctionXml.finRoot();


    }

}