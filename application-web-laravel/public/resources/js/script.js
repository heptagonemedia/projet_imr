initFormulaire();
$('.dropdown-trigger').dropdown();
$('select').formSelect();
$(document).ready(function () {
    $('.fixed-action-btn').floatingActionButton();
});

$(document).ready(function () {
    $('.collapsible').collapsible();
});

$(document).ready(function () {
    $('.sidenav').sidenav();
});

function ouvrirSidenav(){
    $("#slide-out").show();
    console.log("ouverture")
}
function fermerSidenav(){
    $("#slide-out").hide();
    console.log("fermeture")
}

var ctx = document.getElementById('camembertBouees').getContext('2d');
data = {
    datasets: [{
        data: [document.getElementById("conformes").innerHTML, document.getElementById("non-conformes").innerHTML],
        backgroundColor: ["#07CA38", "#EF0000"]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Conformes',
        'Non conformes'
    ]
};
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data
});


function detecterErreurs() {
    //A ne pas mettre directement dans la condition du if
    let verificationFrequence = verifierErreurFrequence();
    let verificationBouee = verifierErreurRegion();
    let verificationIntervalle = verifierErreurIntervalle();
    let verificationRecursivite = verifierErreurRecursivite();

    if (verificationFrequence  && verificationIntervalle && verificationBouee) {
        $("#texteAlerte").text("");
        $("#divAlerte").hide();
        // $('#formulaire').submit();
    }

}

function retourFormulaire() {
    var url = document.location.href;
    // window.location.href = "formulaireRecherche.php"+ url.substr(url.indexOf('?'));
}

function enregistrer() {
    $('.modal').modal();
}
function enregistrerForm() {
    $("#formulaireType").submit();

}

$(document).ready(function () {
    $('.tooltipped').tooltip();
});



//remplit les champs du formulaire avec les données de l'url si il y en a
function initFormulaire() {
    donnees = window.location.href.substr(window.location.href.indexOf('?') + 1);
    var tabDonnees = donnees.split('&');
    console.log(tabDonnees);
    var nom;
    var valeur;
    for (i = 0; i < tabDonnees.length - 1; i++) {
        var nom = tabDonnees[i].substr(0, tabDonnees[i].indexOf("="));
        var valeur = tabDonnees[i].substr(tabDonnees[i].indexOf("=") + 1);
        if (nom == 'calcul') {
            $("#" + valeur).attr('checked', true);
        } else {
            console.log(nom + ' ==> ' + valeur);
            $('#' + nom).val(valeur);
        }
    }
}

//fonction qui affiche le message d'erreur pour le champ region
function verifierErreurRegion() {

    let valeurBouee = $("#region").val();

    if (valeurBouee == null) {
        $("#HelperRegion").show();
        return false;
    }else {
        $("#HelperRegion").hide();
        return true;
    }
}


function verifierErreurRecursivite() {
    if ($('#recursif').is(":checked")){
        if ($("#frequence-recursivite").val() == null){

            $("#HelperRecursivite").show();
            return false;

        }else{

            $("#HelperRecursivite").hide();
            return true;

        }
    }else{
        $("#HelperRecursivite").hide();
        return true;
    }
}

//fonction qui affiche le message d'erreur pour le champ fréquence
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

        var erreur = "";

        if (verificationAnnee && verificationMois && verificationJour && verificationHeure && verificationMinute) {
            $("#frequence").css('display', 'none');
            return true;
        } else {
            if (!verificationAnnee) {
                erreur = "Annee, ";
            }
            if (!verificationMois) {
                erreur = erreur + "Mois, "
            }
            if (!verificationJour) {
                erreur = erreur + "Jour, "
            }
            if (!verificationHeure) {
                erreur = erreur + "Heure, "
            }
            if (!verificationMinute) {
                erreur = erreur + "Minute, "
            }
            $("#frequence").html("<label id=\"alerte\"> " + erreur + "Il faut entrer un entier non négatif cohérent</label>");
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
    if (valeur < 0 || valeur > 12) {
        return false;
    }
    return true;
}

function verifierJour(valeur) {
    if (valeur < 0 || valeur > 31) {
        return false;
    }
    return true;
}

function verifierHeure(valeur) {
    if (valeur < 0 || valeur > 24) {
        return false;
    }
    return true;
}

function verifierMinute(valeur) {
    if (valeur < 0 || valeur > 60) {
        return false;
    }
    return true;
}

//fonction qui affiche le message d'erreur pour le champ intervalle
function verifierErreurIntervalle() {

    let dateDebut = $("#dateDeb").val();
    var jour = dateDebut[0] + dateDebut[1];
    jour++;
    var mois = dateDebut[3] + dateDebut[4];
    var annee = dateDebut[6] + dateDebut[7] + dateDebut[8] + dateDebut[9];
    var dateEntiere = annee + '-' + mois + '-' + jour;
    var debut = new Date(dateEntiere);

    let dateFin = $("#dateFin").val();
    jour = dateFin[0] + dateFin[1];
    jour++;
    mois = dateFin[3] + dateFin[4];
    annee = dateFin[6] + dateFin[7] + dateFin[8] + dateFin[9];
    dateEntiere = annee + '-' + mois + '-' + jour;
    var fin = new Date(dateEntiere);

    let heureDebut = $("#heureDeb").val();
    let heureFin = $("#heureFin").val();

    if (!dateFin || !dateDebut || !heureFin || !heureDebut) {
        $("#heureTest").show();
        return false;
    }

    var validationDates = verifierDatesintervalle(debut, fin);
    var validationHeures = verifierHeuresIntervalle(heureDebut, heureFin, debut, fin);

    if (!validationDates || !validationHeures) {
        $("#heureTest").show();
        return false;
    }
    $("#heureTest").css('display', 'none');
    return true;
}


function verifierDatesintervalle(debut, fin) {

    if (debut.getFullYear() > fin.getFullYear() || (debut.getMonth() > fin.getMonth() && debut.getFullYear() == fin.getFullYear()) ||
        (debut.getDate() > fin.getDate() && debut.getMonth() == fin.getMonth() && debut.getFullYear() == fin.getFullYear())) {

        $("#heureTest").show();

        return false;
    }
    return true;
}

function verifierHeuresIntervalle(heureDebut, heureFin, dateDebut, dateFin) {
    if ((heureDebut > heureFin || heureDebut == heureFin) && dateDebut.getFullYear() == dateFin.getFullYear() &&
        dateDebut.getMonth() == dateFin.getMonth() && dateDebut.getDate() == dateFin.getDate()) {

        $("#heureTest").show();
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
    macarte = L.map('map', { zoomControl: false, attributionControl: false }).setView([49.210186, -67.433494], 8);    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);

    var coordonnees = document.getElementById("coordonnees").innerHTML;
    listeCoordonnees = coordonnees.split("&amp;");
    macarte.setView([listeCoordonnees[1], listeCoordonnees[0]], 2);
    for (let i = 0; i < coordonnees.length; i+=12) {
        L.marker([listeCoordonnees[i+1], listeCoordonnees[i]]).addTo(macarte);
    }

}
window.onload = function () {
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();
};

function agrandirCarte(_element) {
    var monElement = _element || document.documentElement;
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


$(document).ready(function () {
    $('.datepicker').datepicker({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 2, // Creates a dropdown of 15 years to control year
        labelMonthNext: 'Mois suivant',
        labelMonthPrev: 'Mois précédent',
        labelMonthSelect: 'Selectionner le mois',
        labelYearSelect: 'Selectionner une année',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        today: 'Aujourd\'hui',
        clear: 'Réinitialiser',
        close: 'Fermer',
        format: 'dd/mm/yyyy'
    });
    $('.timepicker').timepicker({
        twelveHour: false
    });
});

function afficherRecursivite(){
    if($("#recursif").is(":checked")){
        document.getElementById("ligne-select").innerHTML = document.getElementById("select-recursivite").innerHTML;
        $(document).ready(function(){
            $('select').formSelect();
        });
    }else{
        document.getElementById("ligne-select").innerHTML = " ";
    }
}

function afficherLiens(){
    var elem = document.querySelectorAll('.fixed-action-btn');
    var instance = M.FloatingActionButton.getInstance(elem);
    instance.open();
    console.log("liens")
}

function regionCarte(){
    console.log($("#choix_region").val());
     document.location.href = document.location.href.substring(0, document.location.href.indexOf("accueil")) + "accueil/" + $("#choix_region").val();
}
