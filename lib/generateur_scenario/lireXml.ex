defmodule GenerateurScenario.LireXml do


    def get_nom_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/nom/text()"l)
    end

    def get_temperature_basse_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/temperature_la_plus_basse/text()"l)
    end

    def get_temperature_eleve_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/temperature_la_plus_eleve/text()"l)
    end

    def get_salinite_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/salinite/text()"l)
    end

    def get_debit_region() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/region/debit/text()"l)
    end

    def get_scenario_base() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioBase/text()"l)
    end

    def get_nb_scenario() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/nbScenario/text()"l)
    end

    def get_scenario_normaux() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioNormaux/text()"l)
    end

    def get_scenario_hybride() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioHybride/text()"l)
    end

    def get_scenario_retarde() do
        import SweetXml
        {:ok, xmldoc} = File.read(Path.expand("./config/configuration.xml"))
        xmldoc |> xpath(~x"/config/proportion/scenarioRetardes/text()"l)
    end

end