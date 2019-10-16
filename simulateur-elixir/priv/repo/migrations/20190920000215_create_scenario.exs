defmodule SimulateurBouees.Repo.Migrations.CreateScenario do
  use Ecto.Migration

  def change do
    create table(:scenario) do
      add :id_scenario, :integer
      add :id_delta, :integer
      add :temperature, :integer
      add :debit, :integer
      add :salinite, :integer
      add :longitude, :float
      add :latitude, :float
      add :batterie, :integer
    end
  end
end