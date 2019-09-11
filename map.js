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
     macarte = L.map('map').setView([49.210186, -67.433494], 8);
     // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
     L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
         // Il est toujours bien de laisser le lien vers la source des données
         attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
         minZoom: 1,
         maxZoom: 20
     }).addTo(macarte);
     var url = document.location.href;
    if(url.indexOf('bouee')==-1){
      var listeCoords = new Array();
      listeCoords.push(49.0523948);listeCoords.push(-68.283337);
      for(var i=2;i<15;i+=2){
        listeCoords.push(listeCoords[i-2]+0.1);
        listeCoords.push(listeCoords[i-1 ]+0.33);
      }
      for(var i=0;i<29;i+=2){
        L.marker([listeCoords[i], listeCoords[i+1]]).addTo(macarte);
        console.log(listeCoords[i]+','+listeCoords[i+1])
        
      }

      
    }else{
        macarte.setView([49.0523948, -68.283337], 10);
        L.marker([49.0523948, -68.283337]).addTo(macarte);
    }

 }
 window.onload = function(){
// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
initMap(); 
 };