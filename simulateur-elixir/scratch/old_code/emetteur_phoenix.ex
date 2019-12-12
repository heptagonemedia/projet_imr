defmodule SimulateurBouees.EmetteurPhoenix do
    @moduledoc false
    require Logger
    alias Phoenix.Channels.GenSocketClient
    @behaviour GenSocketClient

    def child_spec(opts) do
      %{
        id: __MODULE__,
        start: {__MODULE__, :start_link, [opts]},
        type: :worker,
        restart: :permanent,
        shutdown: 500
      }
    end
  
    def start_link(_opts) do
      GenSocketClient.start_link(
            __MODULE__,
            Phoenix.Channels.GenSocketClient.Transport.WebSocketClient,
            "ws://localhost:4000/socket/websocket"
          )
    end
  
    def init(url) do
      IO.puts "init emetteur" 
      IO.puts inspect url

      {:connect, url, [], %{}}
    end

    def sendData(transport, data) do
      Logger.info("Sending data")
      Logger.debug inspect(data)
      GenSocketClient.join(transport, "general")
      GenSocketClient.push(transport, "general", "new_msg", data)
      #{:send, data}
    end
  
    def handle_connected(transport, state) do
      Logger.info("connected")
      GenSocketClient.join(transport, "general")
      {:ok, state}
    end
  
    def handle_disconnected(reason, state) do
      Logger.error("disconnected: #{inspect reason}")
      Process.send_after(self(), :connect, :timer.seconds(1))
      {:ok, state}
    end
  
    def handle_joined(topic, _payload, transport, state) do
      Logger.info("joined the topic #{topic}")
  
      # if state.first_join do
      #   :timer.send_interval(:timer.seconds(1), self(), :ping_server)
      #   {:ok, %{state | first_join: false, ping_ref: 1}}
      # else
      #   {:ok, %{state | ping_ref: 1}}
      # end
        SimulateurBouees.TransportAgent.start(transport)
      {:ok, state}
    end
  
    def handle_join_error(topic, payload, _transport, state) do
      Logger.error("join error on the topic #{topic}: #{inspect payload}")
      {:ok, state}
    end
  
    def handle_channel_closed(topic, payload, _transport, state) do
      Logger.error("disconnected from the topic #{topic}: #{inspect payload}")
      Process.send_after(self(), {:join, topic}, :timer.seconds(1))
      {:ok, state}
    end
  
    def handle_message(topic, event, payload, _transport, state) do
      Logger.warn("message on topic #{topic}: #{event} #{inspect payload}")
      {:ok, state}
    end
  
    def handle_reply("ping", _ref, %{"status" => "ok"} = payload, _transport, state) do
      Logger.info("server pong ##{payload["response"]["ping_ref"]}")
      {:ok, state}
    end
    def handle_reply(topic, _ref, payload, _transport, state) do
      Logger.warn("reply on topic #{topic}: #{inspect payload}")
      {:ok, state}
    end
  
    def handle_info(:connect, _transport, state) do
      Logger.info("connecting")
      {:connect, state}
    end
 
    def handle_info({:join, topic}, transport, state) do
      Logger.info("joining the topic #{topic}")
      case GenSocketClient.join(transport, topic) do
        {:error, reason} ->
          Logger.error("error joining the topic #{topic}: #{inspect reason}")
          Process.send_after(self(), {:join, topic}, :timer.seconds(1))
        {:ok, _ref} -> :ok
      end
  
      {:ok, state}
    end
    def handle_info(:ping_server, transport, state) do
      Logger.info("sending ping ##{state.ping_ref}")
      GenSocketClient.push(transport, "ping", "ping", %{ping_ref: state.ping_ref})
      {:ok, %{state | ping_ref: state.ping_ref + 1}}
    end
    def handle_info(message, _transport, state) do
      Logger.warn("Unhandled message #{inspect message}")
      {:ok, state}
    end
  end
  