function detectErrors() {
    resetText();
    errorCalcul();
    errorBouee();
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
    if (valeurBouee < 75 || allLetter(valeurBouee) || valeurBouee < 0) {
        $("#boueeError").css("color","red");
        $("#text").append("- Bouee : La valeur ne peux pas contenir de lettres et doit être comprise entre 1 et 75<br>");
        $("#alerte").show();
    }
    else {
        $("#boueeError").css("color","black");
    }
}

function resetText() {
    $("#text").text("");
    $("#text").append("Verifier votre saisie : <br>");
}

function allLetter(value)
{
    var letters = /^[A-Za-z]+$/;
    if(value.value.match(letters)) {
        return true;
    }
    else {
        return false;
    }
}




