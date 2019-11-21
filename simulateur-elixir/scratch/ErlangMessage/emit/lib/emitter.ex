defmodule Emitter do
  def send_data(data) do
    :rpc.call(:"recv@TI-LACHANCEC", Receiver, :receive, data)
  end
end
