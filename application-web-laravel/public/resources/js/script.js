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
        data: [60, 15],
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
    let verificationBouee = verifierErreurBouee();
    let verificationIntervalle = verifierErreurIntervalle();

    if (verificationFrequence && verificationBouee && verificationIntervalle) {
        $("#texteAlerte").text("");
        $("#divAlerte").hide();
        $('#formulaire').submit();
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

var ctx = document.getElementById('camembertBouees').getContext('2d');
data = {
    datasets: [{
        data: [60, 15],
        backgroundColor: ["#07CA38", "#EF0000"]
    }],

    labels: [
        'Conformes',
        'Non conformes'
    ]
};
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data
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

//fonction qui affiche le message d'erreur pour le champ bouée
function verifierErreurRegion() {

    let valeurBouee = $("#region").value();

    if (valeurBouee == "") {
        $("#HelperBouee").show();
        return false;
    }
    else {
        $("#HelperBouee").css('display', 'none');
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
    var url = document.location.href;
    if (url.indexOf('bouee') == -1) {
        var listeCoords = new Array();
        listeCoords.push(49.0523948); listeCoords.push(-68.283337);
        for (var i = 2; i < 15; i += 2) {
            listeCoords.push(listeCoords[i - 2] + 0.1);
            listeCoords.push(listeCoords[i - 1] + 0.33);
        }
        for (var i = 0; i < 29; i += 2) {
            L.marker([listeCoords[i], listeCoords[i + 1]]).addTo(macarte);
            console.log(listeCoords[i] + ',' + listeCoords[i + 1])

        }
    } else {
        macarte.setView([49.0523948, -68.283337], 10);
        L.marker([49.0523948, -68.283337]).addTo(macarte);
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
