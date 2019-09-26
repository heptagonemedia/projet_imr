defmodule GenerateurScenario do
  @moduledoc """
  Documentation for GenerateurScenario.
  """

  @doc """
  Hello world.

  ## Examples

      iex> GenerateurScenario.hello()
      :world

  """
  def start(scenario_normaux, scenarios_base, scenarios_hybrides, scenarios_retardes) do
    if scenario_normaux != 0 do
      loop("normal", scenario_normaux)
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
    GenerateurScenario.Constructeur.construire(type)
  end

  def loop(type, n) do
    GenerateurScenario.Constructeur.construire(type)
    loop(type, n - 1)
  end
end
