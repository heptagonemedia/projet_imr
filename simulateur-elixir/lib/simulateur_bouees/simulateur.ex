defmodule SimulateurBouees.Simulateur do
  require IEx

  def child_spec(_args) do
    %{
      id: SimulateurBouees.Simulateur,
      start: { SimulateurBouees.Simulateur, :start_link, []},
      restart: :temporary,
      shutdown: 5000,
      type: :worker
      }
  end

  def start_link() do
    Task.start_link(fn -> main() end)
  end

  def main do

    id_scenario = Enum.take_random(1..40, Enum.random(5..10))
    liste_scenario = getScenarios(id_scenario)

    demarrerToutesBouees(1, liste_scenario)

  end
  
  def demarrerToutesBouees(nombre, liste_scenario) do
    range = 1..nombre
    
    # Enum.each(range, fn id -> demarrerBouee(id, getRandomScenario(liste_scenario)) end)
    Enum.each range, fn id->
      scenario = getRandomScenario(liste_scenario)
      demarrerBouee(id, scenario)
    end
  end

  def demarrerBouee(id, scenario) do
    SimulateurBouees.BoueeGen.start_link(%{idbouee: id, scenario: scenario})
  end

  def getRandomScenario(liste) do
    Enum.take_random(liste, 1)
  end

  def getScenario(id) do
    require Ecto.Query
    scenario = SimulateurBouees.Scenario |> Ecto.Query.where(id: ^id) |> SimulateurBouees.Repo.all
  end

  def getScenarios(id_scenarios) do
    Enum.flat_map id_scenarios, fn id ->
      getScenario(id)
    end
  end

  def printScenario(scenario) do
    IO.puts(scenario)
  end
end

  