defmodule Recepteur.HistoriqueDonneeBouee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_historique_donnee_bouee, :id, autogenerate: true}

  schema "historique_donnee_bouee" do
    field :etiquette, :string
    field :longitude_reelle, :float
    field :latitude_reelle, :float
    field :date_saisie, :utc_datetime
    field :id_bouee, :integer

    belongs_to :bouee, Recepteur.Bouee, foreign_key: :id_bouee, references: :id_bouee, define_field: false
    has_many :donnee_traitee, Recepteur.DonneeTraitee, foreign_key: :id_historique_donnee_bouee, references: :id_historique_donnee_bouee
    has_many :mesure, Recepteur.Mesure, foreign_key: :id_historique_donnee_bouee, references: :id_historique_donnee_bouee

  end

end
