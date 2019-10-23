//============================================================================
// Name        : LocalCalculateurProjetIMR.cpp
// Author      : Théo Cousson
// Version     :
// Copyright   : Your copyright notice
// Description : Hello World in C++, Ansi-style
//============================================================================

#include <iostream>
#include "Calculateur.h"

using namespace std;

int main() {
    cout << "Hello, World!" << std::endl;

    Calculateur calculateur;
    //calculateur.setTypeCalcul("moyenne");

    calculateur.ajouterAuTableau(12.0);
    calculateur.ajouterAuTableau(14.0);
    calculateur.ajouterAuTableau(16.0);

    cout << "Moyenne : " << calculateur.realiserCalculSelonType("moyenne") << endl;
    cout << "Écart type : " << calculateur.realiserCalculSelonType("ecart type") << endl;
    cout << "Médiane : " << calculateur.realiserCalculSelonType("mediane") << endl;

    calculateur.viderTableau();

    calculateur.ajouterAuTableau(12.0);
    calculateur.ajouterAuTableau(13.0);
    calculateur.ajouterAuTableau(14.0);
    calculateur.ajouterAuTableau(15.0);

    cout << "Moyenne : " << calculateur.realiserCalculSelonType("moyenne") << endl;
    cout << "Écart type : " << calculateur.realiserCalculSelonType("ecart type") << endl;
    cout << "Médiane : " << calculateur.realiserCalculSelonType("mediane") << endl;


    return 0;
}
