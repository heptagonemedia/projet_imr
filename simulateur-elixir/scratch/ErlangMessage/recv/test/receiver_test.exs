defmodule ReceiverTest do
  use ExUnit.Case
  doctest Receiver

  test "greets the world" do
    assert Receiver.hello() == :world
  end
end
