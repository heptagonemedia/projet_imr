function detectErrors() {
    resetText();
    errorCalcul();
    errorBouee();
    errorFrequence();
    errorIntervalle()
}

function errorCalcul() {
    let condition = $("#mediane").is(':checked');
    let condition2 = $("#moyenne").is(':checked');
    let condition3 = $("#ecartType").is(':checked');
    if (!condition && !condition2 && !condition3) {
        $("#calculError").css("color","red");
        $("#text").append("- Calcul : veuillez choisir un calcul <br>");
        $("#alerte").show();
    }
    else {
        $("#calculError").css("color","black");
    }
}

function errorBouee() {
    let valeurBouee = $("#bouee").val();
    if (valeurBouee > 75 || allLetter(valeurBouee) || valeurBouee < 0) {
        $("#boueeError").css("color","red");
        $("#text").append("- Bouee : La valeur ne peux pas contenir de lettres et doit être comprise entre 1 et 75<br>");
        $("#alerte").show();
    }
    else {
        $("#boueeError").css("color","black");
    }
}

function errorFrequence() {
    let valeurAnnee = $("#annee").val();
    let valeurMois = $("#mois").val();
    let valeurJour = $("#jour").val();
    let valeurHeure = $("#heure").val();
    let valeurMinute = $("#minute").val();
    let valeurSeconde = $("#seconde").val();

    checkAnnee(valeurAnnee);
    checkMois(valeurMois);
    checkJour(valeurJour);
    checkHeure(valeurHeure);
    checkMinute(valeurMinute);
    checkSeconde(valeurSeconde);

    if (rienRempli(valeurAnnee, valeurMois, valeurJour, valeurHeure, valeurMinute, valeurSeconde)) {
        $("#frequenceError").css("color","red");
        $("#text").append("- Frequence : Il faut remplir au moins une valeur<br>");
        $("#alerte").show();
    }
    else {
        $("#frequenceError").css("color","black");
    }
}

function errorIntervalle() {
    let dateDebut = $("#dateDepart").val();
    let dateFin = $("#dateFin").val();

    if(!(differenceDate(dateDebut, dateFin))) {
        $("#intervalleError").css("color","red");
        $("#text").append("- Intervalle : La date de fin doit être supérieur à la date de début<br>");
        $("#alerte").show();
    }
    else {
        $("#intervalleError").css("color","black");
    }
}

function checkAnnee(value) {
    if (value < 0 || value > 2) {
        $("#anneeError").css("color","red");
        $("#text").append("- Annee : La valeur doit être comprise entre 0 et 2<br>");
        $("#alerte").show();
        return false;
    }
    $("#anneeError").css("color","black");
    return true;
}

function rienRempli(annee, mois, jour, heure, seconde, minute, seconde) {
    if (!annee && !mois && !jour && !heure && !seconde && !minute && !seconde) {
        return true;
    }
    return false;
}

function checkMois(value) {
    if (value < 0 || value > 12) {
        $("#moisError").css("color","red");
        $("#text").append("- Mois : La valeur doit être comprise entre 0 et 12<br>");
        $("#alerte").show();
        return false;
    }
    $("#moisError").css("color","black");
    return true;
}

function checkJour(value) {
    if (value < 0 || value > 31) {
        $("#jourError").css("color","red");
        $("#text").append("- Jour : La valeur doit être comprise entre 0 et 31<br>");
        $("#alerte").show();
        return false;
    }
    $("#jourError").css("color","black");
    return true;
}

function checkHeure(value) {
    if (value < 0 || value > 23) {
        $("#heureError").css("color","red");
        $("#text").append("- Heure : La valeur doit être comprise entre 0 et 23<br>");
        $("#alerte").show();
        return false;
    }
    $("#heureError").css("color","black");
    return true;
}

function checkMinute(value) {
    if (value < 0 || value > 59) {
        $("#minuteError").css("color","red");
        $("#text").append("- Minute : La valeur doit être comprise entre 0 et 59<br>");
        $("#alerte").show();
        return false;
    }
    $("#minuteError").css("color","black");
    return true;
}

function checkSeconde(value) {
    if (value < 0 || value > 59) {
        $("#secondeError").css("color","red");
        $("#text").append("- Seconde : La valeur doit être comprise entre 0 et 59<br>");
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

function resetText() {
    $("#text").text("");
    $("#text").append("Verifier votre saisie : <br>");
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




