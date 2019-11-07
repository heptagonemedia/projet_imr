defmodule SimulateurBouees.Scenario do
  use Ecto.Schema
  
  schema "scenario" do
      field :id_scenario, :integer
      field :temperature_init, :float
      field :salinite_init, :float
      field :debit_init, :float
      field :longitude_init, :float
      field :latitude_init, :float
      field :batterie_init, :integer
      field :erreur, :boolean
      field :temperature_erreur, :float
      field :salinite_erreur, :float
      field :debit_erreur, :float
      field :longitude_erreur, :float
      field :latitude_erreur, :float
      field :batterie_erreur, :integer
  end

  def changeset(scenario, params \\ %{}) do
      scenario
      |> Ecto.Changeset.cast(params, [:id_scenario, :temperature_init, :salinite_init, :debit_init, 
      :longitude_init, :latitude_init, :batterie_init, :erreur, : :temperature_erreur, :salinite_erreur, 
      :debit_erreur, :longitude_erreur, :latitude_erreur, :batterie_erreur])

      |> Ecto.Changeset.validate_required([:id_scenario, :temperature_init, :salinite_init, :debit_init, 
      :longitude_init, :latitude_init, :batterie_init, :erreur, : :temperature_erreur, :salinite_erreur, 
      :debit_erreur, :longitude_erreur, :latitude_erreur, :batterie_erreur])
  end
end