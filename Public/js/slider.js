// DECLARATION DE L'OBJET SLIDER
function Slider(element, duration) {
  var slider = this;
  slider.element = $("#" + element); 
  slider.duration = duration; // durée qui sera choisie lors de la création de l'objet
  var actualSlide = 0; // choix de diapo pour le départ du slider
  var nbSlide = slider.element.children().length; // crée une variable qui contient le nombre d'enfants directs de l'élément
  var firstSlide = slider.element.children(":first"); // défini par quelle diapo commencer : le 1er enfant direct de l'élément
  slider.element.append("<div class='startStop'><i class='fa fa-pause-circle fa-2x' aria-hidden='true'></i></div>"); // crée l'élément html du bouton pause
  var pauseButton = slider.element.children(".startStop"); // défini le bouton pause comme enfant de l'élément
  var slideInterval;
  
  slider.animation = function() { // méthode qui fait bouger les diapos du slider UNE FOIS
    if (actualSlide >= nbSlide) { // si la diapo affichée est supérieur ou égale au nombre de diapo contenues dans l'élément, alors...
      actualSlide = 0; // ...la diapo affichée redevient la première de la liste.
    }
    firstSlide.css("margin-left", "-"+100*actualSlide+"%"); // défini le margin-left de la première diapo, ici -100%
    actualSlide++; // équivalent à actualSlide = actualSlide + 1. Augmente de 1 la valeur du margin-left à chaque changement de diapo, donc passe de margin-left: -100% à margin-left: -200%...
  }
  
  slider.animationLoop = function() { // méthode qui fait boucler la méthode animation, montrant donc toutes les diapos du slider
    slideInterval = setInterval(slider.animation, slider.duration);
  };

  // CONTROLE DU SLIDER AU CLIC
  $(document).ready(function(event) {
    $(".startStop").click(function() {
        actualSlide -= 2;;// ...va en arrière de 2 pour contrer le +1 de actualSlide++. Sinon avec juste -1, le slider resterait sur place.
        slider.animation(); // Exécution de l'animation
      });
  });

  // BOUTON PAUSE
  slider.startStop = function() { // méthode qui permet l'utilisation du bouton pause/lecture
    if (slideInterval !== undefined) { // si slideInterval n'est pas undefined...
      slideInterval = clearInterval(slideInterval); // ...alors remettre slideInterval à zéro (clear)
      pauseButton.html("<i class='fa fa-play-circle fa-2x' aria-hidden='true'></i>"); // Et afficher "Lecture" sur le bouton
    }
    else {
      slider.animationLoop(); // Sinon, lancer l'animation du slider
      pauseButton.html("<i class='fa fa-pause-circle fa-2x' aria-hidden='true'></i>"); // et afficher "Pause" sur le bouton
    }
  }
  
  pauseButton.on("click", function() {
    slider.startStop();
  });
}

// CREATION DE L'OBJET SLIDER
var slider = new Slider("slideshow", 5000);
slider.animationLoop();