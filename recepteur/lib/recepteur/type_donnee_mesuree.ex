defmodule Recepteur.TypeDonneeMesuree do
  use Ecto.Schema
  import Ecto.Changeset

  @primary_key {:id_type_donnee_mesuree, :id, autogenerate: true}

  schema "type_donnee_mesuree" do
    field :etiquette, :string

    has_many :mesure, Recepteur.Mesure, foreign_key: :id_type_donnee_mesuree, references: :id_type_donnee_mesuree
  end

end
