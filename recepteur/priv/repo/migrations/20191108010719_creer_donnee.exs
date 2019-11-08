defmodule Recepteur.Repo.Migrations.CreerDonnee do
  use Ecto.Migration

  def change do
    create table(:donnee) do
      add :id_bouee, :id
      add :longitude_reelle, :float
      add :latitude_reelle, :float
      add :date_saisie, :utc_datetime
      add :batterie, :integer

      add :temperature, :float
      add :salinite, :float
      add :debit, :float
    end

  end
end
