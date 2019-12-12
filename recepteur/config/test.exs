use Mix.Config

# Configure your database
config :recepteur, Recepteur.Repo,
  username: "postgres",
  password: "mission",
  database: "recepteur_test",
  hostname: "localhost",
  port: 5432,
  pool: Ecto.Adapters.SQL.Sandbox

# We don't run a server during test. If one is required,
# you can enable the server option below.
config :recepteur, RecepteurWeb.Endpoint,
  http: [port: 4002],
  server: false

# Print only warnings and errors during test
config :logger, level: :warn
