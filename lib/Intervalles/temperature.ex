defmodule Intervalles.Temperature do
    use Agent

    def start_link(opts) do
        initial_value = GenerateurScenario.LireXml.getTemperatureRegion
        {initial_value, opts} = Keyword.pop(opts, :initial_value, 0)
        Agent.start_link(fn -> initial_value end, opts)
    end
    
    def value do
        Agent.get(__MODULE__, & &1)
    end
    
end