defmodule Recepteur.Region do
  use Ecto.Schema

  @primary_key {:id_region, :id, autogenerate: true}

  schema "region" do
    field :etiquette, :string
  end
end
