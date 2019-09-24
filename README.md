# Générateur de scénarios

[TOC]

## Installation

* [Télécharger et installer Elixir et Erlang.](https://elixir-lang.org/install.html)
* Cloner ou télécharger le repository
* Dans l’invite de commande (cmd !) taper ­­­­`mix deps.get`
* Ensuite un simple ´mix run´ devrait lancer la compilation et lancer le programme

## But

Le but de ce “module” est de nous créer différents scénarios que les bouées suivraient. Ainsi, on pourrait, au cours d’une dizaine de minutes, voir les bouées qui suivent les scénarios “défaillance” en “non fiable” sur notre application.

On va pour cela enregistrer les variations sur 600 secondes par rapport à une valeur de base (celle de départ donc) dans notre base de données.

Les scénarios seront séparés dans 4 catégories :

* Les scénarios de base, qui sont au nombre de 10. Ils prennent en compte des erreurs sur uniquement une donnée ou sont des scénarios “normaux”.
* Les scénarios hybrides, qui sont tous considérés comme comportant plusieurs données “corrompues”.
* Les scénarios retardés, qui sont donc des scénarios hybrides ou de base mais dont les erreurs apparaissent x secondes après le début du scénario.
* Les scénarios “normaux” qui ne comportent donc (normalement) aucune erreur.

La proportion de chaque catégorie de scénario sera à définir au lancement du programme, soit écrite en dur quelque part dans le programme ou un fichier de configuration.

Ces scénarios comporteront aussi une région qui définit des standards de données (minimum, maximum, zone géographique, moyenne etc.) pour que nos données restent uniformes et relativement réalistes.

**Il faut en effet prendre en compte que nous ne modélisons pas des données, il s’agit surtout de tester notre application. Nos fonctions “normales” seront donc pour la plupart de simples fonctions sinusoïdales et celles “anormales” soit des fonctions sinusoïdales différentes, soit de simples fonctions affines.**

## Quoi travailler ?

Les fichiers :
* scenario.ex contient les bases de la table dans la DB, il n'a donc pas vraiment vocation à être modifié
* application.ex est notre "main". Il contiendra nos Inputs et Outputs, c'est à dire que c'est ici qu'on chargera nos fichiers de configuration (nombre de scénario, proportions, peut-être limites ?) et de rentrer les scénarios créés dans la base de donnée

Il faut donc maintenant construire les briques de notre application, à savoir les différentes fonctions qui génèrent nos courbes, qu'elles soient correctes ou non, puis nos maillages (c'est à dire les fonctions qui vont "mélanger" le tout pour forger notre scénario).

![Capture d’écran geogebra](https://github.com/heptagonemedia/generateur_scenario/blob/master/Fonction%20de%20base.png)

> * a : amplitude, c’est donc (température_max - température_min)/2
>
> * 2π/600 : c’est un calcul fait à partir de notre période, ici 600 (parce que notre scénario se répète toutes les 600 secondes)
> * k : décalage par rapport à l’axe des y, il est donc égale à température_max - amplitude. Il représente la valeur moyenne que prendront nos températures. Il faudra sûrement réfléchir à l’attribution par bouées pour qu’on obtienne des valeurs légèrement différentes d’une bouée à une autre au sein d’une même région
> * h est le déphasage, c’est le décalage par rapport à l’axe des x. **On ne modifiera pas ce paramètre, qui restera donc à 0.**

