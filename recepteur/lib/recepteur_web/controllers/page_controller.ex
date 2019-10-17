defmodule RecepteurWeb.PageController do
  use RecepteurWeb, :controller

  def index(conn, _params) do
    render(conn, "index.html")
  end
end
