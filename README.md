# GenerateurScenario

**TODO: Add description**

## Installation

If [available in Hex](https://hex.pm/docs/publish), the package can be installed
by adding `generateur_scenario` to your list of dependencies in `mix.exs`:

```elixir
def deps do
  [
    {:generateur_scenario, "~> 0.1.0"}
  ]
end
```

Documentation can be generated with [ExDoc](https://github.com/elixir-lang/ex_doc)
and published on [HexDocs](https://hexdocs.pm). Once published, the docs can
be found at [https://hexdocs.pm/generateur_scenario](https://hexdocs.pm/generateur_scenario).

## Quoi travailler ?

Les fichiers :
* scenario.ex contient les bases de la table dans la DB, il n'a donc pas vraiment vocation à être modifié
* application.ex est notre "main". Il contiendra nos Inputs et Outputs, c'est à dire que c'est ici qu'on chargera nos fichiers de configuration (nombre de scénario, proportions, peut-être limites ?) et de rentrer les scénarios créés dans la base de donnée

Il faut donc maintenant construire les briques de notre application, à savoir les différentes fonctions qui génèrent nos courbes, qu'elles soient correctes ou non, puis nos maillages (c'est à dire les fonctions qui vont "mélanger" le tout pour forger notre scénario).

![Capture d’écran geogebra](C:\Users\1938092\Documents\Cours\Cegep\Projet Base de données\generateur_scenario\Fonction de base.png)

> * a : amplitude, c’est donc (température_max - température_min)/2
>
> * 2π/600 : c’est un calcul fait à partir de notre période, ici 600 (parce que notre scénario se répète toutes les 600 secondes)
> * k : décalage par rapport à l’axe des y, il est donc égale à température_max - amplitude. Il représente la valeur moyenne que prendront nos températures. Il faudra sûrement réfléchir à l’attribution par bouées pour qu’on obtienne des valeurs légèrement différentes d’une bouée à une autre au sein d’une même région
> * h est le déphasage, c’est le décalage par rapport à l’axe des x. **On ne modifiera pas ce paramètre, qui restera donc à 0.**

