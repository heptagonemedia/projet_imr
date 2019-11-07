defmodule SimulateurBouees.Repo.Migrations.CreateBouee do
  use Ecto.Migration

  def change do
    create table(:bouee) do
      add :valeur_depart_longitude, :float
      add :valeur_depart_latitude, :float
      add :valeur_depart_batterie, :integer
  end
end
