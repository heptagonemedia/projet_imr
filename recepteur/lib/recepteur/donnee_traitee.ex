defmodule Recepteur.DonneeTraitee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_donnee_traitee, :id, autogenerate: true}

  schema "donnee_traitee" do
    field :id_historique_donnee_bouee, :integer
    field :date_saisie, :utc_datetime
    field :valide, :boolean
  end

end
