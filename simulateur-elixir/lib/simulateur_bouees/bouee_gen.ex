defmodule SimulateurBouees.BoueeGen do
  use Agent
  require Logger
  require IEx

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

  def calcul(lastval, errval) do
    valeur = Decimal.add(Decimal.from_float(0.95), errval)
    random = Decimal.mult(Decimal.from_float(:rand.uniform_real()), Decimal.from_float(0.1))
    valeur2 = Decimal.add(valeur, random)
    Decimal.mult(lastval, valeur2)
  end

  def decrementBatterie(valeur, decrement) do
    if (:rand.uniform_real > 0.5 ) do
      valeur
    else 
      valeur - decrement
    end
  end

  def generer(state) do

    last = state.dernieres_valeurs
    scenario = List.first(state.scenario) 

    temperature = calcul(last.temperature, scenario.erreur_temperature)
    salinite = calcul(last.salinite, scenario.erreur_salinite)
    debit = calcul(last.debit, scenario.erreur_debit)
    Map.replace!(state, :dernieres_valeurs, %{temperature: temperature, salinite: salinite, debit: debit});

    latitude = calcul(last.latitude, scenario.erreur_latitude)
    longitude = calcul(last.longitude, scenario.erreur_longitude)
    batterie = decrementBatterie(last.batterie, scenario.valeur_decrementation_batterie)

    Map.replace!(state, :dernieres_valeurs, %{last | latitude: latitude, longitude: longitude, batterie: batterie})
    data = %{id_bouee: state.id_bouee, latitude: latitude, longitude: longitude, 
    timestamp: :calendar.universal_time(), batterie: batterie, temperature: temperature,
    salinite: salinite, debit: debit}

    # TODO send data to RECEIVER => :rpc.call  etc.
    IO.inspect data

    :rpc.call(:"recv@127.0.0.1", Receiver, :process_data, [self(), data])

    # process(state)
    
  end
end