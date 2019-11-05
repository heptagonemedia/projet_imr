defmodule Recepteur.Mesure do
  use Ecto.Schema

  @primary_key {:id_mesure, :id, autogenerate: true}

  schema "mesure" do
    field :valeur, :float

    field :id_historique_donnee_bouee, :integer
    field :id_type_donnee, :integer

    belongs_to :historique_donnee_bouee, Recepteur.HistoriqueDonneeBouee, foreign_key: :id_historique_donnee_bouee, references: :id_historique_donnee_bouee, define_field: false
    belongs_to :type_donnee, Recepteur.TypeDonneeMesuree, foreign_key: :id_type_donnee, references: :id_type_donnee, define_field: false
  end

end