defmodule Recepteur.HistoriqueDonneeBouee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key false

  schema "historique_donnee_bouee" do
    field :id_historique_donnee_bouee, :id, primary_key: true, autogenerate: true
    field :date_saisie, :utc_datetime, primary_key: true
    field :longitude_reelle, :float
    field :latitude_reelle, :float
    field :batterie, :integer

    field :id_bouee, :integer

    belongs_to :bouee, Recepteur.Bouee, foreign_key: :id_bouee, references: :id_bouee, define_field: false
  end

end
