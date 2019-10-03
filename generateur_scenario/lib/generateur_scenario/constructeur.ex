defmodule GenerateurScenario.Constructeur do
    def construire(id, type) do
        IO.puts "hey"
    end

    def loop(type, n) when n <= 1 do
        IO.puts "hey"
    end
    
    def loop(type, n) do
        IO.puts "hey"
    end



    def unScenar() do
        valeur_base = Enum.random(Agents)
    end
end