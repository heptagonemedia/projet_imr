defmodule SimulateurBouees.Concentrateur do
  use Agent
  
    def start_link do
      Agent.start_link(fn -> [] end, name: __MODULE__)
    end

    def put(value) do
      Agent.update(__MODULE__, &([value | &1]))
    end
  
    def empty() do
      Agent.update(__MODULE__, fn(_state) -> [] end )
    end

    def getall do
      Agent.get(__MODULE__, & (&1))
    end
  end
