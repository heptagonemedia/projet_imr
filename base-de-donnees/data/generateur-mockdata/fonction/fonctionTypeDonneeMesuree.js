exports.genererEtiquette = function(index) {
    switch (index) {
        case 1:
            return "salinité";
        case 2:
            return "débit";
        case 3:
            return "température";
        case 4:
            return "longitude";
        case 5:
            return "latitude";
        case 6:
            return "batterie";
        default:
            return ("Donnée " + index);
    }
}

exports.genererUnite = function (index) {
    switch (index) {
        case 1:
            return "ppm";
        case 2:
            return "m³/s";
        case 3:
            return "°C";
        case 4:
            return "NULL";
        case 5:
            return "NULL";
        case 6:
            return "%";
        default:
            return ("NULL");
    }
}