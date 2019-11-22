//######################################### Modeles
var date = require('./modele/DateModele');
var historique = require('./modele/Historique');
var bouee = require('./modele/Bouee');
var region = require('./modele/Region');

//######################################### Donnee
var historiqueDAO = require('./donnee/HistoriqueDAO');
var bdd = require('./donnee/BaseDeDonnees');

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


//######################################### Variables / Constantes
const cheminMockdata = "../mockdata/";

const NOM_FICHIER_REGION = "region.csv";
const NOM_FICHIER_BOUEE = "bouee.csv";
const NOM_FICHIER_TYPE_DONNEE_MESUREE = "type_donnee_mesuree.csv";
const NOM_FICHIER_TYPE_CALCUL = "type_calcul.csv";
const NOM_FICHIER_CALCUL = "calcul.csv";
const NOM_FICHIER_RESULTAT = "resultat.csv";

const REGION = 'region';
const BOUEE = 'bouee';
const HISTORIQUE_DONNEE_BOUEE = 'historique_donnee_bouee';

var nombreDeRegion = 8;
var nombreDeBouee = 7500;
var nombreDeDonneeMesuree = 6;
var nombreDeTypeDeCalcul = 3;
var nombreDeCalcul = 10;
var nombreDeResultatParCalcul = 3;

var dateDebutHistorique = new date.DateModele(0,0,0,1,11,2019);
var dateFinHistorique = new date.DateModele(0,0,0,30,11,2019);

var contenu = [];

contenu = [];
//######################################### Génération des Régions

for (let index = 1; index <= nombreDeRegion; index++) {
    contenu.push(new region.Region(index, fonctionRegion.genererEtiquette(index)));
}

bdd.insererTableau(contenu, REGION);


// contenu = [];
//######################################### Génération des Bouées
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

// contenu = "";
// //######################################### Génération des Types de calcul
// for (let index = 1; index <= nombreDeTypeDeCalcul; index++) {
//     contenu += "" + index + "," + fonctionTypeCalcul.genererEtiquette(index) + "\n";
// }

// fs.appendFile(('' + cheminMockdata + NOM_FICHIER_TYPE_CALCUL), contenu, (err) => {
//     if (err) throw err;
//     console.log('type_calcul.csv générer');
// });


// contenu = "";
// //######################################### Génération des Calculs
// // A voir changement bouée => région
// for (let index = 1; index <= nombreDeCalcul; index++) {

//     typeCalcul = fonctionCalcul.genererIdTypeCalcul();
//     // idBouee = fonctionCalcul.genererIdBouee();
//     idRegion = fonctionCalcul.genererIdRegion();
//     frequenceValeur = fonctionCalcul.genererFrequenceValeur();

//     dateGeneration = fonctionGenerique.genererDateAleatoire();
//     dateProchaineGeneration = fonctionCalcul.genererDateProchaineGeneration(dateGeneration);

//     dateDebutPlage = fonctionCalcul.genererDateDebutPlage(dateGeneration);
//     dateFinPlage = fonctionCalcul.genererDateFinPlage(dateDebutPlage, frequenceValeur, dateGeneration);

//     contenu += "" + index + "," +
//         fonctionCalcul.genererEtiquette(typeCalcul, idRegion, frequenceValeur) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateGeneration) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateProchaineGeneration) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateDebutPlage) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateFinPlage) + "," +
//         frequenceValeur + "," +
//         fonctionCalcul.genererEnregistre() + "," +
//         idRegion + "," +
//         typeCalcul + "\n";   

// }

// fs.appendFile(('' + cheminMockdata + NOM_FICHIER_CALCUL), contenu, (err) => {
//     if (err) throw err;
//     console.log('calcul.csv générer');
// });

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


//######################################### Génération de l'historique des données des bouées directement dans la base de données
// var idHistorique = 0;
// var dateEnCours = dateDebutHistorique;
// var tableauHistorique;

// var idPreparedStatement = 0;


// ( async function t() {

//     dateDebutProcess = new Date();
//     console.log(new Date());

//     tableauHistorique = [];
    
//     while (!fonctionDateModele.dateModeleEgales(dateEnCours, dateFinHistorique)) {

//         tableauHistorique = [];

//         for (let idBouee = 1; idBouee <= nombreDeBouee; idBouee++) {
//             idHistorique++;
//             idRegion
//             tableauHistorique.push(new historique.Historique(idHistorique, idBouee, fonctionDateModele.toString(dateEnCours),));
//         }

//         // console.log('avant_', idPreparedStatement);
//         // await historiqueDAO.preparerEnregistrementHistorique(tableauHistorique, idPreparedStatement);
//         // console.log('apres_', idPreparedStatement);

//         //TODO: idPreparedStatement => mettre dans le retour de preparerEnregistrementHistorique
//         // idPreparedStatement += 11;

//         // tableauHistorique = null;

//         await bdd.insererTableau(tableauHistorique, HISTORIQUE_DONNEE_BOUEE);

//         dateEnCours = fonctionDateModele.augmenterDateModeleXSeconde(dateEnCours, 60);

//     }

//     console.log('done !', new Date());
    
// })()