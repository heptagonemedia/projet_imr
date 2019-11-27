defmodule Receiver.Receiver do
    def child_spec(_args) do
        %{
          id: Receiver.Receiver,
          start: { Receiver.Receiver, :start_link, []},
          restart: :temporary,
          shutdown: 5000,
          type: :worker
          }
      end

    def start_link() do
        Task.start_link(fn -> init_node() end)
      end

    def init_node do
        Node.start :"recv@127.0.0.1" 
        Node.set_cookie :avoine_et_raisin
    end
  end
  