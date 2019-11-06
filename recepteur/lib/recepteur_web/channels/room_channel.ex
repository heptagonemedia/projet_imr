defmodule RecepteurWeb.RoomChannel do
  use RecepteurWeb, :channel

  def join("room:lobby", _message, socket) do
    bouee = Recepteur.Bouee |> Ecto.Query.last |> Recepteur.Repo.one
    if(bouee != nil) do
      {:ok, bouee.id_bouee + 1, socket}
    else
      {:ok, 1, socket}
    end
  end

  def join("room:" <> _private_room_id, _params, _socket) do
    {:error, %{reason: "unauthorized"}}
  end

  def handle_in("new_msg", %{"body" => body}, socket) do
    broadcast!(socket, "new_msg", %{body: body})
    #test = Poison.decode!(body, as: %Recepteur.Region{})
    #IO.puts test.etiquette
    IO.puts body
    testRegion = Poison.decode!(body, as: %Recepteur.Region{}) # {"etiquette": "Ocean Antartique"}
    Recepteur.Repo.insert(testRegion)

    {:noreply, socket}
  end
end
