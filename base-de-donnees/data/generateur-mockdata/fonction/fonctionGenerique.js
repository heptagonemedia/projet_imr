exports.nombreAleatoire = function (min, max) {
    return (Math.random() * (max - min) + min);
}

exports.nombreEntierAleatoire = function (min, max) {
    return (Math.floor(Math.random() * (max - min + 1)) + min);
}

exports.conversionTypeDateVersChaine = function(date) {   
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

exports.genererDateAleatoire = function () {
    var heure = this.formatterElementDate(this.nombreEntierAleatoire(0, 23));
    var minute = this.formatterElementDate(this.nombreEntierAleatoire(0, 59));
    var seconde = this.formatterElementDate(this.nombreEntierAleatoire(0, 59));
    var annee = this.nombreEntierAleatoire(2018, 2019);
    var mois = this.nombreEntierAleatoire(1, 12);
    var jour;

    if ((mois == 2) && this.estBisextile(annee)) {
        jour = this.nombreEntierAleatoire(1, 29);
    } else if ((mois == 2) && !this.estBisextile(annee)) {
        jour = this.nombreEntierAleatoire(1, 28);
    } else if (((mois < 8) && (mois != 2) && (mois % 2 == 0)) || ((mois > 7) && (mois % 2 == 1))) {
        jour = this.nombreEntierAleatoire(1, 30);
    } else if (((mois < 8) && (mois % 2 == 1)) || ((mois > 7) && (mois % 2 == 0))) {
        jour = this.nombreEntierAleatoire(1, 31);
    }

    mois = this.formatterElementDate(mois);
    jour = this.formatterElementDate(jour);

    chaineDate = "" + annee + "-" + mois + "-" + jour + " " + heure + ":" + minute + ":" + seconde;
    
    return new Date(chaineDate);
}

exports.formatterElementDate = function (element) {
    if (element < 10) {
        return ("0" + element);
    }

    return ("" + element);
}