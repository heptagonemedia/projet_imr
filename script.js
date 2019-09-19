initFormulaire();
$('.dropdown-trigger').dropdown();
function detecterErreurs(type) {

    initialiserTexteAlerte();


    //A ne pas mettre directement dans la condition du if
    let verificationCalcul = verifierErreurCalcul();
    let verificationFrequence = verifierErreurFrequence();
    let verificationBouee = verifierErreurBouee();
    let verificationIntervalle = verifierErreurIntervalle();

    if (verificationCalcul && verificationFrequence && verificationBouee && verificationIntervalle) {
        $("#texteAlerte").text("");
        $("#divAlerte").hide();
            //apres la detection d erreurs
            var annee = $('#annee').val();
            var mois = $('#mois').val();
            var jour = $('#jour').val();
            var heure = $('#heure').val();
            var minute = $('#minute').val();
            var seconde = $('#seconde').val();
            var calcul = $('input[name=calcul]:checked').val();
            var bouee = $('#bouee').val();
            var dateDep = $('#dateDep').val();
            var heureDep = $('#heureDep').val();
            var dateFin = $('#dateFin').val();
            var heureFin = $('#heureFin').val();
            var lien = "resultats.php?";
            lien += 'annee='+annee;
            lien += '&mois='+mois;
            lien += '&jour='+jour;
            lien += '&heure='+heure;
            lien += '&minute='+minute;
            lien += '&seconde='+seconde;
            lien += '&calcul='+calcul;
            lien += '&bouee='+bouee;
            lien += '&dateDep='+dateDep;
            lien += '&heureDep='+heureDep;
            lien += '&dateFin='+dateFin;
            lien += '&heureFin='+heureFin;
            lien += '&type='+type;
            console.log(lien);
            window.location.href = lien;
    }

}

function fermer(){
    $('#message').remove();
}

function retourFormulaire(){
    var url = document.location.href;
    window.location.href = "formulaireRecherche.php"+ url.substr(url.indexOf('?'));
}

function enregistrer(){
    $('.modal').modal();
}

$(document).ready(function(){
    $('.tooltipped').tooltip();
});



//remplit les champs du formulaire avec les données de l'url si il y en a
function initFormulaire(){
    donnees = window.location.href.substr(window.location.href.indexOf('?')+1);
    var tabDonnees = donnees.split('&');
    console.log(tabDonnees);
    var nom;
    var valeur;
    for(i=0; i<tabDonnees.length-1;i++){
        var nom = tabDonnees[i].substr(0,tabDonnees[i].indexOf("="));
        var valeur = tabDonnees[i].substr(tabDonnees[i].indexOf("=")+1);
        if(nom == 'calcul'){
            $("#"+valeur).attr('checked', true);
        }else{
            console.log(nom+ ' ==> '+valeur);
            $('#'+nom).val(valeur);
        }
    }
}

function initialiserTexteAlerte() {

    $("#texteAlerte").text("");
    $("#texteAlerte").append("<h4>Verifier votre saisie : </h4>");
    $("#texteAlerte").append("<ul>");

}


function verifierErreurCalcul() {

    let mediane = $("#mediane").is(':checked');
    let moyenne = $("#moyenne").is(':checked');
    let ecartType = $("#ecartType").is(':checked');

    if (!mediane && !moyenne && !ecartType) {
        $("#calculErreur").css("color","red");
        $("#texteAlerte").append("<li> Calcul : veuillez choisir un calcul </li>");
        $("#divAlerte").show();

        return false;
    }
    else {
        $("#calculErreur").css("color","black");
        
        return true;
    }

}


function verifierErreurBouee() {

    let valeurBouee = $("#champBouee").val();

    if (valeurBouee > 75 || valeurBouee < 1 || isNaN(valeurBouee)) {
        $("#bouee").show();
        return false;
    }
    else {
        $("#bouee").css('display','none');
        return true;
    }

}


function verifierErreurFrequence() {

    let valeurAnnee = $("#annee").val();
    let valeurMois = $("#mois").val();
    let valeurJour = $("#jour").val();
    let valeurHeure = $("#heure").val();
    let valeurMinute = $("#minute").val();

    let conditionToutesNonVides = !valeurAnnee && !valeurMois && !valeurJour && !valeurHeure && !valeurMinute;
    let conditionToutesNonNulles = valeurAnnee == 0 && valeurMois == 0 && valeurJour == 0 && valeurHeure == 0 && valeurMinute == 0;
    let conditionToutesNumeriques = isNaN(valeurAnnee) || isNaN(valeurMois) || isNaN(valeurJour) || isNaN(valeurHeure) || isNaN(valeurMinute);

    if (conditionToutesNonVides || conditionToutesNonNulles || conditionToutesNumeriques) {
        $("#frequence").show();
        return false;
    }
    else {

        //A ne pas mettre directement dans la condition du if
        let verificationAnnee = verifierAnnee(valeurAnnee);
        let verificationMois = verifierMois(valeurMois);
        let verificationJour = verifierJour(valeurJour);
        let verificationHeure = verifierHeure(valeurHeure);
        let verificationMinute = verifierMinute(valeurMinute);

        console.log(verificationMois);
        if (verificationAnnee && verificationMois && verificationJour && verificationHeure && verificationMinute) {
            $("#frequence").css('display','none');
            return true;
        }else {
            $("#frequence").show();
            return false;
        }        

        
    }

}


function verifierAnnee(valeur) {

    if (valeur < 0 || valeur > 2) {
        return false;
    }

    return true;

}


function verifierMois(valeur) {

    if (valeur < 0 || valeur > 2) {
        return false;
    }
    
    return true;

}

//!valeur.match(/^-?[0-9]+$/)
function verifierJour(valeur) {

    if (valeur < 0 || valeur > 31) {
        return false;
    }

    return true;

}


function verifierHeure(valeur) {

    if (valeur < 0 || valeur > 23) {
        return false;
    }

    return true;

}


function verifierMinute(valeur) {

    if (valeur < 0 || valeur > 59) {
        return false;
    }

    return true;

}

function verifierErreurIntervalle() {

    let dateDebut = $("#dateDebut").val();
    let dateFin = $("#dateFin").val();
    let heureDebut = $("#heureDebut").val();
    let heureFin = $("#heureFin").val();

    var debut = new Date(dateDebut);
    var fin = new Date(dateFin);

    if (!dateFin || !dateDebut || !heureFin || !heureDebut) {
        console.log(!dateDebut);
        $("#heureTest").show();
        return false;
    }

    var validationDates = verifierDatesintervalle(debut, fin);
    var validationHeures = verifierHeuresIntervalle(heureDebut, heureFin,debut,fin);

    if(!validationDates || !validationHeures) {
        $("#heureTest").show();
        return false;
    }


    $("#heureTest").css('display','none');
    return true;

}


function verifierDatesintervalle(debut,fin) {
    
    if (debut.getFullYear() > fin.getFullYear() || (debut.getMonth() > fin.getMonth() && debut.getFullYear()==fin.getFullYear()) ||
        (debut.getDay() > fin.getDay() && debut.getMonth() == fin.getMonth() && debut.getFullYear() == fin.getFullYear())) {
        
        $("#intervalleErreur").css("color", "red");
        $("#texteAlerte").append("<li> Intervalle : La date de fin doit être supérieur ou égale à la date de début</li>");
        $("#divAlerte").show();        
        
        return false;
    }


    return true;
}

function verifierHeuresIntervalle(heureDebut,heureFin,dateDebut,dateFin) {
    if ((heureDebut > heureFin || heureDebut == heureFin) && dateDebut.getFullYear()==dateFin.getFullYear() &&
        dateDebut.getMonth() == dateFin.getMonth() && dateDebut.getDay() == dateFin.getDay()) {

        $("#intervalleErreur").css("color", "red");
        $("#texteAlerte").append("<li> Intervalle : L'heure de fin doit être strictement supérieur à l'heure de début</li>");
        $("#divAlerte").show();

        return false;
    }

    return true;
}

// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 48.852969;
var lon = -67.533555;
var macarte = null;
// Fonction d'initialisation de la carte
function initMap() {
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map', {zoomControl : false, attributionControl : false}).setView([49.210186, -67.433494], 8);    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);
    var url = document.location.href;
    if(url.indexOf('bouee')==-1){
        var listeCoords = new Array();
        listeCoords.push(49.0523948);listeCoords.push(-68.283337);
        for(var i=2;i<15;i+=2){
            listeCoords.push(listeCoords[i-2]+0.1);
            listeCoords.push(listeCoords[i-1 ]+0.33);
        }
        for(var i=0;i<29;i+=2){
            L.marker([listeCoords[i], listeCoords[i+1]]).addTo(macarte);
            console.log(listeCoords[i]+','+listeCoords[i+1])

        }
    }else{
        macarte.setView([49.0523948, -68.283337], 10);
        L.marker([49.0523948, -68.283337]).addTo(macarte);
    }

}
 window.onload = function(){
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
initMap();


 };

 function agrandirCarte(_element) {
     var monElement = _element||document.documentElement;
     if (document.mozFullScreenEnabled) {
         if (!document.mozFullScreenElement) {
             monElement.mozRequestFullScreen();
         } else {
             document.mozCancelFullScreen();
         }
     }
     if (document.fullscreenElement) {
         if (!document.fullscreenElement) {
             monElement.requestFullscreen();
         } else {
             document.exitFullscreen();
         }
     }
     if (document.webkitFullscreenEnabled) {
         if (!document.webkitFullscreenElement) {
             monElement.webkitRequestFullscreen();
         } else {
             document.webkitExitFullscreen();
         }
     }


 }
$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
});



$(document).ready(function(){
    $('.datepicker').datepicker({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 2, // Creates a dropdown of 15 years to control year
        labelMonthNext: 'Mois suivant',
        labelMonthPrev: 'Mois précédent',
        labelMonthSelect: 'Selectionner le mois',
        labelYearSelect: 'Selectionner une année',
        monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
        monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
        weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
        weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
        weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
        today: 'Aujourd\'hui',
        clear: 'Réinitialiser',
        close: 'Fermer',
        format: 'dd/mm/yyyy'
    });
    $('.timepicker').timepicker({
        twelveHour: false
    });
});