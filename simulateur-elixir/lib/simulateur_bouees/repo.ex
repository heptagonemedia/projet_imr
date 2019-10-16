defmodule SimulateurBouees.Repo do
  use Ecto.Repo,
    otp_app: :simulateur_bouees,
    adapter: Ecto.Adapters.Postgres
end
