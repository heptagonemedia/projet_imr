var alertRedInput = "#8C1010";
var defaultInput = "rgba(10, 180, 180, 1)";


function testerErreur(element, erreur) {

    if (erreur.length > 0) {

        element.setCustomValidity(erreur.join("\n"));
        element.style.borderColor = alertRedInput;

    } else {

        element.setCustomValidity("");
        element.style.borderColor = defaultInput;

    }

}


function testerSiNombre(valeur, id) {

    var element = document.getElementById(id);
    var erreur = [];

    if (((!(/^\d+$/.test(valeur)) && !(/^\d+\.\d+$/.test(valeur))) && (!(/^\-\d+$/).test(valeur) && !(/^\-\d+\.\d+$/).test(valeur)))) {
        erreur.push("La valeur doit être un nombre entier");
    }

    testerErreur(element, erreur);

}


function erreurValidation(valeur, id) {

    var elementErreur = document.getElementById(id);
    var erreur = [];

    if ((!(/^\d+$/.test(valeur)) && !(/^\d+\.\d+$/.test(valeur))) && (!(/^\-\d+$/).test(valeur) && !(/^\-\d+\.\d+$/).test(valeur))) {
        erreur.push("La valeur doit être un nombre entier");
    }

    if (valeur < -1 || valeur > 1) {
        erreur.push("La valeur doit être comprise entre -1 et 1 incluent");
    }

    testerErreur(elementErreur, erreur);

}


function erreurEntreeDecrementationBatterie(valeur) {
    
    var element = document.getElementById("decr-batterie");
    var erreur = [];

    if ( !(/^\d+$/.test(valeur)) && !(/^\d+\.\d+$/.test(valeur)) ) {
        erreur.push("La valeur doit être un nombre entier");
    }

    if (valeur < 0) {
        erreur.push("La valeur doit être positive ou nulle");
    }

    testerErreur(element, erreur);

    

}


function erreurValeurBatterie(valeur) {

    var elementBatterie = document.getElementById("batterie");
    var erreur = [];

    if (valeur <= 0) {
        erreur.push("La valeur doit être strictement positive");
    }

    testerErreur(elementBatterie, erreur);

}


function estDescriptionRemplie(valeur) {

    var elementDescription = document.getElementById("batterie");
    var erreur = [];

    if (valeur === null || valeur === undefined) {
        erreur.push("Vous devez entrer une description");
    }

    testerErreur(elementDescription, erreur);

}