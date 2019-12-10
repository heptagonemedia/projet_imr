var qs = require('querystring');

var http = require('http');

var repondeur = async function(requete,reponse) {

    console.log('methode ' + requete.method);
    console.log('url ' + requete.url);

	if(requete.method === 'POST') {

        var body = '';
        requete.on('data', function (data) {
            
            console.log('on.data');

            body += data;

            // 1e6 === 1 * Math.pow(10, 6) === 1 * 1000000 ~~~ 1MB
            // if (body.length > 1e6) { 
            //     // FLOOD ATTACK OR FAULTY CLIENT, NUKE REQUEST
            //     response.writeHead(413, {'Content-Type': 'text/plain'}).end();
            //     request.connection.destroy();
            // }

        });

        requete.on('end', function () {

            console.log('on.end');

            var POST = qs.parse(body);
            console.log(body);

            var annee = POST['annee'];
            var mois = POST['mois'];
            var jour = POST['jour'];
            var heure = POST['heure'];
            var minute = POST['minute'];
            var seconde = POST['seconde'];

            var dateDebut = POST['dateDeb'];
            var heureDebut = POST['HeureDeb'];
            
            var dateFin = POST['dateFin'];
            var heureFin = POST['HeureFin'];


    
            // donneeDAO.enregistrerDonnee(new donnee.Donnee(instant, temperature, luminosite));


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
serveur.listen(8080, 'localhost', ()=>{console.log('Serveur en ligne.');});