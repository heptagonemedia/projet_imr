defmodule GenerateurScenario.LireXml do


    def getNomRegion() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/region/nom/text()"l)
    end

    def getTemperatureRegion() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/region/temperature/text()"l)
    end

    def getSaliniteRegion() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/region/salinite/text()"l)
    end

    def getDebitRegion() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/region/debit/text()"l)
    end


end