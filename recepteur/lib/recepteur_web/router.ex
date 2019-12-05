defmodule RecepteurWeb.Router do
  use RecepteurWeb, :router

  pipeline :api do
    plug :accepts, ["json"]
  end

  scope "/api", RecepteurWeb do
    pipe_through :api

    resources "/donnee", DonneeController, except: [:new, :edit]
  end
end
