defmodule Receiver.Donnee do
    use Ecto.Schema

    schema "donnee" do
    field :id_bouee, :integer
    field :temperature, :decimal
    field :debit, :decimal
    field :salinite, :decimal
    field :longitude, :decimal
    field :latitude, :decimal
    field :batterie, :integer
    field :timestamp, :string
    end
end 