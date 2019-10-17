defmodule Recepteur.Repo do
  use Ecto.Repo,
    otp_app: :recepteur,
    adapter: Ecto.Adapters.Postgres
end
