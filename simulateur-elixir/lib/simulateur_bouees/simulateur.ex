defmodule SimulateurBouees.Simulateur do
  IO.puts "Hello world"

  def child_spec(_args) do
    %{
      id: SimulateurBouees.Simulateur,
      start: { SimulateurBouees.Simulateur, :start_link, []},
      restart: :permanent,
      shutdown: 5000,
      type: :worker
      }
  end

  def start_link() do
    Task.start_link(fn -> main() end)
  end

  def main do
    {:ok, concentrateur} = SimulateurBouees.Concentrateur.start_link() 
    

    
    id_scenario = Enum.take_random(1..40, Enum.random(5..10)) # choisir 5-10 nombres de 1-40
#    Task.start()
#    scenarioList = []
#    Enum.each(id_scenario, fn x -> [getScenario(x)| scenarioList] end)
#    IO.puts(scenarioList)
#    Enum.each(scenarioList, fn x -> printScenario(x) end)
  end

  

  def getScenario(id) do
    require Ecto.Query
    SimulateurBouees.Scenario |> Ecto.Query.where(id_scenario: ^id) |> SimulateurBouees.Repo.all
  end

  def printScenario(scenario) do
    IO.puts(scenario)
  end
end

  