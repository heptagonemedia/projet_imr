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

    def getScenarioBase() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioBase/text()"l)
    end

    def getNbScenario() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/nbScenario/text()"l)
    end

    def getScenarioNormaux() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioNormaux/text()"l)
    end

    def getScenarioHybride() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioHybride/text()"l)
    end

    def getScenarioRetarde() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioRetardes/text()"l)
    end

end