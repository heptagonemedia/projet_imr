# Simulateur de Bouées

Simulateur de bouées modulaire rapide. Permet de générer une quantité volumineuse de données,
à partir de scénario décrivant l'évolution des données produites par les bouées.

## Installation

* [Télécharger et installer Elixir et Erlang.](https://elixir-lang.org/install.html)
* Cloner ou télécharger le repository
* Dans l’invite de commande taper: 
	 `mix deps.get`
```shell
curl -O https://repo.hex.pm/elixir-websetup.exe
.\elixir-websetup.exe
git clone https://github.com/heptagonemedia/SimulateurElixir
cd SimulateurElixir
mix deps.get
mix run
```

## But

À partir des scénario obtenu du [générateur de scénario](https://github.com/heptagonemedia/generateur_scenario), ce module doit gérer 75 000 bouées  simulées et générer pour chacune une lecture par seconde, et transmettre toutes les données au [récepteur de données](https://github.com/heptagonemedia/RecepteurEndpoint).

## Où commencer?

* simulateur_bouees.ex: Fichier où la fonction `main/0` est définie.
* bouee.ex: Génération de données et envoi au concentrateur.
* concentrateur.ex: Process qui reçoit les données et les stocke en attente de l'émission. 
* emetteur.ex: Lit les données stockées dans le concentrateur et les envoie au récepteur.
* simulateur.ex: Superviseur général.