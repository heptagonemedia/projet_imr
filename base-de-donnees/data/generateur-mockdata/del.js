const MongoClient = require('mongodb').MongoClient;
const assert = require('assert');

// Connection URL
const url = 'mongodb://localhost:27017';

// Database Name
const dbName = 'imr';

// Create a new MongoClient
const client = new MongoClient(url);

// Use connect method to connect to the Server
client.connect(function (err, client) {
    assert.equal(null, err);
    console.log("Connected correctly to server");

    const db = client.db(dbName);

    const col = db.collection('historique_donnee_bouee');

    // Update multiple documents
    col.deleteMany({date : { "seconde": 11, "minute": 10, "heure": 0, "jour": 1, "mois": 1, "annee": 2018 }}, function (err, r) {
        assert.equal(null, err);
        assert.equal(0, r.deletedCount);
        client.close();
    });

});