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

@section('title', 'FAQ IMR')

@section('header')

    <nav role="navigation" aria-label="header">
        <div class="nav-wrapper black" >
            <div class="row  ">

                <div class="col l4 center-align">
                    <button title="bar de navigation" role="button" onclick="ouvrirSidenav()" data-target="slide-out" class="sidenav-trigger btn black white-text" ><i  aria-label="Ouvrir le menu"  aria-hidden="true" class="material-icons" id="menu">{!! __('message.menu') !!}</i></button>
                </div>
                <div class="col l4 center-align" style="font-size: 20pt"><h1>FAQ</h1></div>

            </div>
        </div>
    </nav>

@endsection



@section('main')
    <main class="container" role="main">
        <div class="row">
            <div class="col s12 z-depth-6 card-panel">
                <p class="center-align">
                    Cette page vous permet de consulter des vid&eacute;os d'aide.
                </p>

                <div class="bouton-faq-groupe">

                    <a
                        href="https://www.youtube.com/watch?v=2XXZED8RUzw"
                        data-youtube-id="2XXZED8RUzw"
                        class=" bouton-faq js-lanceur-liseuse-video"
                    >
                        Comment ajouter un calcul enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=vpmtTmFwENg"
                        data-youtube-id="vpmtTmFwENg"
                        class=" bouton-faq js-lanceur-liseuse-video"
                    >
                        Comment obtenir l'aperçu d'un calcul sans l'enregistrer&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=Qlnabz9MIjc"
                        data-youtube-id="Qlnabz9MIjc"
                        class=" bouton-faq js-lanceur-liseuse-video"
                    >
                        Comment revenir &agrave; la page d'&eacute;dition d'un calcul non enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=gd1mXdHOGpM"
                        data-youtube-id="gd1mXdHOGpM"
                        class=" bouton-faq js-lanceur-liseuse-video"
                    >
                        Comment voir un calcul enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=D4Z5_QVvujs"
                        data-youtube-id="D4Z5_QVvujs"
                        class=" bouton-faq js-lanceur-liseuse-video"
                    >
                        Comment changer la langue de ce site&nbsp;?
                    </a>

                </div>
            </div>
        </div>
    </main>

    <!-- liseuse vidéo -->
    <section class="liseuse-video">

        <div id="liseuse-video-content" class="liseuse-video-content" >

            <!-- iframe -->
            <iframe
                id="youtube"
                width="100%"
                height="100%"
                frameborder="0"
                allow="autoplay"
                allowfullscreen
                src=
            ></iframe>

            <a href="#" class="fermeture-liseuse-video" ><i aria-hidden="true" class="material-icons">clear</i></a>
        </div>

        <!-- overlay clicable -->
        <div class="overlay"></div>
    </section>

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
    <script src="{{asset('resources\js\liseuseVideo.js')}}"></script>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
@endsection
