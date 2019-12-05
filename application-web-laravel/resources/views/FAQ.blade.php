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
                <p>
                    Cette page vous permet de consulter des vid&eacute;os d'aide.
                </p>

                <div class="bouton-faq-groupe">

                    <a
                        href="https://www.youtube.com/watch?v=2XXZED8RUzw"
                        data-youtube-id="2XXZED8RUzw"
                        class=" bouton-faq js-trigger-video-modal"
                    >
                        Comment ajouter un calcul enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=vpmtTmFwENg"
                        data-youtube-id="vpmtTmFwENg"
                        class=" bouton-faq js-trigger-video-modal"
                    >
                        Comment obtenir l'aperçu d'un calcul sans l'enregistrer&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=Qlnabz9MIjc"
                        data-youtube-id="Qlnabz9MIjc"
                        class=" bouton-faq js-trigger-video-modal"
                    >
                        Comment revenir &agrave; la page d'&eacute;dition d'un calcul non enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=gd1mXdHOGpM"
                        data-youtube-id="gd1mXdHOGpM"
                        class=" bouton-faq js-trigger-video-modal"
                    >
                        Comment voir un calcul enregistr&eacute;&nbsp;?
                    </a>

                    <a
                        href="https://www.youtube.com/watch?v=D4Z5_QVvujs"
                        data-youtube-id="D4Z5_QVvujs"
                        class=" bouton-faq js-trigger-video-modal"
                    >
                        Comment changer la langue de ce site&nbsp;?
                    </a>

                </div>
            </div>
        </div>
    </main>



    <!-- video modal -->
    <section class="video-modal">

        <!-- Modal Content Wrapper -->
        <div
            id="video-modal-content" class="video-modal-content"
        >

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

            <a
                href="#"
                class="close-video-modal"
            >
                <!-- X close video icon -->
                <svg
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0"
                    y="0"
                    viewBox="0 0 32 32"
                    style="enable-background:new 0 0 32 32;"
                    xml:space="preserve"
                    width="24"
                    height="24"
                >

            <g id="icon-x-close">
                <path fill="#ffffff" d="M30.3448276,31.4576271 C29.9059965,31.4572473 29.4852797,31.2855701 29.1751724,30.980339 L0.485517241,2.77694915 C-0.122171278,2.13584324 -0.104240278,1.13679247 0.52607603,0.517159487 C1.15639234,-0.102473494 2.17266813,-0.120100579 2.82482759,0.477288136 L31.5144828,28.680678 C31.9872448,29.1460053 32.1285698,29.8453523 31.8726333,30.4529866 C31.6166968,31.0606209 31.0138299,31.4570487 30.3448276,31.4576271 Z" id="Shape"></path>
                <path fill="#ffffff" d="M1.65517241,31.4576271 C0.986170142,31.4570487 0.383303157,31.0606209 0.127366673,30.4529866 C-0.12856981,29.8453523 0.0127551942,29.1460053 0.485517241,28.680678 L29.1751724,0.477288136 C29.8273319,-0.120100579 30.8436077,-0.102473494 31.473924,0.517159487 C32.1042403,1.13679247 32.1221713,2.13584324 31.5144828,2.77694915 L2.82482759,30.980339 C2.51472031,31.2855701 2.09400353,31.4572473 1.65517241,31.4576271 Z" id="Shape"></path>
            </g>

          </svg>
            </a>

        </div><!-- end modal content wrapper -->


        <!-- clickable overlay element -->
        <div class="overlay"></div>


    </section>
    <!-- end video modal -->


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
    <script src="{{asset('resources\js\liseuseVideo.js')}}"></script>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
@endsection
