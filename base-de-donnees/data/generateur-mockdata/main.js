//######################################### Modeles
var date = require('./modele/DateModele');
var historique = require('./modele/Historique');
var bouee = require('./modele/Bouee');
var region = require('./modele/Region');
var typeCalcul = require('./modele/TypeCalcul');
var calcul = require('./modele/Calcul');

//######################################### Donnee
var bdd = require('./donnee/BaseDeDonnees');
var historiqueDAO = require('./donnee/HistoriqueDAO');

//######################################### Fonctions
var fonctionRegion = require('./fonction/fonctionRegion');
var fonctionBouee = require('./fonction/fonctionBouee');
var fonctionTypeDonneeMesuree = require('./fonction/fonctionTypeDonneeMesuree');
var fonctionTypeCalcul = require('./fonction/fonctionTypeCalcul');
var fonctionCalcul = require('./fonction/fonctionCalcul');
var fonctionDateModele = require('./fonction/fonctionDateModele');
var fonctionHistorique = require('./fonction/fonctionHistorique');

var fonctionGenerique = require('./fonction/fonctionGenerique');

//######################################### Modules
var fs = require('fs');


//######################################### Constantes
const REGION = 'region';
const BOUEE = 'bouee';
const TYPE_CALCUL = 'type_calcul';
const CALCUL = 'calcul';
const HISTORIQUE_DONNEE_BOUEE = 'historique_donnee_bouee';

const NOMBRE_DE_REGION = 8;
const NOMBRE_DE_BOUEE = 7500;
const NOMBRE_DE_TYPE_DE_CALCUL = 3;
const NOMBRE_DE_CALCUL = 5;

const DATE_DEBUT_HISTORIQUE = new date.DateModele(2,48,17,2,11,2019);
const DATE_FIN_HISTORIQUE = new date.DateModele(59,59,23,30,11,2019);

//######################################### Génération des Régions
var insererRegions = function(nombreDeRegion){

    var contenu = [];

    for (let index = 1; index <= nombreDeRegion; index++) {
        contenu.push(new region.Region(index, fonctionRegion.genererEtiquette(index)));
    }


    bdd.insererTableau(contenu, REGION);

}

//######################################### Génération des Bouées
var insertionBouee = function(nombreDeBouee){
    var contenu = [];
    var region = 0;
    for (let index = 1; index <= nombreDeBouee; index++) {
        region = fonctionGenerique.nombreEntierAleatoire(1, 8);

        contenu.push(new bouee.Bouee(index,
            fonctionBouee.genererEtiquette(index),
            fonctionBouee.genererLongitude(region),
            fonctionBouee.genererLatitude(region),
            region));

    }

    bdd.insererTableau(contenu, BOUEE);
}

//######################################### Génération des Types de calcul
var insererTypesCalculs = function(nombreDeTypeDeCalcul) {

    var contenu = [];
    for (let index = 1; index <= nombreDeTypeDeCalcul; index++) {
        contenu.push(new typeCalcul.TypeCalcul(index, fonctionTypeCalcul.genererEtiquette(index)))
    }

    bdd.insererTableau(contenu, TYPE_CALCUL);

}


//######################################### Génération des Calculs
var insererCalculs = function(nombreDeCalcul) {

    var contenu = [];

    for (let index = 1; index <= nombreDeCalcul; index++) {

        typeCalcul = fonctionCalcul.genererIdTypeCalcul();
        idRegion = fonctionCalcul.genererIdRegion();
        frequenceValeur = fonctionCalcul.genererFrequenceValeur();

        dateGeneration = fonctionDateModele.genererDateAleatoire();
        dateProchaineGeneration = fonctionDateModele.toString(fonctionCalcul.genererDateProchaineGeneration(dateGeneration));
        dateGeneration = fonctionDateModele.toString(dateGeneration);

        dateDebutPlage = fonctionCalcul.genererDateDebutPlage(dateGeneration);
        dateFinPlage = fonctionDateModele.toString(fonctionCalcul.genererDateFinPlage(dateDebutPlage, frequenceValeur));

        dateDebutPlage = fonctionDateModele.toString(dateDebutPlage);

        etiquette = fonctionCalcul.genererEtiquette(typeCalcul, idRegion, frequenceValeur);
        enregistrer = fonctionCalcul.genererEnregistre();

        contenu.push(new calcul.Calcul(index, etiquette, dateGeneration, dateProchaineGeneration, enregistrer, idRegion, 
                                        typeCalcul, dateDebutPlage, dateFinPlage, frequenceValeur, null, null, null)
                    );

    }

    bdd.insererTableau(contenu, CALCUL);

}


//######################################### Génération de l'historique des données des bouées directement dans la base de données


var insertionHistoriques = async function (nombreDeBouee, dateDebutHistorique, dateFinHistorique) {

    var idHistorique = 0;
    var dateEnCours = dateDebutHistorique;
    var tableauHistorique;

    var dateDebutProcess = new Date();

    var tableauHistorique = [];

    // console.log('Avant');
    var tableauRegionParBouee = await bdd.selectionnerDocumentsCollection(BOUEE);
    for (let index = 0; index < tableauRegionParBouee.length; index++) {
        tableauRegionParBouee.splice(index, 1, tableauRegionParBouee[index].id_region);
    }
    // console.log('Apres');
    
    
    while (!fonctionDateModele.dateModeleEgales(dateEnCours, dateFinHistorique)) {

        tableauHistorique = [];

        for (let idBouee = 1; idBouee <= nombreDeBouee; idBouee++) {

            idRegion = tableauRegionParBouee[idBouee-1];

            idHistorique++;
            tableauHistorique.push(new historique.Historique(
                idHistorique,
                idBouee,
                fonctionDateModele.toString(dateEnCours),
                fonctionHistorique.genererTemperature(),
                fonctionHistorique.genererDebit(),
                fonctionHistorique.genererSalinite(idRegion),
                fonctionHistorique.genererLongitude(idRegion),
                fonctionHistorique.genererLatitude(idRegion),
                fonctionHistorique.genererBatterie(),
                fonctionHistorique.genererValide()
            ));

        }

        // console.log('test');
        
        await bdd.insererTableau(tableauHistorique, HISTORIQUE_DONNEE_BOUEE);
        tableauHistorique = null;


        dateEnCours = fonctionDateModele.augmenterDateModeleXSeconde(dateEnCours, 60);

    }

    console.log(new Date(), 'done !', dateDebutProcess);
    
}


//######################################### Génération des MockData
var genererMockData = async function() {

    // await insererRegions(NOMBRE_DE_REGION);

    // await insertionBouee(NOMBRE_DE_BOUEE);

    // await insererTypesCalculs(NOMBRE_DE_TYPE_DE_CALCUL);

    await insererCalculs(NOMBRE_DE_CALCUL);

    // await insertionHistoriques(NOMBRE_DE_BOUEE, DATE_DEBUT_HISTORIQUE, DATE_FIN_HISTORIQUE);

}

genererMockData();
