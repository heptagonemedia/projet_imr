var alertRedInput = "#8C1010";
var defaultInput = "rgba(10, 180, 180, 1)";

function priseEnCompteValidation(valeur) {

    var prendreEnCompte = document.getElementById("prendre-compte");
    var erreur = [];

    if (valeur === "compte"){
        erreur.push("Vous devez choisir une valeur");
    }

    if (erreur.length > 0) {
        prendreEnCompte.setCustomValidity(erreur.join("\n"));
        prendreEnCompte.style.borderColor = alertRedInput;
    } else {
        prendreEnCompte.setCustomValidity("");
        prendreEnCompte.style.borderColor = defaultInput;
    }

}

function erreurValidation(valeur, id) {

    var elementErreur = document.getElementById(id);
    var erreur = [];

    if (valeur<-1 || valeur>1) {
        erreur.push("La valeur doit être comprise entre -1 et 1 incluent");
    }

    if (erreur.length > 0) {
        elementErreur.setCustomValidity(erreur.join("\n"));
        elementErreur.style.borderColor = alertRedInput;
    } else {
        elementErreur.setCustomValidity("");
        elementErreur.style.borderColor = defaultInput;
    }

}