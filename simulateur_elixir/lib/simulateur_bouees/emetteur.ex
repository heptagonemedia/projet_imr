defmodule SimulateurBouees.Emetteur do
    use Agent
    
    def start_link(concentrateur) do
      Task.start_link(fn -> loop(concentrateur) end)
    end
  
    defp loop(concentrateur) do
      # Send 
    end
  end