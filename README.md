# projet_imr

## Membres :

Lachance Christophe
Carrières Adrian-Paul
Bertrand Loïc
Gay Estevan
Pascuzzi Louis
Cousson Théo
Richard Antoine
Barçon Lucien

## Principe :

Ce projet devait permettre la réception de données produites par des bouées (objets connectés) et leur vérification pour ensuite permettre à un utilisateur de choisir des calculs à effectuer avec.
Ainsi, nous avions pour objectif de supporter une charge de 7500 bouées, avec une émission toutes les secondes, avec comme calcul la moyenne, la médiane et l'écart type sur soit la salinité, soit le débit, soit la température.

Notre projet comporte aussi un système de simulation des dites bouées qui nous permet donc de faire des tests de charge (entre autre).
Au niveau des bases de données nous en avons une en PostgreSQL qui sert de buffer et une "finale" en MongoDB qui garde toutes les données.

## Améliorations possibles :

Il faudrait faire du récepteur un système distribué pour pouvoir supporter 7500 bouées, la base de données nous lâchant avant (le service web lui tient toujours) ou penser à l'infonuagie ("cloud").
Nous devrions aussi faire la mise en production ainsi que le vérificateur de données qui n'existe pas encore.
Peut-être faudrait-il mettre en place un système d'archivage, ainsi que du sharding ou du partionning pour optimiser nos différentes bases de données.
