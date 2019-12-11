# Simulateur de Bouées

Simulateur de bouées modulaire rapide. Permet de générer une quantité volumineuse de données,
à partir de scénario décrivant l'évolution des données produites par les bouées.

## Installation

* [Télécharger et installer Elixir et Erlang.](https://elixir-lang.org/install.html)
* Cloner ou télécharger le repository
* Installer les dépendances
```
shell
curl -O https://repo.hex.pm/elixir-websetup.exe
.\elixir-websetup.exe
git clone https://github.com/heptagonemedia/SimulateurElixir
cd SimulateurElixir
mix deps.get
mix run
```

## But

À partir des scénario obtenu du [générateur de scénario](https://github.com/heptagonemedia/generateur_scenario), ce module doit gérer 75 000 bouées  simulées et générer pour chacune une lecture par seconde, et transmettre toutes les données au [récepteur de données](https://github.com/heptagonemedia/RecepteurEndpoint).

## Configuration

On peut ajuster le nombre de bouées en modifiant la ligne 22 de simulateur.ex :
```
demarrerToutesBouees( <Nombre> , liste_scenario)
```

On peut ajuster l'URL du récepteur en modifiant la ligne 73 de bouee_gen.ex :
```
    Mojito.post(
      "https://putsreq.com/vjJng1E7cT0TFdiE00DJ",  <-- Remplacer cette ligne -->
      [],
      body
    )
```

On peut ajuster l'URL du serveur MongoDB en modifiant la ligne 26 de simulateur.ex :
```
{:ok, conn} = Mongo.start_link(url: "mongodb://<HOSTNAME>:<PORT>/<DATABASE>")
```

On peut ajuster l'URL du serveur PostGreSQL en modifiant le fichier config/config.exs :
```
config :simulateur_bouees, SimulateurBouees.Repo,
database: "elix_imr",
username: "master",
password: "password",
hostname: "192.168.56.10"
```