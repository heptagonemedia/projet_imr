exports.nombreAleatoire = function (min, max) {
    return (Math.random() * (max - min) + min);
}

exports.nombreEntierAleatoire = function (min, max) {
    return (Math.floor(Math.random() * (max - min + 1)) + min);
}
