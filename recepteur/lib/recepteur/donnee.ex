defmodule Recepteur.Donnee do
    use Ecto.Schema

    schema "donnee" do
      field :id_bouee, :id
      field :longitude_reelle, :float
      field :latitude_reelle, :float
      field :date_saisie, :utc_datetime
      field :batterie, :integer

      field :temperature, :float
      field :salinite, :float
      field :debit, :float
    end
end
