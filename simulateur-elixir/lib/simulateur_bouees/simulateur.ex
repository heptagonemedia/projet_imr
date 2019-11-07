defmodule SimulateurBouees.Simulateur do
  

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

    
    id_scenario = Enum.take_random(1..40, Enum.random(5..10))
    

    

  end

  def test do
    {:ok, concentrateur} = SimulateurBouees.Concentrateur.start_link() 
    SimulateurBouees.Concentrateur.put("valeur1")
    SimulateurBouees.Concentrateur.put("valeur2")
    SimulateurBouees.Concentrateur.getall()
  end
  

  def getScenario(id) do
    require Ecto.Query
    SimulateurBouees.Scenario |> Ecto.Query.where(id_scenario: ^id) |> SimulateurBouees.Repo.all
  end

  def printScenario(scenario) do
    IO.puts(scenario)
  end
end

  