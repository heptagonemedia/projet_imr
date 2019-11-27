# Documentation Base de données

## Accès

### mongo-express

| Adresse         | https://mongo-express.homebert.fr |
| --------------- | --------------------------------- |
| Utilisateur     | user                              |
| Base de données | imr                               |

### Connexion à la base de données

| Hôte            | home  |
| --------------- | ----- |
| Port            | 27017 |
| Utilisateur     | admin |
| Base de données | imr   |

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
| enregistre                | boolean                     |               | true si le calcul doit être conservé lors du prochain nettoyage / false si le calcul doit être supprimée lors du prochain nettoyage |
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

| id_region | etiquette        |
| --------- | ---------------- |
| 1         | Atlantique Nord  |
| 2         | Atlantique Sud   |
| 3         | Pacifique Nord   |
| 4         | Pacifique Sud    |
| 5         | Océan Indien     |
| 6         | Océan Austral    |
| 7         | Océan Arctique   |
| 8         | Mer Méditerranée |

#### type_calcul

| id_type_calcul | etiquette  |
| -------------- | ---------- |
| 1              | moyenne    |
| 2              | écart-type |
| 3              | médiane    |


#### type_donnee

| id_type_donnee | etiquette   | unite |
| -------------- | ----------- | ----- |
| 1              | salinité    | ppm   |
| 2              | débit       | m³/s  |
| 3              | temperature | °C    |
| 4              | longitude   | NULL  |
| 5              | latitude    | NULL  |
| 6              | batterie    | %     |
