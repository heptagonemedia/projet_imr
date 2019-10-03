defmodule SimulateurBouees.Scenario do
  use Ecto.Schema
  
  schema "scenario" do
      field :id_scenario, :integer
      field :seconde, :integer
      field :temperature, :float
      field :salinite, :float
      field :debit, :float
      field :longitude, :float
      field :latitude, :float
      field :batterie, :integer
  end

  def changeset(scenario, params \\ %{}) do
      scenario
      |> Ecto.Changeset.cast(params, [:id_scenario, :seconde, :temperature, :salinite, :debit, :longitude, :latitude, :batterie])
      |> Ecto.Changeset.validate_required([:id_scenario, :seconde, :temperature, :salinite, :debit, :longitude, :latitude, :batterie])
  end
end