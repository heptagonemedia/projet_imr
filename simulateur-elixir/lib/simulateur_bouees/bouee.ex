defmodule SimulateurBouees.Bouee do
  use Agent

  def start_link(initial) do
    state = init(initial)
    Agent.start_link(process(state))
  end

def init(initial) do
  state = %{id_bouee: initial.idbouee, scenario: initial.scenario}
  temperature = Enum.random(5..10)
  salinite = Enum.random(5..10)
  debit = Enum.random(5..10)
  valsInit = %{temperature: temperature, salinite: salinite, debit: debit}
  latitude = :rand.uniform(20)
  longitude = :rand.uniform(20)
  batterie = 100
  valsInit = %{valsInit | longitude: longitude, latitude: latitude}
  state = %{state | valeurs_initiales: valsInit}
  state
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

      SimulateurBouees.Concentrateur.put()
    end
end