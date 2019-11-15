//######################################### Modeles
var date = require('./modele/DateModele');
var historique = require('./modele/HistoriqueTransition');

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

//######################################### Variables
var cheminMockdata = "../mockdata/";

var nomFichierRegion = "region.csv";
var nomFichierBouee = "bouee.csv";
var nomFichierTypeDonneeMesuree = "type_donnee_mesuree.csv";
var nomFichierTypeCalcul = "type_calcul.csv";
var nomFichierCalcul = "calcul.csv";
var nomFichierResultat = "resultat.csv";
var nomFichierHistorique = "historique_donnee_bouees.csv";

var nombreDeRegion = 8;
var nombreDeBouee = 75000
var nombreDeDonneeMesuree = 6;
var nombreDeTypeDeCalcul = 3;
var nombreDeCalcul = 10;
var nombreDeResultatParCalcul = 3;
var nombreDeSecondeParRepetitionDonneesHistorique = 30;

var dateDebutHistorique = new date.DateModele(0,0,0,1,1,2018);
var dateFinHistorique = new date.DateModele(0,1,0,1,1,2018);

var contenu = "";

contenu = "";
//######################################### Génération des Régions

// for (let index = 1; index <= nombreDeRegion; index++) {
//     contenu += "" + index + "," + fonctionRegion.genererEtiquette(index) + "\n";
// }

// fs.appendFile((''+cheminMockdata+'region.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('region.csv générer');
// });

// contenu = "";
//######################################### Génération des Bouées
// for (let index = 1; index <= nombreDeBouee; index++) {
//     region = fonctionGenerique.nombreEntierAleatoire(1,8);
//     contenu += "" + index + "," + fonctionBouee.genererEtiquette(index) + "," + fonctionBouee.genererLongitude(region) + "," +
//                 fonctionBouee.genererLatitude(region) + "," + region + "\n";
// }

// fs.appendFile((''+cheminMockdata+'bouee.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('bouee.csv générer');
// });

// contenu = "";
// //######################################### Génération des Types de données mesurées
// for (let index = 1; index <= nombreDeDonneeMesuree; index++) {
//     contenu += "" + index + "," + fonctionTypeDonneeMesuree.genererEtiquette(index) + "," +
//         fonctionTypeDonneeMesuree.genererUnite(index) + "\n";
// }

// fs.appendFile(('' + cheminMockdata + 'type_donnee_mesuree.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('type_donnee_mesuree.csv générer');
// });

// contenu = "";
// //######################################### Génération des Types de calcul
// for (let index = 1; index <= nombreDeTypeDeCalcul; index++) {
//     contenu += "" + index + "," + fonctionTypeCalcul.genererEtiquette(index) + "\n";
// }

// fs.appendFile(('' + cheminMockdata + 'type_calcul.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('type_calcul.csv générer');
// });


// contenu = "";
// //######################################### Génération des Calculs
// // A voir changement bouée => région
// for (let index = 1; index <= nombreDeCalcul; index++) {

//     typeCalcul = fonctionCalcul.genererIdTypeCalcul();
//     idBouee = fonctionCalcul.genererIdBouee();
//     frequenceValeur = fonctionCalcul.genererFrequenceValeur();

//     dateGeneration = fonctionGenerique.genererDateAleatoire();
//     dateProchaineGeneration = fonctionCalcul.genererDateProchaineGeneration(dateGeneration);

//     dateDebutPlage = fonctionCalcul.genererDateDebutPlage(dateGeneration);
//     dateFinPlage = fonctionCalcul.genererDateFinPlage(dateDebutPlage, frequenceValeur, dateGeneration);

//     contenu += "" + index + "," +
//         fonctionCalcul.genererEtiquette(typeCalcul, idBouee, frequenceValeur) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateGeneration) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateProchaineGeneration) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateDebutPlage) + "," +
//         fonctionGenerique.conversionTypeDateVersChaine(dateFinPlage) + "," +
//         frequenceValeur + "," +
//         fonctionCalcul.genererEnregistre() + "," +
//         idBouee + "," +
//         typeCalcul + "\n";   

// }

// fs.appendFile(('' + cheminMockdata + 'calcul_t.csv'), contenu, (err) => {
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

// fs.appendFile(('' + cheminMockdata + 'resultat.csv'), contenu, (err) => {
//     if (err) throw err;
//     console.log('resultat.csv générer');
// });

var test = async function (nombreDeRepetition, dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, cheminFichier) {
    var dernierHist = dernierHistorique;

    do {
        console.log(nombreDeRepetition);
        dernierHist = await fonctionHistorique.genererXSecondes(dernierHist, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, cheminFichier);
        // dernierHistorique = test2(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
        // dernierHistorique = test(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
        // dernierHistorique = fonctionHistorique.genererXSecondes(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
        nombreDeRepetition--;
    } while (nombreDeRepetition > 0);
}

// var test2 = async function (dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, cheminFichier) {
//     var t = await test(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
//     return t;
// }

//######################################### Génération de l'historique des données des bouées
var nombreDeRepetition = fonctionHistorique.calculerNombreDeRepetition(dateDebutHistorique, dateFinHistorique, nombreDeSecondeParRepetitionDonneesHistorique);
var idHistorique = 0;
var dateEnCours = dateDebutHistorique;

dernierHistorique = new historique.HistoriqueTransition(idHistorique, dateEnCours);
test(nombreDeRepetition, dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));

// do {
//     console.log(nombreDeRepetition);
//     // dernierHistorique = test2(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
//     // dernierHistorique = fonctionHistorique.genererXSecondes(dernierHistorique, nombreDeBouee, nombreDeSecondeParRepetitionDonneesHistorique, ('' + cheminMockdata + 'historique_donnee_bouees_test.csv'));
//     nombreDeRepetition-- ;
// } while (nombreDeRepetition > 0);
