import Config

config :recv, Receiver.Repo,
database: "elix_imr",
username: "master",
password: "123qweQWE",
hostname: "192.168.56.10"

config :recv, ecto_repos: [Receiver.Repo]