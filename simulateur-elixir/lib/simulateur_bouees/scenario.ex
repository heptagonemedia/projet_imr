defmodule SimulateurBouees.Scenario do
  use Ecto.Schema
  
  schema "scenario" do
    field :id, :integer
    field :type, :integer
    field :description, :string
    field :erreur_temperature, :float
    field :erreur_debit, :float
    field :erreur_salinite, :float
    field :erreur_longitude, :float
    field :erreur_latitude, :float
    field :valeur_decrementation_batterie, :integer
    field :valeur_depart_temperature, :float
    field :valeur_depart_debit, :float
    field :valeur_depart_salinite, :float
    field :valeur_depart_longitude, :float
    field :valeur_depart_latitude, :float
    field :valeur_depart_batterie, :integer
    field :prendre_compte, :boolean
  end

  def changeset(scenario, params \\ %{}) do
      scenario
      |> Ecto.Changeset.cast(params, [:id, :type, :description, :erreur_temperature, :erreur_debit, :erreur_salinite, 
      :erreur_longitude, :erreur_latitude, :valeur_decrementation_batterie, :valeur_depart_temperature, :valeur_depart_debit,
      :valeur_depart_salinite, :valeur_depart_longitude, :valeur_depart_latitude, :valeur_depart_batterie, :prendre_compte])

      |> Ecto.Changeset.validate_required([:id, :type, :description, :erreur_temperature, :erreur_debit, :erreur_salinite, 
      :erreur_longitude, :erreur_latitude, :valeur_decrementation_batterie, :valeur_depart_temperature, :valeur_depart_debit,
      :valeur_depart_salinite, :valeur_depart_longitude, :valeur_depart_latitude, :valeur_depart_batterie, :prendre_compte])
  end
end