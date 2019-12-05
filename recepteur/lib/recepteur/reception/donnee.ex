defmodule Recepteur.Reception.Donnee do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_donnee, :binary_id, autogenerate: true}
  @foreign_key_type :binary_id
  schema "donnee" do
    field :id_bouee, :id
    field :longitude_reelle, :float
    field :latitude_reelle, :float
    field :date_saisie, :utc_datetime
    field :batterie, :integer

    field :temperature, :float
    field :salinite, :float
    field :debit, :float
  end

  @doc false
  def changeset(donnee, attrs) do
    donnee
    |> cast(attrs, [])
    |> validate_required([])
  end
end
