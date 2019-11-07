defmodule Recepteur.DonneeTraitee do
  use Ecto.Schema

  @primary_key {:id_donnee_traitee, :id, autogenerate: true}

  schema "donnee_traitee" do
    field :id_historique_donnee_bouee, :integer
    field :valide, :boolean

    belongs_to :historique_donnee_bouee, Recepteur.HistoriqueDonneeBouee, foreign_key: :id_historique_donnee_bouee, references: :id_historique_donnee_bouee, define_field: false
  end
end
