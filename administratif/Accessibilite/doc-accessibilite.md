# Accessibilité

## 	Que faire pour rendre un site accessible :

### 		1 :  Le site doit être Keyboard Friendly 

​		Il doit être possible de naviguer sur les interfaces sans utiliser la souris. Par exemple : pouvoir accéder aux principaux éléments de navigation en appuyant sur tab. __*Se renseigner sur Keyboard focus*__

*référence* : https://webaim.org/techniques/hypertext/

### 		2 : Le contenu doit être accessible

​		Dans le sens ou le contenu doit être facilement visible et la navigation claire en évitant le contenu dynamique, sauf si il n'y a pas besoins de recharger la page pour l'afficher.

### 		3 : Mettre des alt pour toutes les images

### 		4 : Bien choisir les couleurs 

​		(Daltoniens)  faire en sorte que les couleurs contrastent bien pour que le contenu soit facilement visible. On peut utiliser <a href = "https://contrastchecker.com/ " style = "text-decoration : none">Contrast checker</a> pour voir si  les couleurs utilisées sont adaptées.

### 		5: Utiliser les headers (balises h pour bien structurer le contenu)

​		Rend le contenu plus facile à comprendre et aident les lecteurs d'écrans à interpréter les pages. Il faut faire en sorte qu'il n'y ait qu'un h1 par page et de les utiliser de façon graduelle (un h1 est suivi d'un h2 et pas d'un h3).

### 		6 : designer les formulaires pour l'accessibilité:

​	S'assurer que chaque champ soit accompagné d'un label claire et placé sur la même ligne, et de fournir des informations et instructions claires.

### 		7 : Rendre possible l'augmentation de la taille des texte

​	Faire en sorte que l'augmentation de la taille de la police ne casse pas le design et ne rende pas difficile l'interaction avec le site : éviter d'utiliser des unités de mesures absolues (par exemple utiliser les pixels pour spécifier la taille de la police) et utiliser des unités relatives comme le % pour que la taille du contenu s'adapte à la taille de l'écran.

### 		8 : Éviter les médias et les éléments de navigation automatiques

​		Ne pas faire jouer automatiquement des medias (musique, videos etc) et ne pas faire bouger les carrousels et sliders automatiquement.

### Specifier la langue de chaque page et mot étranger avec l'attribut lang

### 		9 : Traduction du site

​		Il est requis que le site soit consultable dans plusieurs langues :

​		Pour la gestion de plusieurs langues, je pense qu'on pourrait utiliser une approche comme celle-là :

* utiliser la detection de la langue du navigateur pour choisir la langue par défaut du site.

* utiliser des cookies pour enregistrer les parametres de langue de l'utilisateur.

* le contenu qui varie en fonction de la langue doit pouvoir être remplacé en fonction de la langue :

  * on pourrait utiliser une approche avec des variables PHP (je pense en fait aux différents éléments d'un tableau) dont le contenu serait fonction de la langue choisie sur le site.

* l'appel d'une fonction dans index.php permettrait de remplir les variables avec les valeurs appropriés.

* Où stocker les différentes valeurs ?

  * On pourrait utiliser des tableau PHP
        $francais contient toutes les valeurs du français (définition des valeurs uniquement)
        $anglais contient toutes les valeurs de l'anglais (définition des valeurs uniquement)
        $langue contient la copie du tableau qu'on utilise dans la page.
        (on remplirait ce tableau avec un `array_merge()` PHP).
    
    
    
    Idée générale de la fonction dans index.php :
  

```PHP
if ($langageChoisi == 'francais'){
    $langue = array_merge($francais);
} else if ($langageChoisi == 'anglais'){
    $langue = array_merge($anglais);
}
```

pour définir la bonne langue, et ensuite, dans les pages :

```PHP
$langue['elementParticulier'];
```

pour choisir un élément particulier du tableau des traductions.
Par exemple, pour changer le titre de la page :

```PHP
<h1><?=$langue['titre']?></h1>
```

## 	Section 508

### Définition wikipédia :

***Section 508*** est le nom usuel d'un amendement à une loi américaine, qui porte sur l'accessibilité aux personnes handicapées des sites fédéraux et ressources électroniques du gouvernement. Il s'agit de la section 508 de la loi sur la réhabilitation de 1973 (*Rehabilitation Act of 1973*), amendée par la loi sur l'investissement dans la force de travail de 1998 (*Workforce Investment Act of 1998*). Son numéro de publication est *Pub. L. No. 105-220, 112 Stat. 936 (Aug. 7, 1998)* et son code est *29 U.S.C. § 794d*.



#### por respecter les regles de la section 508 :



- eviter les lien vides

- rendre tous les liens accessibles au clavier

- mettre des alts dans les icones

- mettre le contenu principal dans un main, les titres dans des headers, les elements de navigation dans un nav etc

- sites pour tester la conformite a la section 508 : [AChecker](https://achecker.ca/), [CynthiaSays](http://www.cynthiasays.com/), [ChromeLens](http://chromelens.xyz/)

- checklist des éléments a respecter pour la section 508 : https://webaim.org/standards/508/checklist

  

  









###  
