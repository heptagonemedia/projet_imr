
Fetch ALL:

SimulateurBouees.Scenario |> SimulateurBouees.Repo.all


Fetch ALL FOR GIVEN ID:

require Ecto.Query
SimulateurBouees.Scenario |> Ecto.Query.where(id_scenario: 12) |> SimulateurBouees.Repo.all


