defmodule GenerateurScenario.Application do
  # See https://hexdocs.pm/elixir/Application.html
  # for more information on OTP Applications
  @moduledoc false

  use Application

  def start(_type, _args) do
    children = [
      # Starts a worker by calling: GenerateurScenario.Worker.start_link(arg)
      # {GenerateurScenario.Worker, arg}
      GenerateurScenario.Repo,
      {Agents.Compteur, 0},
      {Agents.Temperature, GenerateurScenario.LireXml.get_temperature_basse_region},
      {Agents.Debit, GenerateurScenario.LireXml.get_debit_region},
      {Agents.Salinite, GenerateurScenario.LireXml.get_salinite_region}
    ]
    # Agents.start
    scenarioNormaux = GenerateurScenario.LireXml.get_scenario_normaux
    scenarioBase = GenerateurScenario.LireXml.get_scenario_base
    scenarioHybride = GenerateurScenario.LireXml.get_scenario_hybride
    scenarioRetardes = GenerateurScenario.LireXml.get_scenario_retarde


    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: GenerateurScenario.Supervisor]
    Supervisor.start_link(children, opts)

    IO.puts Agents.Compteur.value
    IO.puts Agents.Temperature.value


    {:ok, self}
  end
end
