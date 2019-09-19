# Elixir

## Pourquoi Elixir ?

### Rapide présentation

Elixir est une bonne piste pour nos générateurs et récepteurs de données :

* De nombreux threads (appelés process) peuvent s’exécuter en même temps sans concurrence et en multi-core. Ils peuvent en plus s’échanger des informations. 
* Gestion d’erreurs et redémarrage de process autonome.
* Extensions facilement installables (en une ligne de code et une ligne de commande).
* Facilement testable.
* Tourné vers la communication.
* Communication et création de site web sont au rendez-vous avec le framework Phoenix.
* Visiblement facile à déployer sur d’autres ordinateurs

Elixir pourrait donc nous permettre de gérer **facilement** la création de nos 75 000 bouées et la génération de données par celles-ci. La communication entre ces simulateurs et nos récepteurs (et bases de données) serait aussi facilité par **les types et les modules de base** d’Elixir. Ainsi, pour se connecter à un autre ordinateur (et au même réseau de `nodes` auquel il appartient) il suffit de deux lignes de codes. Envoyer des données à un autre ordinateur ne semble pas non plus plus difficile.

Les framework de tests et celui Phoenix (au fonctionnement proche de celui de Discord (channels, topics, sub topics…)) semblent relativement faciles à mettre en place.

Elixir serait plus facile à apprendre que d’autres langages et plusieurs sites webs (pas encore retrouvé mes sources) disent qu’il est bien plus puissant à très haute scalability.

### Des difficultés à prévoir ?

Elixir est un langage de programmation **fonctionnel**. Dès lors, il faudra réfléchir à l’organisation de notre code et nous adapter à cette philosophie peut-être inconnue pour les membres de l’équipe.

Elixir est aussi particulier dans le sens où il nécessite la mise en place d’un arbre de supervision pour surveiller les process et les redémarrer en cas de besoin. Nous aurons donc peut-être à réaliser de nombreuses recherches et à effectuer plusieurs tests en interne pour comprendre son fonctionnement. Il faut en revanche savoir que c’est un langage assez facile à apprendre.

Même si la syntaxe est plutôt permissive et facile à prendre en main certaines notations peuvent rapidement être ennuyantes, comme le fait de devoir utiliser les “:” pour les `atoms` et les `structs`.

Dans le futur il faut aussi savoir qu’Elixir est moins connu, donc moins utilisé et mois demandé (ce qui peut aussi se révéler un plus dans un CV dans la bonne entreprise, j’imagine).

### Des alternatives ?

[StackShare et d’autres sites comparent Elixir à Go et à Rust.](https://stackshare.io/stackups/elixir-vs-go-vs-rust) Si Go est bien plus utilisé, il semble aussi particulier dans sa syntaxe et moins pratique pour nos besoins. La documentation me semble aussi moins claire et plus difficile d’accès. Rust est presque annoncé d’emblée comme difficile à apprendre, mais il faut croire que de plus en plus d’applications basent leur core sur Elixir et l’étendent avec Rust.

## Comment coder en Elixir ?

### Installation

Il faut commencer par installer [Erlang](https://www.erlang.org/downloads) et [Elixir](https://elixir-lang.org/install.html). Dans certains cas il n’est pas nécessaire d’installer Erlang aussi, mais autant se prémunir de futurs problèmes.

### Premiers pas, dans un terminal

A l’image de Python, Elixir nous permet de lancer une session interactive dans un terminal. Pour cela, sous Windows, lancez l’invite de commande (pas de PowerShell !) et tapez directement `iex`. Sous Linux, même chose, mais vous devriez avoir plus de choix quant au terminal.

Pour afficher un message, rien de plus simple que :

```elixir
IO.puts("Hello World")
```

> En Elixir il est aussi possible de se passer des parenthèses, je ne sais pas encore s’il s’agit de fonctions particulières ou non, toujours est-il que vous pouvez essayer d’écrire le même message en retirant les parenthèses, cela devrait fonctionner.

Pas de “;” en Elixir, même si vous le verrez en lisant [la documentation et les guides](https://elixir-lang.org/getting-started/introduction.html), on abuse un peu des `do...end` et des `->`.

### Premiers pas, avec un projet

Pour lancer un nouveau projet, il faudra dans un terminal aller dans le dossier désiré et taper ­­`mix new mon_projet`. Un `cd` plus tard et vous êtes arrivés dans l’architecture de votre projet.

Cherchez le fichier “mon_projet/lib/mon_projet/application.ex”. C’est ici que se trouve l’équivalent du main de nos programmes en Java, C, C++ et j’en passe. Vous n’aurez plus qu’à écrire votre code en dessous de la liste `children`, comme dans l’exemple ci-dessous.

```elixir
defmodule SimulateurBouees.Application do
  # See https://hexdocs.pm/elixir/Application.html
  # for more information on OTP Applications
  @moduledoc false

  use Application

  def start(_type, _args) do
    children = [
      # Starts a worker by calling: SimulateurBouees.Worker.start_link(arg)
      # {SimulateurBouees.Worker, arg}
      SimulateurBouees.Repo,
    ]
    # Vous pouvez rédiger votre code ici !
    IO.puts "Hello World"

    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: SimulateurBouees.Supervisor]
    Supervisor.start_link(children, opts)
  end
end
```

> Les commentaires en Elixir commencent par le symbole ‘#’

Les “librairies” que vous souhaiteriez importer doivent être ajoutées dans le fichier “mon_projet/mix.exs” comme ci-dessous :

```elixir
defp deps do
    [
      # {:dep_from_hexpm, "~> 0.3.0"},
      # {:dep_from_git, git: "https://github.com/elixir-lang/my_dep.git", tag: "0.1.0"}
      {:ecto_sql, "~> 3.0"},
      {:postgrex, ">= 0.0.0"}
    ]
  end
```

Elles sont installées avec la ligne de commande `mix deps.get`. Pour lancer votre application il nous restera plus qu’à taper `mix run`.

Vous pouvez aussi compiler les fichiers en tapant `mix compile` ce qui vous permettra d’utiliser vos modules, fonctions, structs, bref, votre travail dans une session interactive en tapant `iex -S mix`.

### Continuer l’apprentissage d’Elixir

Je ne peux que vous recommander [le site officiel](https://elixir-lang.org/getting-started/introduction.html) qui est très complet et très clair. Tout reste relativement basique pour l’instant, mais si vous avez la moindre question n’hésiter pas à demander !

## Quelques pistes vers la complexité

### Interactions avec une base de données

On utilisera pour cela la dépendance [PostGrex](https://hexdocs.pm/postgrex/readme.html). Rien de trop particulier, surtout que [ce guide](https://hexdocs.pm/ecto/getting-started.html
) explique vraiment très bien les différentes étapes pour pouvoir faire des insert, des updates, et des selects sur une base de données.

### Bases de la communication avec un autre ordinateur

Assurez-vous que les deux ordinateurs soient sur le même réseau. Récupérer les adresses IP, gardez les dans le presse papier par exemple.

Maintenant, sur chacun des ordinateurs, choisissez un nom pour votre ordinateur et un genre de mot de passe. Tapez ceci dans votre terminal (sur les deux ordinateurs) en remplaçant `nom`, `adresseIP` et `acookiepliz` par les valeurs que vous avez récupérées ou choisies plus haut.

```elixir
iex --name nom@adresseIP --cookie acookiepliz
```

> Attention, si vos deux ordinateurs ont un nom et une adresse différente, le “cookie” ou mot de passe **doit être le même**. Je rappelle aussi que vos ordinateurs **doivent être connectés au même réseau** pour ce petit tutoriel

Dans votre session iex vous pouvez maintenant prendre un des ordinateurs et vous connectez à l’autre. Pour cela, tapez :

```elixir
Node.connect(:"nom@adresseIP")
```

> N’oubliez pas le ‘:’ **avant les quotes !** De plus, utilisez bien le nom et l’adresse IP de **l’autre **machine !

Vos deux machines sont maintenant connectées. Vous pouvez le vérifier en tapant :

```elixir
Node.list()
```

Vous devriez maintenant voir apparaître toutes les “nodes” connectés au même réseau.

Pour exécuter du code sur le nœud distant (celui sur l’autre machine), un peu plus complexe :

```elixir
greetings = fn -> IO.puts "Hello from #{Node.self}" end
# fn permet de définir une fonction ici, la flèche indique ce qu'on effectue dedans
# Le #{Node.self} permet de récupérer les informations du noeud de notre machine, celui qui envoie la fonction

iex(machine1@172.16.0.1)5> Node.spawn(:"machine2@172.16.0.2", greetings)
# spawm permet de lancer un process, le premier paramètre définit le noeud sur lequel on le lance et on passe la fonction définit plus haut en tant que variable pour qu'elle soit exécutée sur le noeud distant de notre choix

Hello from machine2@172.16.0.2
#Et voici le résultat !
```

Je chercherai d’autres tutoriels ou informations sur le sujet pour notre projet, mais vous avez ici les bases, que vous pouvez retrouver [ici](https://pedroassumpcao.ghost.io/connecting-machines-in-a-local-network-using-elixir-nodes/), entre autres.

### Framework Phoenix

