# Laravel Projet IMR

## resources > views

### > layout

#### layout.blade.php

Layout d'affichage pour toutes les pages hormis les calculs

#### layoutResultat.blade.php

Layout d'affichage pour les résultats ( __/!\ Il faut le modifier__ car actuellement c'est simplement la page de résultat d'avant, prendre exemple sur layout.blade.php).

### > resultat   

#### show.blade.php

Page à afficher lorsque l'on souhaite afficher un résultat ( __/!\ Il faut la modifier__, prendre exemple sur accueil.blade.php)

### > accueil.blade.php, formulaire.blade.php

Ils extends tout les deux de layout.blade.php. (@extends('layout.layout') = le fichier dans le sous-dossier layout se nommant layout.blade.php) 

Dans le layout, on a déclaré des yield('nom'). Dans ces fichiers, le html a juste été divisé dans des sections correspondants aux noms donnés dans les yield.

### > footer.blade.php, header.blade.php, navigation_side_bar.blade.php

Simplement du html que l'on include dans le layout pour que se soit plus modulaire et que l'on puisse modifié ce que l'on veut dans ces différentes parties de l'affichage.

#### welcome.blade.php

Fichier généré de base par Laravel que j'ai laissé mais qui peut être supprimé sans problèmes.

## app > Http > Controllers

### > PagesController.php

Permet de naviguer entre les vues (la méthodes test() est à supprimer car il faut utiliser le controller des résultats)

### > ResultatController.php

Contrôle l'affichage des résultats, il y aura des méthodes à rajouter, par exemple, pour simplement affiché le résultat déjà calculé sans le recalculé comme la méthode store va le faire (lire les commentaires que j'ai mis (un todo est présent) et voir si ça peut correspondre avec ce qui est déjà fait).

## routes > web.php

Fichier définissant les routes (faire les tutoriels de larcasts.com pour comprendre ce qui a été fait)

## public > resources 		(resources n'est pas générer par Laravel, je l'ai créé)

Ce dossier regroupe tout les fichiers css, js et nos images que nous avons créés. C'est ici qu'il faut les mettre parce que le client a seulement accès à ce dossier. Pour inclure un fichier dans une page faire, par exemple :

```php+HTML
<link rel="stylesheet" href="{{ asset('resources\css\css.css') }}">
```

