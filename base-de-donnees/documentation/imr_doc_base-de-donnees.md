# Documentation Base de données

## Accès

### pgAdmin

| Adresse     | https://pgadmin.vpsloic.loicbertrand.net/ |
| ----------- | ----------------------------------------- |
| Identifiant | pgadmin@heptagonemedia.com                |
| serveur     | postgres                                  |

### Connexion à la base de données

| Hôte                | vpsloic.loicbertrand.net |
| ------------------- | ------------------------ |
| Port                | 2232                     |
| Utilisateur         | heptagonemedia           |
| Nom base de données | imr                      |

## Schéma de la base de données

### Tables

#### bouee

| champ               | type             | relation      | explication                                                  |
| ------------------- | ---------------- | ------------- | ------------------------------------------------------------ |
| id_bouee            | integer          | clé primaire  |                                                              |
| etiquette           | text             |               | nom de la bouée                                              |
| longitude_reference | double precision |               | longitude à laquelle la bouée est supposée être pour une mesure optimale. |
| latitude_reference  | double precision |               | latitude à laquelle la bouée est supposée être pour une mesure optimale |
| id_region           | integer (clé)    | clé étrangère | id d'une région                                              |

#### calcul

| champ                     | type                        | relation      | explication                                                  |
| ------------------------- | --------------------------- | ------------- | ------------------------------------------------------------ |
| id_calcul                 | integer                     | clé primaire  |                                                              |
| etiquette                 | text                        |               | nom du calcul                                                |
| date_generation           | timestamp without time zone |               | date à laquelle le calcul a été généré                       |
| date_prochaine_generation | timestamp without time zone |               | date à laquelle le calcul va être réitéré (si nul, le calcul ne sera pas réitéré) |
| date_debut_plage          | timestamp without time zone |               | date du début de la plage temporelle sur laquelle porte le calcul |
| date_fin_plage            | timestamp without time zone |               | date de la fin de la plage temporelle sur laquelle porte le calcul |
| frequence_valeur          | double precision            |               | fréquence du calcul                                          |
| enregistre                | boolean                     |               | si vrai alors le calcul persistera dans le temps / si faux, le calcul sera supprimé au bout d'un certain temps |
| id_type_calcul            | integer                     | clé étrangère | id d'un type de calcul                                       |

#### historique_donnee_bouee

| champ                      | type                       | relation      | explication                                 |
| -------------------------- | -------------------------- | ------------- | ------------------------------------------- |
| id_historique_donnee_bouee | integer                    | clé primaire  |                                             |
| id_bouee                   | integer                    | clé étrangère | id d'une bouée                              |
| date_saisie                | timestamp withou time zone |               | date à laquelle la donnée a été enregistrée |

#### mesure

| champ                      | type             | relation      | explication                                                  |
| -------------------------- | ---------------- | ------------- | ------------------------------------------------------------ |
| id_mesure                  | integer          | clé primaire  |                                                              |
| valeur                     | double precision |               | valeur de la mesure                                          |
| id_historique_donnee_bouee | integer          | clé étrangère | id d'un historique_donnee_bouee (la table mesure peut comporter plusieurs mesures de données de type différents correspondant au même enregistrement de la table historique_donnee_bouee) |
| valide                     | boolean          |               | vrai si la mesure est jugée valide par le vérificateur / faux si la mesure est jugée invalide par le vérificateur / nul si la mesure n'a pas encore été vérifiée. |

#### region

| champ     | type    | relation     | explication      |
| --------- | ------- | ------------ | ---------------- |
| id_region | integer | clé primaire |                  |
| etiquette | text    |              | nom de la région |

#### resultat

| champ           | type    | relation      | explication                                                  |
| --------------- | ------- | ------------- | ------------------------------------------------------------ |
| id_resultat     | integer | clé primaire  |                                                              |
| id_type_donnees | integer | clé étrangère | id d'un type de données                                      |
| id_calcul       | integer | clé étrangère | id d'un calcul (la table calcul peut comporter plusieurs résultats) |
| xml_graphique   | text    |               | xml du graphique au format texte prêt à être affiché par l'application laravel |

#### type_calcul

| champ          | type    | relation     | explication           |
| -------------- | ------- | ------------ | --------------------- |
| id_type_calcul | integer | clé primaire |                       |
| etiquette      | text    |              | nom du type de calcul |

#### type_donnee

| champ          | type    | relation     | explication                      |
| -------------- | ------- | ------------ | -------------------------------- |
| id_type_donnee | integer | clé primaire |                                  |
| etiquette      | text    |              | nom du type de donnée            |
| unite          | text    |              | nom de l'unité du type de donnée |

### Valeurs prédéfinies

#### region

| id_region | etiquette |
| --------- | --------- |
|           |           |

#### type_calcul

| id_type_calcul | etiquette |
| -------------- | --------- |
|                |           |


#### type_donnee

| id_type_donnee | etiquette | unite |
| -------------- | --------- | ----- |
|                |           |       |

