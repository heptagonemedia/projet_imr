defmodule Recepteur.Region do
  use Ecto.Schema

  @primary_key {:id_region, :id, autogenerate: true}

  schema "region" do
    field :etiquette, :string

    has_many :bouee, Recepteur.Bouee, foreign_key: :id_region, references: :id_region
  end
end
