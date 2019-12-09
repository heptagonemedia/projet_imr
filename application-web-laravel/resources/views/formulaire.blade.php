
@extends('layout.layout')

@section('head')

    <link rel="stylesheet" href="{{asset('resources\css\formulaireCss.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset('resources\css\headerCss.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section('title', 'Accueil IMR')


@section('script_exception')
    <script src="{{asset('resources\js\materialize.js')}}"></script>
@endsection


@section('header')
    <nav role="navigation" aria-label="header">
        <div class="nav-wrapper black">
            <div class="row">
                <div class="col l4 center-align"><button role="button" onclick="ouvrirSidenav()" data-target="slide-out" class="sidenav-trigger btn black white-text" ><i aria-hidden="true" class="material-icons" id="menu">menu</i></button></div>
                <div class="col l4 center-align" style="font-size: 20pt"><h1>{!! __('message.titleFormulaireRecherche') !!}</h1></div>
                <div class="col l4 center align ">
                    <a href="{{action('PagesController@naviguerVersAccueil')}}" class="breadcrumb">{!! __('message.accueilMenu') !!}</a>
                    <a href="#" class="breadcrumb">{!! __('message.formulaire') !!}</a>
                </div>
            </div>
        </div>
    </nav>
@endsection


@section('main')
    <main role="main" class="container">
        <div id="register-page" class="row">

            <div class="col s12 z-depth-6 card-panel">

                <form id="formulaire" role="form" aria-label="formulaire de calcul" method="POST" action="/resultat" class="register-form">
                    @csrf

                        <fieldest class="row">

                            <legend class="input-field col s2">
                                <i  aria-hidden="true" class="small material-icons prefix">content_paste</i>
                                <label>{!! __('message.titreCalcul') !!}</label>
                            </legend>

                            <div class="input-field col s10">
                                <?php foreach ($typesCalcul as $typeCalcul){ ?>
                                <p>
                                    <label id="radio">
                                        <input aria-labelledby="radio" title="type de calcul"  name="calcul" type="radio" value="<?php echo $typeCalcul->getId(); ?>" id="<?php echo $typeCalcul->getEtiquette() ;?>" checked />
                                        <span><?php echo $typeCalcul->getEtiquette(); ?></span>
                                    </label>
                                </p>
                                    <?php } ?>
                            </div>

                        </fieldest>

                        <fieldset class="row" class="marge">

                            <legend class="input-field col s2">
                                <i aria-hidden="true" class="small material-icons prefix">history</i>
                                <label>{!! __('message.frequence') !!}</label>
                            </legend>

                            <div class="input-field col s2">
                                <input title="{!! __('message.champAnnee') !!}" aria-labelledby="labelAnnee" id="annee" type="text">
                                <label id="labelAnnee" for="annee" class="center-align">{!! __('message.annee') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input aria-labelledby="labelMois" title="{!! __('message.champMois') !!}" id="mois" type="text">
                                <label id="labelMois" for="mois" class="center-align">{!! __('message.mois') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input aria-labelledby="labelJour" title="{!! __('message.champJour') !!}"  id="jour" type="text">
                                <label id="labelJour" for="jour" class="center-align">{!! __('message.jour') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input aria-labelledby="LabelHeurebe" title="{!! __('message.champHeure') !!}" id="heure" type="text">
                                <label id="LabelHeure" for="heure" class="center-align">{!! __('message.heure') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input aria-labelledby="labelMinute" title="{!! __('message.champMinute') !!}" id="minute" type="text">
                                <label id="labelMinute" for="minute" class="center-align">{!! __('message.minute') !!}</label>
                            </div>

                            <div class="col s2"></div>

                            <div class="col s10">
                                <span class="helper-text" id="frequence"><label role="alert" class="alerte">{!! __('message.helperValeur') !!}</label></span>
                            </div>

                        </fieldset>

                        <fieldset class="row" class="marge">

                            <legend class="input-field col s2">
                                <i aria-hidden="true" class="small material-icons prefix">location_searching</i>
                                <label>{!! __('message.region') !!}</label>
                            </legend>

                            <div class="input-field col s10">
                                <select title="{!! __('message.champRegion') !!}" role="select" id="region">
                                    <option value="" disabled selected>{!! __('message.region') !!}</option>
                                    <?php foreach ($regions as $region){ ?>
                                    <option title="region <?php echo $region->getEtiquette() ?>" aria-label="region <?php echo $region->getEtiquette() ?>"  value="<?php echo $region->getId() ?>"><?php echo $region->getEtiquette() ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col s2"></div>

                            <div class="col s10">
                                <span class="helper-text" id="HelperRegion"><label role="alert" class="alerte">{!! __('message.helperRegion') !!}</label></span>
                            </div>

                        </fieldset>

                        <fieldset class="row" class="marge">

                            <legend class="input-field col s2">
                                <i  aria-hidden="true" class="small material-icons prefix">date_range</i>
                                <label>{!! __('message.intervalle') !!}</label>
                            </legend>

                            <div class="input-field col s3">
                                <input title="{!! __('message.champDateDebut') !!}" aria-labelledby="labelDateDeb" id="dateDeb" type="text" class="datepicker">
                                <label id="labelDateDeb" for="dateDeb">{!! __('message.dateDebut') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input title="{!! __('message.champHeureDebut') !!}" aria-labelledby="labelHeureDeb" id="heureDeb" type="text" class="timepicker">
                                <label id="labelHeureDeb" for="heureDeb">{!! __('message.heureDebut') !!}</label>
                            </div>

                            <div class="input-field col s3">
                                <input title="{!! __('message.champDateFin') !!}" id="dateFin" type="text" class="datepicker">
                                <label for="dateFin">{!! __('message.dateFin') !!}</label>
                            </div>

                            <div class="input-field col s2">
                                <input title="{!! __('message.champHeureFin') !!}" aria-labelledby="labelHeureFin" id="heureFin" type="text" class="timepicker">
                                <label id="labelHeureFin" for="heureFin">{!! __('message.heureFin') !!}</label>
                            </div>

                            <div class="col s2"></div>

                            <div class="col s10">
                                <span class="helper-text" id="heureTest"><label role="alert" class="alerte">{!! __('message.helperDate') !!}</label></span>
                            </div>

                        </fieldset>

                        <fieldset class="row" class="marge">

                            <legend class="input-field col s2">
                                <i aria-hidden="true" class="small material-icons prefix">save</i>
                                <label>{!! __('message.enregistrerCalcul') !!}</label>
                            </legend>

                            <div class="input-field col s10">
                                <!-- Switch -->
                                <div class="switch">
                                    <label>
                                        {!! __('message.non') !!}
                                        <input title="levier enregistrer" type="checkbox" role="checkbox">
                                        <span class="lever"></span>
                                        {!! __('message.oui') !!}
                                    </label>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset class="row" class="marge">
                            <legend class="input-field col s2">
                                <i aria-hidden="true" class="small material-icons prefix">save</i>
                                <label>{!! __('message.repeter') !!}</label>
                            </legend>

                            <div class=" input-field col l3 s10">
                                <!-- Switch -->
                                <div class="switch">
                                    <label>
                                        {!! __('message.non') !!}
                                        <input title="levier répeter" id="recursif" type="checkbox" role="checkbox" oninput="afficherRecursivite()">
                                        <span class="lever"></span>
                                        {!! __('message.oui') !!}
                                    </label>
                                </div>
                            </div>
                            <div id="ligne-select">

                            </div>
                            <div class="col s10 center">
                                <span class="helper-text " id="HelperRecursivite"><label role="alert" class="alerte">{!! __('message.helperRecursivite') !!}</label></span>
                            </div>
                        </fieldset>




                </form>
                <div class="row" class="marge">

                    <div class="input-field col s12">
                        <button title="valider" role="button" aria-label="bouton valider"  class="btn waves-effect waves-light pastel col s12" onclick="detecterErreurs()">{!! __('message.valider') !!}</button>
                    </div>

                </div>
            </div>

        </div>
    </main>
@endsection


@section('script')
    <script type="text/html" id="select-recursivite">
        <div class="input-field col l4 ">
    <select  title="selection de la récursivité" role="select" id="frequence-recursivite">
      <option value="" disabled selected>{!! __('message.champRecursivite') !!}</option>
      <option value="1">{!! __('message.frequence1') !!}</option>
      <option value="2">{!! __('message.frequence2') !!}</option>
      <option value="3">{!! __('message.frequence3') !!}</option>
    </select>
  </div>
    </script>
    <script type="text/javascript" src="{{asset('resources\js\script.js')}}"></script>
@endsection
