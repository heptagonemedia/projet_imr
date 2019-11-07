defmodule Recepteur.TypeDonneeMesuree do
  use Ecto.Schema

  @primary_key {:id_type_donnee, :id, autogenerate: true}

  schema "type_donnee" do
    field :etiquette, :string
    field :unite, :string
  end

end
