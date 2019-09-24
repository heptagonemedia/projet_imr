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