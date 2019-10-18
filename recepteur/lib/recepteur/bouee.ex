defmodule Recepteur.Bouee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_bouee, :id, autogenerate: true}

  schema "bouee" do
    field :etiquette, :string
    field :longitude_reference, :float
    field :latitude_reference, :float
    field :id_region, :integer
  end

  @doc false
  def changeset(bouee, attrs) do
    bouee
    |> cast(attrs, [:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])
    |> validate_required([:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])
  end
end
