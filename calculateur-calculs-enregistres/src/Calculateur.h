#ifndef CALCULATEUR_H_
#define CALCULATEUR_H_

#include <math.h>
#include <bits/stdc++.h>
#include <string>
#include <vector>

class Calculateur {
private:
    const std::string MOYENNE = "moyenne";
    const std::string ECART_TYPE = "ecart type";
    const std::string MEDIANE = "mediane";

    //long int fkBouee; //clef étrangère de la bouée
    //std::string dateDebutCalcul; //TODO il faudra peut-être créer un type date…
    //std::string dateFinCalcul; //TODO il faudra peut-être créer un type date…
    //float frequence;
    //int fkTypeDonneeMesuree;
    //int fkTypeCalcul;
    //bool calculPrevu;

    std::vector<float> tableauValeursLues;

    std::string typeCalcul;
    float moyenne; //résultat de la moyenne pour le calcul de l'écart-type
    float resultat;
    float valeurTemporaire; //valeur temporaire pour pouvoir intervertir deux valeurs.
public:
    Calculateur();
    virtual ~Calculateur();
    float effectuerCalcul(int);
    float realiserCalculSelonType(const std::string& nom); //est défini une fois pour toutes = const.

    void initialisation();
    void setTypeCalcul(std::string typeCalcul);
    void ajouterAuTableau(float valeurAajouter);
    void viderTableau();
};

#endif /* CALCULATEUR_H_ */
