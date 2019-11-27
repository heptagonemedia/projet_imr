defmodule SimulateurBouees.BoueeGen do
  use Agent
  require Logger

  def start_link(initial) do
    IO.puts :startgen
    {:ok, state} = init(initial)
    Agent.start_link(process(state))
  end

  def init(initial) do
    temperature = Enum.random(5..10)
    salinite = Enum.random(5..10)
    debit = Enum.random(5..10)
    latitude = :rand.uniform(20) # TODO corriger 
    longitude = :rand.uniform(20)# TODO corriger 
    batterie = 100
    dernieres_valeurs = %{temperature: temperature, salinite: salinite, debit: debit, longitude: longitude, latitude: latitude, batterie: batterie}
    state = %{id_bouee: initial.idbouee, scenario: initial.scenario, dernieres_valeurs: dernieres_valeurs }
    {:ok, state}
  end

  def process(state) do
    receive do
      after
        1_000 ->
          generer(state)
          process(state)
    end
  end

  def generer(state) do

    # Si il existe des dernieres valeurs 
    # temperature = state.dernieres_valeurs.temperature + #GestionnaireScenario.GetRandomValue(id, value)
    # salinite = state.dernieres_valeurs.salinite + #GestionnaireScenario.GetRandomValue(id, value)
    # debit = state.dernieres_valeurs.debit + #GestionnaireScenario.GetRandomValue(id, value)
    # dernieres_valeurs= %{temperature: temperature, salinite: salinite, debit: debit}

    IO.puts :generate

    temperature = state.dernieres_valeurs.temperature + 1
    salinite = state.dernieres_valeurs.salinite + 1
    debit = state.dernieres_valeurs.debit + 1
    Map.replace!(state, :dernieres_valeurs, %{temperature: temperature, salinite: salinite, debit: debit});

    latitude = :rand.uniform(20)
    longitude = :rand.uniform(20)
    batterie = 100 

    Map.replace!(state, :dernieres_valeurs, %{state.dernieres_valeurs | latitude: latitude, longitude: longitude, batterie: batterie})
    data = %{id_bouee: state.id_bouee, latitude: latitude, longitude: longitude, 
    timestamp: :calendar.universal_time(), batterie: batterie, temperature: temperature,
    salinite: salinite, debit: debit}

    IO.inspect state
    process(state)
    
  end
end