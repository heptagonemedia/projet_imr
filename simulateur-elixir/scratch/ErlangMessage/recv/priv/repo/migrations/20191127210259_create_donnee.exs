defmodule Receiver.Repo.Migrations.CreateDonnee do
  use Ecto.Migration

  def change do
    create table(:donnee) do
      add :id_bouee, :integer
      add :temperature, :decimal
      add :debit, :decimal
      add :salinite, :decimal
      add :longitude, :decimal
      add :latitude, :decimal
      add :batterie, :integer
      add :timestamp, :string
    end
  end
end
