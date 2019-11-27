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
    # Si il existe des dernieres valeurs 
    # temperature = state.dernieres_valeurs.temperature + #GestionnaireScenario.GetRandomValue(id, value)
    # salinite = state.dernieres_valeurs.salinite + #GestionnaireScenario.GetRandomValue(id, value)
    # debit = state.dernieres_valeurs.debit + #GestionnaireScenario.GetRandomValue(id, value)
    # dernieres_valeurs= %{temperature: temperature, salinite: salinite, debit: debit}

    IO.puts :generate
    valeurs = List.first(state.scenario)
    #IO.inspect state.scenario.erreur_temperature

    # lastVal x (0.95 + erreurVal + random.range(0, 0.10))

    temperature = calcul(state.dernieres_valeurs.temperature, valeurs.erreur_temperature)
    salinite = calcul(state.dernieres_valeurs.salinite, valeurs.erreur_salinite)
    debit = calcul(state.dernieres_valeurs.debit, valeurs.erreur_debit)
    Map.replace!(state, :dernieres_valeurs, %{temperature: temperature, salinite: salinite, debit: debit});

    latitude = calcul(state.dernieres_valeurs.latitude, valeurs.erreur_latitude)
    longitude = calcul(state.dernieres_valeurs.longitude, valeurs.erreur_longitude)
    batterie = decrementBatterie(state.dernieres_valeurs.batterie, valeurs.valeur_decrementation_batterie)

    Map.replace!(state, :dernieres_valeurs, %{state.dernieres_valeurs | latitude: latitude, longitude: longitude, batterie: batterie})
    data = %{id_bouee: state.id_bouee, latitude: latitude, longitude: longitude, 
    timestamp: :calendar.universal_time(), batterie: batterie, temperature: temperature,
    salinite: salinite, debit: debit}

    IO.inspect data
    process(state)
    
  end
end