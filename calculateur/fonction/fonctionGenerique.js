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