defmodule Recepteur.Mesure do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_mesure, :id, autogenerate: true}

  schema "mesure" do
    field :id_historique_donnee_bouee, :integer
    field :id_type_donnee_mesuree, :integer
    field :valeur, :float

    belongs_to :historique_donnee_bouee, Recepteur.HistoriqueDonneeBouee, foreign_key: :id_historique_donnee_bouee, references: :id_historique_donnee_bouee, define_field: false
    belongs_to :type_donnee_mesure, Recepteur.TypeDonneeMesuree, foreign_key: :id_type_donnee_mesuree, references: :id_type_donnee_mesuree, define_field: false
  end

end
