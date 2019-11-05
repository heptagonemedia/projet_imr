defmodule SimulateurBouees.Bouee do
  use Agent

  def start_link(state) do
    Agent.start_link(process(state))
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
      
    end
end