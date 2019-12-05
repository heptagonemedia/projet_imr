$(document).ready(function(){


    /* Ouverture de la liseuse vidéo -----------------------------------------*/
    function ouvertureLiseuseVideo() {

        // Clic sur le lien de la vidéo
        $(".js-lanceur-liseuse-video").on("click", function(e){

            // on empêche l'execution de la balise <a>
            e.preventDefault();

            // on prend l'id de la vidéo cliquée
            var id = $(this).attr('data-youtube-id');

            // La lecture de la vidéo commence dès qu'elle apparait à l'écran
            var autoplay = '?autoplay=1';

            // Ne pas afficher de recommandations à la fin de la lecture de la vidéo
            var related_no = '&rel=0';

            // Ajout de l'id de la vidéo et des paramètres à l'url Youtube
            var src = 'https://www.youtube.com/embed/'+id+autoplay+related_no;

            // Envoi de l'url de la vidéo dans l'iframe
            // On fait en sorte que la source vidéo de l'iframe corresonde à l'id
            $("#youtube").attr('src', src);

            // On fait addClass pour l'ajouter au body et la rendre visible.
            $("body").addClass("show-liseuse-video noscroll");

        });

        // Fermeture et reset de la liseuse
        function fermetureLiseuseVideo() {

            event.preventDefault();

            // on cache la visionneuse vidéo
            $("body").removeClass("show-liseuse-video noscroll");

            // on reset le lien de la vidéo, ça arrête la vidéo
            $("#youtube").attr('src', '');

        }
        // si le bouton de fermeture de l'overlay est cliqué
        $('body').on('click', '.fermeture-liseuse-video, .liseuse-video .overlay', function(event) {

            // on appelle la fonction de fermeture
            fermetureLiseuseVideo();

        });
        // si la touche ÉCHAP est tappée
        $('body').keyup(function(e) {
            // le code touche 27 correspond à ÉCHAP.
            if (e.keyCode == 27) {

                // on appelle la fonction de fermeture
                fermetureLiseuseVideo();

            }
        });
    }
    ouvertureLiseuseVideo();



});
