defmodule SimulateurBouees.TransportAgent do
    use Agent
  
    def start(transport) do
      Agent.start(fn -> %{:transport => transport} end, name: __MODULE__)
    end

    def get_transport() do
        Agent.get(__MODULE__, &Map.get(&1, :transport))
    end
end