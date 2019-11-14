exports.genererEtiquette = function(index) {
    switch (index) {
        case 1:
            return "moyenne";
        case 2:
            return "écart-type";
        case 3:
            return "médiane";    
        default:
            return "Type de clacul invalide";
    }
}