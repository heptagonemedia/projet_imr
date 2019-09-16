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

function getBrowserSize(){
  var w, h;

  if(typeof window.innerWidth != 'undefined')
  {
    w = window.innerWidth; //other browsers
    h = window.innerHeight;
  }
  else if(typeof document.documentElement != 'undefined' && typeof      document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
  {
    w =  document.documentElement.clientWidth; //IE
    h = document.documentElement.clientHeight;
  }
  else{
    w = document.body.clientWidth; //IE
    h = document.body.clientHeight;
  }
  return {'width':w, 'height': h};
}

function reduireSideBar() {
  $(".page-wrapper").removeClass("toggled");
}

function autorisationReduireSidebar() {

  if(parseInt(getBrowserSize().width) < 1026 && fermeture) {
    reduireSideBar();
    fermeture = false;
  }
  else if (parseInt(getBrowserSize().width) > 1026){
    fermeture = true;
  }
}

var fermeture = true;
var intervalle = setInterval(autorisationReduireSidebar, 1000);



function getBrowserSize(){
    var w, h;

    if(typeof window.innerWidth != 'undefined')
    {
        w = window.innerWidth; //other browsers
        h = window.innerHeight;
    }
    else if(typeof document.documentElement != 'undefined' && typeof      document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
    {
        w =  document.documentElement.clientWidth; //IE
        h = document.documentElement.clientHeight;
    }
    else{
        w = document.body.clientWidth; //IE
        h = document.body.clientHeight;
    }
    return {'width':w, 'height': h};
}

function reduireSideBar() {
    $(".page-wrapper").removeClass("toggled");
}

function autorisationReduireSidebar() {

    if(parseInt(getBrowserSize().width) < 1026 && fermeture) {
        reduireSideBar();
        fermeture = false;
        ouveture = true;
    }
    else if (parseInt(getBrowserSize().width) > 1026 && ouveture){
        $(".page-wrapper").addClass("toggled");
        fermeture = true;
        ouveture = false;
    }
}

var fermeture = true;
var ouveture = false;
var intervalle = setInterval(autorisationReduireSidebar, 500);
