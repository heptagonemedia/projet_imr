defmodule SimulateurBouees.Scenario do
    use Ecto.Schema

    schema "scenario" do
      field :id_scenario, :integer
      field :id_delta, :integer
      field :temperature, :integer
      field :debit, :integer
      field :salinite, :integer
      field :longitude, :float
      field :latitude, :float
      field :batterie, :integer
    end
end