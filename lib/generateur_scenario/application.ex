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
      {Agents.Temperature, GenerateurScenario.LireXml.getTemperatureRegion},
      {Agents.Debit, GenerateurScenario.LireXml.getDebitRegion},
      {Agents.Salinite, GenerateurScenario.LireXml.getSaliniteRegion}
    ]
    # Agents.start
    scenarioNormaux = GenerateurScenario.LireXml.getScenarioNormaux
    scenarioBase = GenerateurScenario.LireXml.getScenarioBase
    scenarioHybride = GenerateurScenario.LireXml.getScenarioHybride
    scenarioRetardes = GenerateurScenario.LireXml.getScenarioRetarde


    # See https://hexdocs.pm/elixir/Supervisor.html
    # for other strategies and supported options
    opts = [strategy: :one_for_one, name: GenerateurScenario.Supervisor]
    Supervisor.start_link(children, opts)

    IO.puts Agents.Compteur.value
    IO.puts Agents.Temperature.value


    {:ok, self}
  end
end
