defmodule Recepteur.Donnees.Donnee do
  use Ecto.Schema
  import Ecto.Changeset

  schema "donnee" do
    field :batterie, :integer
    field :date_saisie, :utc_datetime
    field :debit, :float
    field :id_bouee, :integer
    field :latitude_reelle, :float
    field :longitude_reelle, :float
    field :salinite, :float
    field :temperature, :float

    timestamps()
  end

  @doc false
  def changeset(donnee, attrs) do
    donnee
    |> cast(attrs, [:id_bouee, :longitude_reelle, :latitude_reelle, :date_saisie, :batterie, :temperature, :salinite, :debit])
    |> validate_required([:id_bouee, :longitude_reelle, :latitude_reelle, :date_saisie, :batterie, :temperature, :salinite, :debit])
  end
end
