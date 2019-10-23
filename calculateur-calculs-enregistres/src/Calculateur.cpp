#include "Calculateur.h"

Calculateur::Calculateur() {
    initialisation();
}

Calculateur::~Calculateur() {
    // TODO Auto-generated destructor stub
}

void Calculateur::initialisation(){
    this->typeCalcul = "";
    this->moyenne = 0.0;
    this->resultat = 0.0;
    this->valeurTemporaire = 0.0;
};

void Calculateur::setTypeCalcul(std::string typeCalcul){
    this->typeCalcul = typeCalcul;
};

void Calculateur::ajouterAuTableau(float valeurAajouter){
    this->tableauValeursLues.push_back(valeurAajouter);
}

void Calculateur::viderTableau(){
    while(tableauValeursLues.size() > 0){
        tableauValeursLues.pop_back();
    }
}

/**
 * Dans cette fonction, on parse le XML envoyé par le service web
 * pour récupérer toutes les valeurs nécessaires à la réalisation
 * des calculs.
 * On appelle les fonctions qui réalisent les calculs.
 * On recréer le XML qui sera renvoyé au service web pour mettre
 * à jour la base de données avec les nouveaux résultats.
 *
 * @param idCalcul → l'id du calcul à effectuer (peut-être inutile)
 * @return
 */
float Calculateur::effectuerCalcul(int idCalcul) {
    //…
	return 0.0;
}

// Cette fonction permet de réaliser un certain calcul
// envoyé en String
/**
 * Effectue le calcul qui est contenu dans le parametre envoyé
 * sous forme de string.
 *
 * @param nom → le nom du calcul
 * @return
 */
float Calculateur::realiserCalculSelonType(const std::string& nom){
    resultat = moyenne = 0.0; //réinitialiser les valeurs !
    float tailleTableauValeursLues = (float) tableauValeursLues.size(); //plus léger à l'execution.

    if(nom.std::string::compare(MOYENNE)==0) {
        for(float valeurLue : tableauValeursLues) {
            resultat += valeurLue;
        }
        //std::cout << "\n\t[Moyenne] somme des valeurs : " << resultat << "\n";
        resultat /= tailleTableauValeursLues;

    } else if(nom.std::string::compare(ECART_TYPE)==0) {
        for(float valeurLue : tableauValeursLues) {
            moyenne += valeurLue;
        }
        //std::cout << "\n\t[Écart-type] somme des valeurs : " << moyenne << "\n";
        moyenne /= tailleTableauValeursLues;

        for(float valeurLue : tableauValeursLues) {
            resultat += pow((valeurLue-moyenne), 2.0);
        }
        //std::cout << "\n\t[Écart-type] SIGMA de i=1 à n de y(x-i)² : " << resultat << "\n";
        resultat = sqrt((1/tailleTableauValeursLues)*resultat);

    } else if(nom.std::string::compare(MEDIANE)==0) {
        sort(tableauValeursLues.begin(), tableauValeursLues.end());

        //std::cout << "\n\t[Médiane] array trié : ";
        //for(float v : tableauValeursLues) {
        //    std::cout << v << "; ";
        //}
        //std::cout << std::endl;

        if(tableauValeursLues.size()%2!=0) {
            resultat = tableauValeursLues[ceil(tableauValeursLues.size()/2)];
        } else {
            resultat = (tableauValeursLues[(tableauValeursLues.size()/2)-1]+tableauValeursLues[tableauValeursLues.size()/2])/2;
        }
    } else {
        //ERREUR
    }
    return resultat;
}

