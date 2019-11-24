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

//######################################### Variables
var nombreDeRegion = 8;
var nombreDeBouee = 7500;
var nombreDeDonneeMesuree = 6;
var nombreDeTypeDeCalcul = 3;
var nombreDeCalcul = 5;
var nombreDeResultatParCalcul = 3;

var dateDebutHistorique = new date.DateModele(0,0,0,1,11,2019);
var dateFinHistorique = new date.DateModele(0,30,0,1,11,2019);

var contenu = [];

// contenu = [];
// //######################################### Génération des Régions
// for (let index = 1; index <= nombreDeRegion; index++) {
//     contenu.push(new region.Region(index, fonctionRegion.genererEtiquette(index)));
// }


// bdd.insererTableau(contenu, REGION);


// contenu = [];
// // ######################################### Génération des Bouées
// var region = 0;
// for (let index = 1; index <= nombreDeBouee; index++) {
//     region = fonctionGenerique.nombreEntierAleatoire(1,8);

//     contenu.push(new bouee.Bouee(index, 
//                                 fonctionBouee.genererEtiquette(index), 
//                                 fonctionBouee.genererLongitude(region),
//                                 fonctionBouee.genererLatitude(region),
//                                 region));

// }

// bdd.insererTableau(contenu, BOUEE);

// contenu = "";
// //######################################### Génération des Types de données mesurées
// for (let index = 1; index <= nombreDeDonneeMesuree; index++) {
//     contenu += "" + index + "," + fonctionTypeDonneeMesuree.genererEtiquette(index) + "," +
//         fonctionTypeDonneeMesuree.genererUnite(index) + "\n";
// }

// fs.appendFile(('' + cheminMockdata + NOM_FICHIER_TYPE_DONNEE_MESUREE), contenu, (err) => {
//     if (err) throw err;
//     console.log('type_donnee_mesuree.csv générer');
// });

// contenu = [];
// //######################################### Génération des Types de calcul
// for (let index = 1; index <= nombreDeTypeDeCalcul; index++) {
//     contenu.push(new typeCalcul.TypeCalcul(index, fonctionTypeCalcul.genererEtiquette(index)))
// }

// bdd.insererTableau(contenu, TYPE_CALCUL);


// contenu = [];
// //######################################### Génération des Calculs
// for (let index = 1; index <= nombreDeCalcul; index++) {

//     typeCalcul = fonctionCalcul.genererIdTypeCalcul();
//     idRegion = fonctionCalcul.genererIdRegion();
//     frequenceValeur = fonctionCalcul.genererFrequenceValeur();

//     dateGeneration = fonctionDateModele.genererDateAleatoire();
//     dateProchaineGeneration = fonctionDateModele.toString(fonctionCalcul.genererDateProchaineGeneration(dateGeneration));
//     dateGeneration = fonctionDateModele.toString(dateGeneration);

//     dateDebutPlage = fonctionCalcul.genererDateDebutPlage(dateGeneration);
//     dateFinPlage = fonctionDateModele.toString(fonctionCalcul.genererDateFinPlage(dateDebutPlage, frequenceValeur));
    
//     dateDebutPlage = fonctionDateModele.toString(dateDebutPlage);

//     etiquette = fonctionCalcul.genererEtiquette(typeCalcul, idRegion, frequenceValeur);
//     enregistrer = fonctionCalcul.genererEnregistre();

//     contenu.push(new calcul.Calcul(index, etiquette, dateGeneration, dateProchaineGeneration, enregistrer, idRegion, 
//                                     typeCalcul, dateDebutPlage, dateFinPlage, frequenceValeur, null, null, null)
//                 );

// }

// bdd.insererTableau(contenu, CALCUL);


// contenu = "";
// //######################################### Génération de Résultats en rapport avec les calculs précédemment générés
// var idResultat = 0;
// var cheminXMLResultat = "chemin/a/definir/";

// for (let index = 1; index <= nombreDeCalcul; index++) {
    
//     for (let idTypeDonnee = 1; idTypeDonnee <= nombreDeResultatParCalcul; idTypeDonnee++) {
//         idResultat++;
//         nomFichierXML = "calcul" + index + "Donnee" + idTypeDonnee + ".xml";
//         xml_graphique = "" + cheminXMLResultat + nomFichierXML;
//         contenu += "" + idResultat + "," + xml_graphique + "\n";
//     }

// }

// fs.appendFile(('' + cheminMockdata + NOM_FICHIER_RESULTAT), contenu, (err) => {
//     if (err) throw err;
//     console.log('resultat.csv générer');
// });


// //######################################### Génération de l'historique des données des bouées directement dans la base de données
var idHistorique = 0;
var dateEnCours = dateDebutHistorique;
var tableauHistorique;

(async function t() {

    dateDebutProcess = new Date();

    tableauHistorique = [];

    console.log('Avant');
    var tableauRegionParBouee = await bdd.selectionnerDocumentsCollection(BOUEE);
    for (let index = 0; index < tableauRegionParBouee.length; index++) {

        tableauRegionParBouee.splice(index, 1, tableauRegionParBouee[index].id_region);

    }
    console.log('Apres');
    
    
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

        console.log('test');
        
        await bdd.insererTableau(tableauHistorique, HISTORIQUE_DONNEE_BOUEE);
        tableauHistorique = null;


        dateEnCours = fonctionDateModele.augmenterDateModeleXSeconde(dateEnCours, 60);

    }

    console.log(new Date(), 'done !', dateDebutProcess);
    
})()


// (async function() {

//     dateDebutProcess = new Date();
    
//     var dateEnCours = dateDebutHistorique;

//     idHistorique = 0;
//     tableauHistorique = [];
//     idBoueeDepart = 1;
//     clef = 'id_bouee';
    
//     await historiqueDAO.genererEtInsererHistoriques(idHistorique, dateEnCours, nombreDeBouee, idBoueeDepart, tableauHistorique, clef, BOUEE, HISTORIQUE_DONNEE_BOUEE, historiqueDAO.genererEtInsererHistoriques, dateFinHistorique);

//     console.log(new Date(), 'end', dateDebutProcess);

// })()

