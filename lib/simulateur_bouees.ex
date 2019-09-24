defmodule SimulateurBouees do
  @moduledoc """
  Documentation for SimulateurBouees.
  """

  @doc """
  Hello world.

  ## Examples

      iex> SimulateurBouees.hello()
      :world

  """
  

  def main do

    id_scenario = Enum.take_random(1..40, Enum.random(5..10)) # choisir 5-10 nombres de 1-40
    scenarioList = []
    Enum.each(id_scenario, fn x -> [getScenario(x)| scenarioList] end)
    IO.puts(scenarioList)
    Enum.each(scenarioList, fn x -> printScenario(x) end)
  end

  def getScenario(id) do
    require Ecto.Query
    SimulateurBouees.Scenario |> Ecto.Query.where(id_scenario: ^id) |> SimulateurBouees.Repo.all
  end

  def printScenario(scenario) do
    IO.puts(scenario)
  end
end

# Pseudo-code

# Piger 5-10 scénario
# Lire les scénario de la BD
#   - Spawn les simulateurs (recoit num depart, nombre en argument)
#       - Attribuer les numéros de bouées séquentiellement aux simulateurs
#   - Attribuer au hasard les scénarios pigés à toutes les bouées 