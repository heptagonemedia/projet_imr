defmodule SimulateurBouees.Bouee do
  use Ecto.Schema
  
  schema "scenario" do
    field :valeur_depart_longitude, :float
    field :valeur_depart_latitude, :float
    field :valeur_depart_batterie, :integer
  end

  def changeset(scenario, params \\ %{}) do
      scenario
      |> Ecto.Changeset.cast(params, [:valeur_depart_longitude, :valeur_depart_latitude, :valeur_depart_batterie])

      |> Ecto.Changeset.validate_required([:valeur_depart_longitude, :valeur_depart_latitude, :valeur_depart_batterie])
  end
end