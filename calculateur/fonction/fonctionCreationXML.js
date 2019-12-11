
// <G><L><P x="test col11" y="test col21" /></L></G>
exports.version = function() {
    return '<? xml version = "1.0" ?>\n';
}

exports.debutRoot = function() {
    return '<G>\n';
}

exports.finRoot = function () {
    return '</G>\n';
}

exports.debutLigne = function () {
    return '\t<L>\n';
}

exports.finLigne = function () {
    return '\t</L>\n';
}

exports.point = function (x, y) {
    return '\t\t<P x="' + x + '" y="' + y + '" />\n';
}
