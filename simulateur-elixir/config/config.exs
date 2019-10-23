use Mix.Config

config :simulateur_bouees, SimulateurBouees.Repo,
database: "elix_imr",
username: "master",
password: "123qweQWE",
hostname: "192.168.56.10"

config :simulateur_bouees, ecto_repos: [SimulateurBouees.Repo]

config :simulateur_bouees, ip: {127,0,0,1}, port: 6379