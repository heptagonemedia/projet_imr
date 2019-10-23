defmodule Recepteur.Mesure do
  use Ecto.Schema
  import Ecto.Changeset

  schema "mesure" do
    field :id_historique_donnee_bouee, :id, primary_key: true, autogenerate: false
    field :date_saisie, :utc_datetime, primary_key: true
    field :id_type_donnee_mesuree, :integer
    field :valeur, :float
  end

end
