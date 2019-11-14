exports.genererEtiquette = function(index) {
    switch (index) {
        case 1:
            return "Atlantique Nord";
        case 2:
            return "Atlantique Sud";
        case 3:
            return "Pacifique Nord";
        case 4:
            return "Pacifique Sud";
        case 5:
            return "Océan Indien";
        case 6:
            return "Océan Austral";
        case 7:
            return "Océan Arctique";
        case 8:
            return "Mer Méditerranée";
        default:
            return ("Region " + index);
    }
}