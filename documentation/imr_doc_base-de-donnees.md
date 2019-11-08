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

### Table: region

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: bouee

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: calcul

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: type_calcul

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: historique_donnee_bouee

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: resultat

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: Region

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: Region

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

### Table: Region

| champ | type | explication |
| ----- | ---- | ----------- |
|       |      |             |

## Optimisation

Pour des raisons de fonctionnement il sera mis en place une deuxième base de données servant de buffer. Elle contiendra juste les données brutes, fournies par le récepteur, puis elle sera vidée par le vérificateur qui sera chargé d’injecter les données dans notre base de données finale.

Pour ce faire, nous allons devoir optimiser notre buffer.

### Index

Il faudrait déterminer des index (à partir desquels les données sont rangées) pour augmenter la rapidité des requêtes de read de la base de données. Le write pourrait cependant être impacté.

A ce jour une des solutions des plus logiques serait un index sur le timestamp ou un sur les bouées.

Cela demandera des **benchmarks**.

### Partitions

Il est aussi possible de créer des tables filles suivant le même schéma et de les remplir suivant les index ou autre.

### Checkpoint

Il s’agit d’un genre de cycle qui vérifie que toutes les données commitées soient présentes dans la base de données. Dans notre cas, le volume de données étant très important il faudra probablement le configurer pour que l’opération soit moins fréquente ou tombe en dehors des moments d’utilisation de la base de données par le vérificateur.

Cela demandera des **benchmarks**.

### Autovaccum

Système qui permet de défragmenter nos tables. Il est par défaut fait de manière périodique, mais il faudra possiblement changer la fréquence pour optimiser la table. Il est aussi possible de l’activer manuellement, chose qui pourrait être faite par le vérificateur par exemple.

Il est aussi possible de configurer le nombre de procress qui se chargent de la défragmentation. A paramétrer suivant le volume et les pics d’insertion/lecture

**Il est aussi possible de faire un vaccum sur la base de données froide mais certaines opérations peuvent verrouiller la base**.

> VACUUM FULL utility cannot be used on production database systems. Consider using tools like pg_reorg or pg_repack which will help reorganize tables and indexes online without locks.

Il faudrait réaliser un Vaccum analyze après une insertion de masse.

### Drop d’une table

Il serait efficace de ne pas utiliser d’auto vaccum : il suffirait de faire une rotation entre une table et une autre table qui sera ensuite drop **(Je dois encore me renseigner sur ce point là)**

### Unlogged tables

Les unlogged tables ne seront pas sauvegardées en cas de crash du serveur, on perdrait ainsi beaucoup de données mais cela permet aussi de faire un gain de performances

### Requête d’insertion

* Utiliser COPY plutôt qu’INSERT
* Faire tous les INSERT dans une seule ou plusieurs transactions
* Utiliser COPY FROM STDIN **(Je dois encore me renseigner sur ce point là)**
* Mettre jusqu’a ~100 valeurs par insert de masse

> Drop indexes before starting the import, re-create them afterwards. (It takes *much* less time to build an index in one pass than it does to add the same data to it progressively, and the resulting index is much more compact).
>
> Use `synchronous_commit=off` and a huge `commit_delay` to reduce fsync() costs. This won't help much if you've batched your work into big transactions, though.
>
> `INSERT` or `COPY` in parallel from several connections. How many depends on your hardware's disk subsystem; as a rule of thumb, you want one connection per physical hard drive if using direct attached storage.
>
> Set a high `checkpoint_segments` value and enable `log_checkpoints`. Look at the PostgreSQL logs and make sure it's not complaining about checkpoints occurring too frequently.