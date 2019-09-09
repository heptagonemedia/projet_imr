function detecterErreurs() {
    viderTexteAlerte();
    erreurCalcul();
    erreurBouee();
    erreurFrequence();
    erreurIntervalle()
}

function erreurCalcul() {

    let condition = $("#mediane").is(':checked');
    let condition2 = $("#moyenne").is(':checked');
    let condition3 = $("#ecartType").is(':checked');

    if (!condition && !condition2 && !condition3) {
        $("#calculError").css("color","red");
        $("#texteAlerte").append("- Calcul : veuillez choisir un calcul <br>");
        $("#alerte").show();
    }
    else {
        $("#calculError").css("color","black");
    }

}


function erreurBouee() {

    let valeurBouee = $("#bouee").val();

    if (valeurBouee > 75 || allLetter(valeurBouee) || valeurBouee < 0) {
        $("#boueeErreur").css("color","red");
        $("#texteAlerte").append("- Bouee : La valeur ne peux pas contenir de lettres et doit être comprise entre 1 et 75<br>");
        $("#alerte").show();
    }
    else {
        $("#boueeErreur").css("color","black");
    }

}


function erreurFrequence() {

    let valeurAnnee = $("#annee").val();
    let valeurMois = $("#mois").val();
    let valeurJour = $("#jour").val();
    let valeurHeure = $("#heure").val();
    let valeurMinute = $("#minute").val();
    let valeurSeconde = $("#seconde").val();

    verifierAnnee(valeurAnnee);
    verifierMois(valeurMois);
    verifierJour(valeurJour);
    verifierHeure(valeurHeure);
    verifierMinute(valeurMinute);
    verifierSeconde(valeurSeconde);

    if (rienRempli(valeurAnnee, valeurMois, valeurJour, valeurHeure, valeurMinute, valeurSeconde)) {
        $("#frequenceErreur").css("color","red");
        $("#texteAlerte").append("- Frequence : Il faut remplir au moins une valeur<br>");
        $("#alerte").show();
    }
    else {
        $("#frequenceErreur").css("color","black");
    }

}


function erreurIntervalle() {

    let dateDebut = $("#dateDepart").val();
    let dateFin = $("#dateFin").val();

    if(!(differenceDate(dateDebut, dateFin))) {
        $("#intervalleErreur").css("color","red");
        $("#texteAlerte").append("- Intervalle : La date de fin doit être supérieur à la date de début<br>");
        $("#alerte").show();
    }
    else {
        $("#intervalleErreur").css("color","black");
    }

}


function rienRempli(annee, mois, jour, heure, seconde, minute, seconde) {

    if (!annee && !mois && !jour && !heure && !seconde && !minute && !seconde) {
        return true;
    }

    return false;

}


function verifierAnnee(value) {

    if (value < 0 || value > 2) {
        $("#anneeError").css("color", "red");
        $("#texteAlerte").append("- Annee : La valeur doit être comprise entre 0 et 2<br>");
        $("#alerte").show();
        return false;
    }

    $("#anneeError").css("color", "black");

    return true;

}


function verifierMois(value) {

    if (value < 0 || value > 12) {
        $("#moisError").css("color","red");
        $("#texteAlerte").append("- Mois : La valeur doit être comprise entre 0 et 12<br>");
        $("#alerte").show();
        return false;
    }

    $("#moisError").css("color","black");
    
    return true;

}


function verifierJour(value) {

    if (value < 0 || value > 31) {
        $("#jourError").css("color","red");
        $("#texteAlerte").append("- Jour : La valeur doit être comprise entre 0 et 31<br>");
        $("#alerte").show();
        return false;
    }

    $("#jourError").css("color","black");

    return true;

}


function verifierHeure(value) {

    if (value < 0 || value > 23) {
        $("#heureError").css("color","red");
        $("#texteAlerte").append("- Heure : La valeur doit être comprise entre 0 et 23<br>");
        $("#alerte").show();
        return false;
    }

    $("#heureError").css("color","black");

    return true;

}


function verifierMinute(value) {

    if (value < 0 || value > 59) {
        $("#minuteError").css("color","red");
        $("#texteAlerte").append("- Minute : La valeur doit être comprise entre 0 et 59<br>");
        $("#alerte").show();
        return false;
    }

    $("#minuteError").css("color","black");

    return true;

}


function verifierSeconde(value) {
    if (value < 0 || value > 59) {
        $("#secondeError").css("color","red");
        $("#texteAlerte").append("- Seconde : La valeur doit être comprise entre 0 et 59<br>");
        $("#alerte").show();
        return false;
    }

    $("#secondeError").css("color","black");

    return true;

}


function differenceDate(dateDebut, dateFin) {

    var debut = new Date(dateDebut);
    var fin = new Date(dateFin);

    if (debut.getFullYear() > fin.getFullYear()) {
        return false;
    }

    if (debut.getMonth() > fin.getMonth()) {
        return false;
    }

    if (debut.getDay() > fin.getDay()) {
        return false
    }

    return true;

}


function viderTexteAlerte() {

    $("#texteAlerte").text("");
    $("#texteAlerte").append("Verifier votre saisie : <br>");

}

function allLetter(value) {

    var letters = /^[A-Za-z]+$/;
    
    if (value) {
        if(value.value.match(letters)) {
            return true;
        }
        else {
            return false;
        }
    }

    return true;
    
}




