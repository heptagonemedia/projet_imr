const calcul = require('../modele/Calcul');
const date = require('../modele/DateModele');

const baseDeDonnees = require('../donnee/BaseDeDonneesMongo');

const fonctionDate = require('../fonction/fonctionDateModele');
const fonctionGenerique = require('../fonction/fonctionGenerique');
const fonctionXml = require('../fonction/fonctionCreationXML');

module.exports = {
    CalculDAO: function () { },

    async ajouterCalcul(etiquetteCalcul, typeCalcul, annee, mois, jour, heure, minute, idRegion,
        dateDebut, heureDebut, dateFin, heureFin, calculEnregistrer, repeter, repeterTousLesCombien) {

        // console.log();

        var frequenceValeur = fonctionGenerique.convertirDonneeEnMilliseconde('annee', annee, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('mois', mois, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('jour', jour, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('heure', heure, annee, mois) +
            fonctionGenerique.convertirDonneeEnMilliseconde('minute', minute, annee, mois);


        var dateDebutPlage = fonctionDate.convertirDateEtHeureEnDate(dateDebut, heureDebut);
        var dateFinPlage = fonctionDate.convertirDateEtHeureEnDate(dateFin, heureFin);

        // console.log('DateDebutPlage',dateDebutPlage);

        var idCalcul = await this.trouverDernierId();
        idCalcul++;

        var temps = new Date();
        var dateGeneration = new date.DateModele(temps.getSeconds(), temps.getMinutes(), temps.getHours(),
            temps.getDate(), (temps.getMonth() + 1), temps.getFullYear());
        var dateGeneration2 = new date.DateModele(dateGeneration.seconde, dateGeneration.minute, dateGeneration.heure,
            dateGeneration.jour, dateGeneration.mois, dateGeneration.annee);

        // console.log();
        var dateProchaineGeneration = null;

        if (repeter) {

            switch (repeterTousLesCombien) {
                case 1:
                    dateProchaineGeneration = fonctionDate.toString(fonctionDate.augmenterDate1Jour(dateGeneration2));
                    break;
                case 2:
                    dateProchaineGeneration = fonctionDate.toString(fonctionDate.augmenterDate1Semaine(dateGeneration2));
                    break;
                case 3:
                    dateProchaineGeneration = fonctionDate.toString(fonctionDate.augmenterDate1An(dateGeneration2));
                    break;
                default:
                    break;
            }

        }

        dateGeneration = fonctionDate.toString(dateGeneration);

        var calc = await this.calculer(dateDebutPlage, dateFinPlage, typeCalcul, annee, mois, jour, heure, minute, idRegion);

        dateDebutPlage = fonctionDate.toString(dateDebutPlage);
        dateFinPlage = fonctionDate.toString(dateFinPlage);

        await baseDeDonnees.insererDocument(
            /*var c = */new calcul.Calcul(idCalcul, etiquetteCalcul, dateGeneration, dateProchaineGeneration, calculEnregistrer, idRegion,
            typeCalcul, dateDebutPlage, dateFinPlage, frequenceValeur, calc[0], calc[2], calc[1])
            , 'calcul'
        );

        // console.log(c);

    },

    async calculer(dateDebutPlage, dateFinPlage, typeCalcul, annee, mois, jour, heure, minute, idRegion) {

        console.log('Caluculer()');

        var dateDebutIntervalle = new date.DateModele(dateDebutPlage.seconde, dateDebutPlage.minute, dateDebutPlage.heure,
            dateDebutPlage.jour, dateDebutPlage.mois, dateDebutPlage.annee);
        var dateTemp = new date.DateModele(dateDebutPlage.seconde, dateDebutPlage.minute, dateDebutPlage.heure,
            dateDebutPlage.jour, dateDebutPlage.mois, dateDebutPlage.annee);
        var dateTemporaire = fonctionDate.augmenter(dateTemp, annee, mois, jour, heure, minute, 0);

        // var xmlTemp = fonctionXml.version();
        var xmlTemp = fonctionXml.debutRoot();
        xmlTemp += fonctionXml.debutLigne();

        // var xmlDebit = fonctionXml.version();
        var xmlDebit = fonctionXml.debutRoot();
        xmlDebit += fonctionXml.debutLigne();

        // var xmlSalinite = fonctionXml.version();
        var xmlSalinite = fonctionXml.debutRoot();
        xmlSalinite += fonctionXml.debutLigne();

        var compteur = 0;

        var resultat;
        var tableauDates;

        //CONDITION : dateTemporaire <= dateFinPlage
        while (!fonctionDate.dateModeleParametre1EstPlusRecenteQueParametre2(dateTemporaire, dateFinPlage)) {

            // console.log('while');

            compteur++;

            tableauDates = await fonctionDate.trouverToutesLesDatesEntre2Dates(dateDebutIntervalle, dateTemporaire);
            console.log(tableauDates);

            switch (typeCalcul) {
                case 1:

                    resultat = await this.listerMoyenneHistorique(tableauDates, idRegion);

                    xmlTemp += fonctionXml.point(compteur, resultat[0]['moyenne_temperature']);
                    xmlDebit += fonctionXml.point(compteur, resultat[0]['moyenne_debit']);
                    xmlSalinite += fonctionXml.point(compteur, resultat[0]['moyenne_salinite']);

                    break;

                case 2:

                    resultat = await this.listerEcartTypeHistorique(tableauDates, idRegion);

                    xmlTemp += fonctionXml.point(compteur, resultat[0]['ecart_type_temperature']);
                    xmlDebit += fonctionXml.point(compteur, resultat[0]['ecart_type_debit']);
                    xmlSalinite += fonctionXml.point(compteur, resultat[0]['ecart_type_salinite']);

                    break;

                case 3:

                    resultat = await this.listerMedianeHistorique(tableauDates, idRegion);

                    xmlTemp += fonctionXml.point(compteur, resultat[0]);
                    xmlDebit += fonctionXml.point(compteur, resultat[1]);
                    xmlSalinite += fonctionXml.point(compteur, resultat[2]);

                    break;

            }

            // console.log('intervalle',dateDebutIntervalle);
            // console.log('temporaire',dateTemporaire);

            // dateDebutIntervalle = fonctionDate.augmenter(dateTemporaire, annee, mois, jour, heure, minute, 0);
            dateDebutIntervalle = fonctionDate.augmenterDateModeleXSeconde(dateTemporaire, 0);
            var dateTemp2 = new date.DateModele(dateDebutIntervalle.seconde, dateDebutIntervalle.minute, dateDebutIntervalle.heure,
                dateDebutIntervalle.jour, dateDebutIntervalle.mois, dateDebutIntervalle.annee);

            // console.log('t2',dateTemp2);

            dateTemporaire = fonctionDate.augmenter(dateTemp2, annee, mois, jour, heure, minute, 0);

            // console.log('t2',dateTemp2);
            // console.log('intervalle', dateDebutIntervalle);
            // console.log('temporaire', dateTemporaire);

        }

        xmlSalinite += fonctionXml.finLigne();
        xmlSalinite += fonctionXml.finRoot();

        xmlDebit += fonctionXml.finLigne();
        xmlDebit += fonctionXml.finRoot();

        xmlTemp += fonctionXml.finLigne();
        xmlTemp += fonctionXml.finRoot();

        tableauDates = null;
        var retour = [];
        retour.push(xmlTemp);
        retour.push(xmlDebit);
        retour.push(xmlSalinite);

        return retour;

    },

    async listerMoyenneHistorique(tableauDates, idRegion) {

        console.log('listerMoyenne()');

        var client = baseDeDonnees.client();

        const c = await client.connect();

        const db = c.db(baseDeDonnees.dbName());

        var resultat = await db.collection('historique_donnee_bouee').aggregate([

            {
                $match: {
                    $and: [
                        { $or: tableauDates },
                        { "id_region": idRegion }
                    ]
                }
            },

            {
                $group: {
                    _id: "null",
                    moyenne_temperature: { $avg: "$temperature" },
                    moyenne_debit: { $avg: "$debit" },
                    moyenne_salinite: { $avg: "$salinite" }
                }
            }

        ]).toArray();

        await baseDeDonnees.fermer(client);

        // console.log(resultat.length, resultat);

        return resultat;

    },

    async listerMedianeHistorique(tableauDates, idRegion) {

        console.log('listerMediane()');

        var client = baseDeDonnees.client();

        const c = await client.connect();

        const db = c.db(baseDeDonnees.dbName());

        var resultat = [];

        var resultatTemperature = await db.collection('historique_donnee_bouee').aggregate([
            {
                $match: {
                    $and: [
                        { $or: tableauDates },
                        { "id_region": idRegion }
                    ]
                }
            },
            {
                $group: {
                    _id: null,
                    count: {
                        $sum: 1
                    },
                    values: {
                        $push: "$temperature"
                    }
                }
            },
            {
                $unwind: "$values"
            },
            {
                $sort: {
                    values: 1
                }
            },
            {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": {
                        $divide: [
                            "$count",
                            2
                        ]
                    }
                }
            }, {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": 1,
                    "high": {
                        $ceil: "$midpoint"
                    },
                    "low": {
                        $floor: "$midpoint"
                    }
                }
            },
            {
                $group: {
                    _id: null,
                    values: {
                        $push: "$values"
                    },
                    high: {
                        $avg: "$high"
                    },
                    low: {
                        $avg: "$low"
                    }
                }
            }, {
                $project: {
                    "beginValue": {
                        "$arrayElemAt": ["$values", "$high"]
                    },
                    "endValue": {
                        "$arrayElemAt": ["$values", "$low"]
                    }
                }
            }, {
                $project: {
                    "median": {
                        "$avg": ["$beginValue", "$endValue"]
                    }
                }
            }


        ]).toArray();

        resultat.push(resultatTemperature[0]['median']);

        var resultatDebit = await db.collection('historique_donnee_bouee').aggregate([
            {
                $match: {
                    $and: [
                        { $or: tableauDates },
                        { "id_region": idRegion }
                    ]
                }
            },
            {
                $group: {
                    _id: null,
                    count: {
                        $sum: 1
                    },
                    values: {
                        $push: "$debit"
                    }
                }
            },
            {
                $unwind: "$values"
            },
            {
                $sort: {
                    values: 1
                }
            },
            {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": {
                        $divide: [
                            "$count",
                            2
                        ]
                    }
                }
            }, {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": 1,
                    "high": {
                        $ceil: "$midpoint"
                    },
                    "low": {
                        $floor: "$midpoint"
                    }
                }
            },
            {
                $group: {
                    _id: null,
                    values: {
                        $push: "$values"
                    },
                    high: {
                        $avg: "$high"
                    },
                    low: {
                        $avg: "$low"
                    }
                }
            }, {
                $project: {
                    "beginValue": {
                        "$arrayElemAt": ["$values", "$high"]
                    },
                    "endValue": {
                        "$arrayElemAt": ["$values", "$low"]
                    }
                }
            }, {
                $project: {
                    "median": {
                        "$avg": ["$beginValue", "$endValue"]
                    }
                }
            }


        ]).toArray();

        resultat.push(resultatDebit[0]['median']);


        var resultatSalinite = await db.collection('historique_donnee_bouee').aggregate([
            {
                $match: {
                    $and: [
                        { $or: tableauDates },
                        { "id_region": idRegion }
                    ]
                }
            },
            {
                $group: {
                    _id: null,
                    count: {
                        $sum: 1
                    },
                    values: {
                        $push: "$salinite"
                    }
                }
            },
            {
                $unwind: "$values"
            },
            {
                $sort: {
                    values: 1
                }
            },
            {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": {
                        $divide: [
                            "$count",
                            2
                        ]
                    }
                }
            }, {
                $project: {
                    "count": 1,
                    "values": 1,
                    "midpoint": 1,
                    "high": {
                        $ceil: "$midpoint"
                    },
                    "low": {
                        $floor: "$midpoint"
                    }
                }
            },
            {
                $group: {
                    _id: null,
                    values: {
                        $push: "$values"
                    },
                    high: {
                        $avg: "$high"
                    },
                    low: {
                        $avg: "$low"
                    }
                }
            }, {
                $project: {
                    "beginValue": {
                        "$arrayElemAt": ["$values", "$high"]
                    },
                    "endValue": {
                        "$arrayElemAt": ["$values", "$low"]
                    }
                }
            }, {
                $project: {
                    "median": {
                        "$avg": ["$beginValue", "$endValue"]
                    }
                }
            }


        ]).toArray();

        resultat.push(resultatSalinite[0]['median']);


        baseDeDonnees.fermer(client);

        // console.log(resultat);

        return resultat;

    },

    async listerEcartTypeHistorique(tableauDates) {

        console.log('listerEcartType()');

        var client = baseDeDonnees.client();

        const c = await client.connect();

        const db = c.db(baseDeDonnees.dbName());

        var resultat = await db.collection('historique_donnee_bouee').aggregate([
            {
                $match: { $or: tableauDates }
            },
            {
                $group: {
                    _id: "null",
                    ecart_type_temperature: { $stdDevPop: "$temperature" },
                    ecart_type_debit: { $stdDevPop: "$debit" },
                    ecart_type_salinite: { $stdDevPop: "$salinite" }
                }
            }

        ]).toArray();

        baseDeDonnees.fermer(client);

        return resultat;

    },

    async trouverDernierId() {

        // console.log('trouverDernierId()');

        var client = baseDeDonnees.client();

        const c = await client.connect();

        const db = c.db(baseDeDonnees.dbName());

        var resultat = await db.collection('calcul').aggregate([

            {
                $sort: { "id_calcul": -1 }
            },

            {
                $limit: 1
            }

        ]).toArray();

        await baseDeDonnees.fermer(client);

        // console.log(resultat.length, resultat);

        return resultat[0]['id_calcul'];

    }

}