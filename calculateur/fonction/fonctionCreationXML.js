
// <G><L><P x="test col11" y="test col21" /></L></G>
exports.version = function () {
    return '<? xml version = "1.0" ?>';
}

exports.debutRoot = function () {
    return '<G>';
}

exports.finRoot = function () {
    return '</G>';
}

exports.debutLigne = function () {
    return '<L>';
}

exports.finLigne = function () {
    return '</L>';
}

exports.point = function (x, y) {
    return '<P x="' + x + '" y="' + y + '" />';
}
