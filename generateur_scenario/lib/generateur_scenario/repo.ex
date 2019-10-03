defmodule GenerateurScenario.Repo do
  use Ecto.Repo,
    otp_app: :generateur_scenario,
    adapter: Ecto.Adapters.Postgres
end
