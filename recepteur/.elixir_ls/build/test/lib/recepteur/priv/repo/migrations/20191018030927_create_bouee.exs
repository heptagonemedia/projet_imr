defmodule Recepteur.Repo.Migrations.CreateBouee do
  use Ecto.Migration

  def change do
    create table(:bouee) do
      add :id_bouee, :integer
      add :etiquette, :string
      add :longitude_reference, :float
      add :latitude_reference, :integer
      add :id_region, :integer

      timestamps()
    end

  end
end
