defmodule SimulateurBouees.Concentrateur do
    def start_link do
      Agent.start_link(fn -> [] end, name: :concentrateur)
    end

    def put(value) do
        Agent.update(:concentrateur, &([value | &1]))
      end
    
      def getall do
        Agent.get(:concentrateur, & &1)
      end
  end

#   defp loop(list) do
#     receive do
#       {:get, key, caller} ->
#         send caller, Map.get(map, key)
#         loop(map)
#       {:put, key, value} ->
#         loop(Map.put(map, key, value))
#       {:getall, caller} ->
#           send caller, map
#           loop(%{})
#     end
#   end