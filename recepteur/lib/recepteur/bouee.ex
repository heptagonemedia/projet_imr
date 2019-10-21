defmodule Recepteur.Bouee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_bouee, :id, autogenerate: true}

  schema "bouee" do
    field :etiquette, :string
    field :longitude_reference, :float
    field :latitude_reference, :float
    field :id_region, :integer

    belongs_to :region, Recepteur.Region, foreign_key: :id_region, references: :id_region, define_field: false
    has_many :historique_donnee_bouee, Recepteur.HistoriqueDonneeBouee, foreign_key: :id_bouee, references: :id_bouee
  end

  @doc false
  def changeset(bouee, attrs) do
    bouee
    |> cast(attrs, [:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])
    |> validate_required([:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])

    cast(bouee, attrs, [:id_region])
    |> foreign_key_constraint(:id_region)
  end
end
