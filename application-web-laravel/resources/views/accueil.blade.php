@extends('layout.layout')


@section('head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Rubik|Squada+One&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources\css\css.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="{{ asset('resources\css\materialize.css') }}">
    <link rel="stylesheet" href="{{asset('resources\css\headerCss.css')}}">
@endsection

@section('title', 'Accueil IMR')

@section('header')

    <!-- mock pour bouées valides, non valides -->

    @php
        $compteurFonctionelles = 0;
        $compteurProbleme = 0;
        $classe='';
        $texte='';
    @endphp

    @for ($i=0; $i < 75; $i++)

        @if (rand(0,10)%2==0)
            @php
                $compteurFonctionelles++;
                $classe='success';
                $texte=__('message.texteBoueeFonctionnelle'); //'Fonctionnelle'; // __('message.texteBoueeFonctionnelle')
            @endphp
        @else
            @php
                $compteurProbleme++;
                $classe='danger';
                $texte=__('message.texteBoueeProbleme'); //'Problème'; // __('message.texteBoueeProbleme')
            @endphp
        @endif

    @endfor


    <nav role="navigation" aria-label="header">
        <div class="nav-wrapper black" >
            <div class="row  ">

                <div class="col l4 center-align">
                    <button title="bar de navigation" role="button" onclick="ouvrirSidenav()" data-target="slide-out" class="sidenav-trigger btn black white-text" ><i  aria-label="Ouvrir le menu"  aria-hidden="true" class="material-icons" id="menu">{!! __('message.menu') !!}</i></button>
                </div>
                <div class="col l4 center-align" style="font-size: 20pt"><h1>{!! __('message.titleAccueil') !!}</h1></div>

            </div>
        </div>
    </nav>




@endsection



@section('main')
    <main role="main">
        <div class="row" id="ligne_principale">

            <section class="col l8">

                <div class="card">
                    <div >
                        <div class="" role="geomap"  id="map" ></div>
                    </div>

                    <div class="card-content">

                        <div class="row">
                            <div class="col s6 center-align">{!! __('message.titreCarte') !!}</div>
                            <div class="col s6 center-align">
                                <button title="{!! __('message.agrandirCarte') !!}" role="button" class="btn green" onclick="agrandirCarte(document.getElementById('map'))">{!! __('message.boutonPleinEcran') !!}</button>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
            <section class="col l4 s12 m6" id="camembert" >
                <div class="card white">
                    <div class="card-content white-text">
                        <span class="card-title black-text center-align">{!! __('message.derniereMiseAjour') !!}</span>
                        <div class="card-content black-text">
                            Date et heure
                        </div>
                    </div>
                </div>
                <div class="card white">
                    <div class="card-content ">
                        <span class="card-title black-text center-align">{!! __('message.etatDesBouees') !!}</span>
                        <canvas title="{!! __('message.titreGraphiqueEtatBouees') !!}" role="linegraph" id="camembertBouees"></canvas>
                    </div>
                </div>
            </section>
        </div>


    </main>

@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{asset('resources\js\materialize.js')}}"></script>
    <script src="{{asset('resources\js\script.js')}}"></script>
    <script src="{{asset('resources\js\map.js')}}"></script>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
@endsection
