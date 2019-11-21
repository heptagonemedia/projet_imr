defmodule Receiver do
  def process_data(client, data) do
    send client, :received
    # IO.puts inspect data
  end
end
