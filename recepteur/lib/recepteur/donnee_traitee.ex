defmodule Recepteur.DonneeTraitee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_donnee_traitee, :id, autogenerate: true}

  schema "donnee_traitee" do
    field :id_historique_donnee_bouee, :integer
    field :date_saisie, :utc_datetime
    field :valide, :boolean
  end


  def changeset(struct, params \\ %{}) do
    struct
    |> cast(params, [:id_donnee_traitee, :id_historique_donnee_bouee, :date_saisie, :valide])
    |> validate_required([:id_historique_donnee_bouee, :date_saisie])
    |> unique_constraint(:id_historique_donnee_bouee, name: "historique_donnee_bouee_donnee_traitee_fk")
    |> unique_constraint(:id_donnee_traitee, name: "donnee_traitee_pkey")
    |> foreign_key_constraint(:id_historique_donnee_bouee, name: "historique_donnee_bouee_donnee_traitee_fk")
  end

end
