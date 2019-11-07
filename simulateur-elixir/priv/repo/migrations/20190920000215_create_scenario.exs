defmodule SimulateurBouees.Repo.Migrations.CreateScenario do
  use Ecto.Migration

  def change do
    create table(:scenario) do
      add :id, :integer
      add :type, :integer
      add :description, :string
      add :erreur_temperature, :float
      add :erreur_debit, :float
      add :erreur_salinite, :float
      add :erreur_longitude, :float
      add :erreur_latitude, :float
      add :valeur_decrementation_batterie, :integer
      add :valeur_depart_temperature, :float
      add :valeur_depart_debit, :float
      add :valeur_depart_salinite, :float
      add :prendre_compte, :boolean
    end
  end
end