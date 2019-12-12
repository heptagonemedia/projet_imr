const MongoClient = require('mongodb').MongoClient;

const credentials = require('../../../credentials/CredentialsMongo');

const credentialsMongo = new credentials.Credentials();

exports.url = function () {
    return credentialsMongo.url;
}

exports.dbName = function () {
    return credentialsMongo.dbName;
}

exports.client = function () {
    return new MongoClient(this.url());
}

exports.fermer = function (client) {
    client.close();
}

exports.recupererDernierIdHistorique = async function() {
   
    console.log('recupererDernierIdHistorique()');

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());

    var resultat = await db.collection('historique_donnee_bouee').aggregate([

        {
            $sort: { "id_historique_bouee": -1 }
        },

        {
            $limit: 1
        }

    ]).toArray();

    await this.fermer(client);

    // console.log(resultat.length, resultat);

    return resultat[0]['id_historique_bouee'];
}


exports.t = async function () {

    console.log('recupererDernierIdHistorique()');

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());

    var resultat = await db.collection('historique_donnee_bouee').aggregate([

        {
            $project:
            {
                qtyGte250: { $gte: ["id_historique_bouee", 11685000] },
                _id: 0
            }
        }
        

    ]).toArray();

    await this.fermer(client);

    // console.log(resultat.length, resultat);

    return resultat;
}

exports.insererTableauElement = async function (tableauValeur, collection) {

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());
    await db.collection(collection).insertMany(tableauValeur);

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Inserer dans la base de données');

    this.fermer(client);
    // client.close();

}

exports.insererDocument = async function (element, collection) {

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());
    await db.collection(collection).insertOne(element);

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Inserer dans la base de données');

    this.fermer(client);
    // client.close();

}

exports.selectionnerUnDocument = async function (clef, valeur, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());
    var resultat = await db.collection(collection).findOne(document).toArray();

    this.fermer(client);

    return resultat;

}

exports.selectionnerDocumentsSelonUnParametre = async function (clef, valeur, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());
    var resultat = await db.collection(collection).find(document).toArray();

    this.fermer(client);

    return resultat;

}

exports.selectionnerDocumentsCollection = async function (collection) {

    var client = this.client();

    const c = await client.connect();

    const db = c.db(this.dbName());
    var resultat = await db.collection(collection).find({}).toArray();

    this.fermer(client);

    return resultat;

}

exports.modifierUnDocument = async function (clef, valeur, nouveauDocument, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());

    await db.collection(collection).updateOne(document, { $set: nouveauDocument });

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Document modifié');

    this.fermer(client);

}

exports.modifierDesDocuments = async function (clef, valeur, nouveauDocument, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());

    await db.collection(collection).updateMany(document, { $set: nouveauDocument });

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Documents modifiés');

    this.fermer(client);

}


exports.supprimerUnDocument = async function (clef, valeur, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());

    await db.collection(collection).deleteOne(document);

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Document supprimé');

    this.fermer(client);

}

exports.supprimerDesDocuments = async function (clef, valeur, collection) {

    var client = this.client();
    const document = JSON.parse('{"' + clef + '":' + valeur + '}');

    const c = await client.connect();

    const db = c.db(this.dbName());

    await db.collection(collection).deleteMany(document);

    console.log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Documents supprimés');

    this.fermer(client);

}

