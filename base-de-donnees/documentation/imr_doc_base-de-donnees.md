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
| enregistre                | boolean                     |               | si vrai alors le calcul persistera dans le temps / si faux, le calcul sera supprimé au bout d'un certain temps |
| id_region                 | integer                     | clé étrangère | id de la région concernée par le calcul                      |
| id_type_calcul            | integer                     | clé étrangère | id d'un type de calcul                                       |
| date_debut_plage          | timestamp without time zone |               | date du début de la plage temporelle sur laquelle porte le calcul |
| date_fin_plage            | timestamp without time zone |               | date de la fin de la plage temporelle sur laquelle porte le calcul |
| frequence_valeur          | double precision            |               | fréquence du calcul                                          |
| xml_graphique_temperature | text                        |               | données de température au format xml                         |
| xml_graphique_salinite    | text                        |               | données de salinité au format xml                            |
| xml_graphique_debit       | text                        |               | données de température au format xml                         |

#### historique_donnee_bouee

| champ                      | type                       | relation      | explication                                 |
| -------------------------- | -------------------------- | ------------- | ------------------------------------------- |
| id_historique_donnee_bouee | integer                    | clé primaire  |                                             |
| id_bouee                   | integer                    | clé étrangère | id d'une bouée                              |
| date_saisie                | timestamp withou time zone |               | date à laquelle la donnée a été enregistrée |
| temperature                | double                     |               | température                                 |
| debit                      | double                     |               | débit                                       |
| salinite                   | double                     |               | salinité                                    |
| longitude                  | double                     |               | longitude                                   |
| latitude                   | double                     |               | latitude                                    |
| batterie                   | integer                    |               | état de charge de la batterie               |
| valide                     | boolean                    |               | validité du calcul                          |

#### region

| champ     | type    | relation     | explication      |
| --------- | ------- | ------------ | ---------------- |
| id_region | integer | clé primaire |                  |
| etiquette | text    |              | nom de la région |

#### type_calcul

| champ          | type    | relation     | explication           |
| -------------- | ------- | ------------ | --------------------- |
| id_type_calcul | integer | clé primaire |                       |
| etiquette      | text    |              | nom du type de calcul |

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
