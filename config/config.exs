use Mix.Config

config :generateur_scenario, GenerateurScenario.Repo,
  database: "generateur_scenario_repo",
  username: "postgres",
  password: "LucienBDD",
  hostname: "localhost",
  port: 5432

  config :generateur_scenario, ecto_repos: [GenerateurScenario.Repo]
