defmodule Recepteur.HistoriqueDonneeBouee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_historique_donnee_bouee, :id, autogenerate: true}

  schema "historique_donnee_bouee" do
    field :etiquette, :string
    field :longitude_reelle, :float
    field :latitude_reelle, :float
    field :date_saisie, :date
    field :id_bouee, :integer

    belongs_to :bouee, Recepteur.Bouee, foreign_key: :id_bouee, references: :id_bouee, define_field: false

  end

  @doc false
  def changeset(bouee, attrs) do
    bouee
    |> cast(attrs, [:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])
    |> validate_required([:id_bouee, :etiquette, :longitude_reference, :latitude_reference, :id_region])
  end
end
