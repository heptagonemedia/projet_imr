defmodule Receiver.Repo do
  use Ecto.Repo,
    otp_app: :recv,
    adapter: Ecto.Adapters.Postgres
end
