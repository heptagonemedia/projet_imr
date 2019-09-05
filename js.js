jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


   
   
});

 // On initialise la latitude et la longitude de Paris (centre de la carte)
 var lat = 48.852969;
 var lon = -67.533555;
 var macarte = null;
 // Fonction d'initialisation de la carte
 function initMap() {
     // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
     macarte = L.map('map').setView([lat, lon], 11);
     // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
     L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
         // Il est toujours bien de laisser le lien vers la source des données
         attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
         minZoom: 1,
         maxZoom: 20
     }).addTo(macarte);
     var marker = L.marker([lat, lon]).addTo(macarte);
     var marker2 = L.marker([48.852969, -67.333555]).addTo(macarte);
 }
 window.onload = function(){
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
initMap(); 
 };