defmodule GenerateurScenario.Repo.Migrations.CreateScenario do
  use Ecto.Migration

  def change do
    create table(:scenario) do
      add :id_scenario, :integer
      add :seconde, :integer
      add :temperature, :float
      add :salinite, :float
      add :debit, :float
      add :longitude, :float
      add :latitude, :float
      add :batterie, :integer
    end
  end
end
