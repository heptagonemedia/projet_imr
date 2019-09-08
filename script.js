function detectErrors() {
    resetText();
    errorCalcul();
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

function resetText() {
    $("#text").text("");
    $("#text").append("Verifier votre saisie : <br>");
}




