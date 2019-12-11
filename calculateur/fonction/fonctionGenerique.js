exports.nombreAleatoire = function (min, max) {
    return (Math.random() * (max - min) + min);
}

exports.nombreEntierAleatoire = function (min, max) {
    return (Math.floor(Math.random() * (max - min + 1)) + min);
}

exports.conversionTypeDateVersChaine = function (date) {
    return `${
        date.getFullYear().toString().padStart(4, '0')}-${
        (date.getMonth() + 1).toString().padStart(2, '0')}-${
        date.getDate().toString().padStart(2, '0')} ${
        date.getHours().toString().padStart(2, '0')}:${
        date.getMinutes().toString().padStart(2, '0')}:${
        date.getSeconds().toString().padStart(2, '0')}`;
}

exports.estBisextile = function (an) {
    bisextile = false;

    if ((Number.isInteger(an / 4) && !Number.isInteger(an / 100)) || Number.isInteger(an / 400)) {
        bisextile = true;
    }

    return bisextile;
}

exports.formatterElementDate = function (element) {
    if (element < 10) {
        return ("0" + element);
    }

    return ("" + element);
}

exports.convertirDonneeEnMilliseconde = function(typeDonnee, donneeAConvertir, annee, numeroMois) {
    
    switch (typeDonnee) {

        case 'minute':
            
            return donneeAConvertir * 1000 * 60;

        case 'heure':
            
            return donneeAConvertir * 1000 * 60 * 60;

        case 'jour':
            
            return donneeAConvertir * 1000 * 60 * 60 * 24;

        case 'mois':

            if (this.estBisextile(annee) && numeroMois==2) {
                return donneeAConvertir * 1000 * 60 * 60 * 24 * 29;
            } else if (!this.estBisextile(annee) && numeroMois == 2) {
                return donneeAConvertir * 1000 * 60 * 60 * 24 * 28;
            } else if ((((numeroMois < 8) && (numeroMois != 2) && (numeroMois % 2 == 0)) || ((numeroMois > 7) && (numeroMois % 2 == 1)))) {
                return donneeAConvertir * 1000 * 60 * 60 * 24 * 30;
            } else if ((((numeroMois < 8) && (numeroMois % 2 == 1)) || ((numeroMois > 7) && (numeroMois % 2 == 0)))) {
                return donneeAConvertir * 1000 * 60 * 60 * 24 * 31;
            }

        case 'annee':
            var multiple = 365;
            if (this.estBisextile(annee)) {
                multiple = 366;
            }
            return donneeAConvertir * 1000 * 60 * 60 * 24 * multiple;

    }

}