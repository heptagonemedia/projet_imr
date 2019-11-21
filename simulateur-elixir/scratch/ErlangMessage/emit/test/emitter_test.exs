defmodule EmitterTest do
  use ExUnit.Case
  doctest Emitter

  test "greets the world" do
    assert Emitter.hello() == :world
  end
end
