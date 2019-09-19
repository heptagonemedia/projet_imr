# Generateur Scenario
## Définir les scenarios de 10 min
Les scénario sont des tableaux de delta pointdonnées
ex:

id,     id_scen,    id_sec, temp,   debit,  salin,  long,       lat,        batt
1,      1,          1,      0.2,    0.3,    -0.2,   0.000002, -0.000001,    -1
2,      1,          2,      0.1,    0.2,    -0.2,   0.000001, -0.000002,    0
3,      1,          3,      -0.1,   -0.2,   0.1,    -0.000001, +0.000001,   0
etc.

- 10 de base :

1- Tout Normal
2- Batterie tombe a zero
3- Débit Trop Élevé
4- Débit Trop Bas
5- Temperature Trop Haute
6- Temperature Trop Basse
7- Salinité Trop Haute
8- Salinité Trop Basse
9- Bouée acrochée a un animal / navire
10- Bouée ne répond pas

- 30 normaux 
- 5 troubles avec délais
- 5 Troubles mélangé 
- 10 de base

Écrire le code de génération


Simulateur Elixir



Recepteur (en attente)

