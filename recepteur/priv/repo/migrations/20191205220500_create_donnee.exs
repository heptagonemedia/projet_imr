defmodule Recepteur.Repo.Migrations.CreateDonnee do
  use Ecto.Migration

  def change do
    create table(:donnee) do
      add :id_bouee, :integer
      add :longitude_reelle, :float
      add :latitude_reelle, :float
      add :date_saisie, :utc_datetime
      add :batterie, :integer
      add :temperature, :float
      add :salinite, :float
      add :debit, :float

      timestamps()
    end

  end
end
