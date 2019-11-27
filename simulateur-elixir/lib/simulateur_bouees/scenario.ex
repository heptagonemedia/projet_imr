defmodule SimulateurBouees.Scenario do
  use Ecto.Schema
  
  schema "scenario" do
    field :type, :integer
    field :description, :string
    field :erreur_temperature, :decimal
    field :erreur_debit, :decimal
    field :erreur_salinite, :decimal
    field :erreur_longitude, :decimal
    field :erreur_latitude, :decimal
    field :valeur_decrementation_batterie, :integer
    field :valeur_depart_temperature, :decimal
    field :valeur_depart_debit, :decimal
    field :valeur_depart_salinite, :decimal
    field :prendre_compte, :boolean
  end

  def changeset(scenario, params \\ %{}) do
      scenario
      |> Ecto.Changeset.cast(params, [:id, :type, :description, :erreur_temperature, :erreur_debit, :erreur_salinite, 
      :erreur_longitude, :erreur_latitude, :valeur_decrementation_batterie, :valeur_depart_temperature, :valeur_depart_debit,
      :valeur_depart_salinite, :prendre_compte])

      |> Ecto.Changeset.validate_required([:id, :type, :description, :erreur_temperature, :erreur_debit, :erreur_salinite, 
      :erreur_longitude, :erreur_latitude, :valeur_decrementation_batterie, :valeur_depart_temperature, :valeur_depart_debit,
      :valeur_depart_salinite, :prendre_compte])
  end
end