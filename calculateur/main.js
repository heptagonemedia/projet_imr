const qs = require('querystring');
const http = require('http');

const calculDAO = require('./donnee/CalculDAO');

var repondeur = async function(requete,reponse) {

    // console.log('methode ' + requete.method);
    // console.log('url ' + requete.url);

	if(requete.method === 'POST') {

        var body = '';
        requete.on('data', function (data) {
            
            // console.log('on.data');

            body += data;

            // 1e6 === 1 * Math.pow(10, 6) === 1 * 1000000 ~~~ 1MB
            // if (body.length > 1e6) { 
            //     // FLOOD ATTACK OR FAULTY CLIENT, NUKE REQUEST
            //     response.writeHead(413, {'Content-Type': 'text/plain'}).end();
            //     request.connection.destroy();
            // }

        });

        requete.on('end', function () {

            // console.log('on.end');

            var POST = qs.parse(body);
            // console.log(body);

            var etiquetteCalcul = POST['nomCalcul'];

            var typeCalcul = POST['calcul'];

            var annee = POST['annee'];
            var mois = POST['mois'];
            var jour = POST['jour'];
            var heure = POST['heure'];
            var minute = POST['minute'];

            var idRegion = POST['region'];

            var dateDebut = POST['dateDeb'];
            var heureDebut = POST['heureDeb'];
            
            var dateFin = POST['dateFin'];
            var heureFin = POST['heureFin'];

            var calculEnregistrer = false;
            if (POST['enregistre']) {
                calculEnregistrer = true;
            }

            var repeter = false;
            var repeterTousLesCombien = 0;
            if (POST['recursif']) {
                repeter = true;
                repeterTousLesCombien = POST['recursivite'];
            }

            calculDAO.ajouterCalcul(etiquetteCalcul, typeCalcul, annee, mois, jour, heure, minute, idRegion, 
                                    dateDebut, heureDebut, dateFin, heureFin, calculEnregistrer, repeter, repeterTousLesCombien);

            
            reponse.statusCode = 200;
            reponse.setHeader('Content-type', 'text/plain');
            reponse.end();

        });

    } else {

        reponse.writeHead(405, {'Content-Type': 'text/plain'});
        reponse.end();

    }
	
}

var serveur = http.createServer(repondeur);
serveur.listen(3000, 'localhost', ()=>{
    console.log('Serveur en ligne.');
});
