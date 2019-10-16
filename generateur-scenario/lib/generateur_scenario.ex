defmodule GenerateurScenario do
  def start(scenario_normaux, scenarios_base, scenarios_hybrides, scenarios_retardes) do
    if scenario_normaux != 0 do
      # loop("normal", scenario_normaux)
      GenerateurScenario.Constructeur.construire(1, "base")
      spawn fn -> send(2, :normal) end
      # spawn fn -> GenerateurScenario.Constructeur.construire(2, "base") end
    end
    if scenarios_base != 0 do
      loop("base", scenarios_base)
    end
    if scenarios_hybrides != 0 do
      loop("hybride", scenarios_hybrides)
    end
    if scenarios_retardes != 0 do
      loop("retarde", scenarios_retardes)
    end
  end


  def loop(type, n) when n <= 1 do
    Agents.Compteur.increment
    spawn GenerateurScenario.Constructeur.construire(Agents.Compteur.value, type)
    {Agents.Compteur.value, type}
  end

  def loop(type, n) do
    Agents.Compteur.increment
    spawn GenerateurScenario.Constructeur.construire(Agents.Compteur.value, type)
    loop(type, n - 1)
  end
end
