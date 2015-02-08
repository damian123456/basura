$(window).load(function(){
    if ($('.container-novedades').length) {
	    $(".container-novedades").mCustomScrollbar({
	        setHeight:540,
	        theme:"dark-3"
	    });
	}

    if ($('.flexslider').length) {
	    $('.flexslider').flexslider({
	      animation: "slide",
	      directionNav: false
	    });
	  }

    if ($('.flexslider-empresas').length) {
      $('.flexslider-empresas').flexslider({
        animation: "slide",
        directionNav: false
      });
    }

    if ($('.flexslider-cursos').length) {
      $('.flexslider-cursos').flexslider({
        animation: "slide",
        directionNav: false
      });
    }


  if($(window).width() >= 1200){

      $('.firulete-brasil').hide().fadeIn(1000);
      
      $('.firulete-argentina').hide().delay(1500).fadeIn(1000);
      $('.firulete-italia').hide().delay(2000).fadeIn(1000);
      $('.firulete-alemania').hide().delay(500).fadeIn(1000);
      $('.firulete-inglaterra').hide().delay(1500).fadeIn(1000);
      $('.firulete-francia').hide().delay(2000).fadeIn(1000);

      // EN AGENDA
      $('.firulete-brasil-agenda').hide().fadeIn(1000);
      $('.firulete-inglaterra-agenda').hide().delay(1500).fadeIn(1000);

      // EN GALERIA
      $('.firulete-galeria-1').hide().fadeIn(1000);
      $('.firulete-galeria-2').hide().delay(1500).fadeIn(1000);

      // EN EMPRESAS
      $('.firulete-empresas1').hide().fadeIn(1000);
      $('.firulete-empresas2').hide().delay(1500).fadeIn(1000);
      $('.firulete-empresas3').hide().delay(500).fadeIn(1000);

      // EN CURSOS
      $('.firulete-cursos-chino-1').hide().fadeIn(1000);
      $('.firulete-cursos-chino-2').hide().delay(1500).fadeIn(1000);
      
  }

  if($(window).width() >= 1400){

      // EN LIBRERIA
      $('.firulete-libreria-1').hide().fadeIn(1000);
      $('.firulete-libreria-2').hide().delay(1500).fadeIn(1000);
      $('.firulete-libreria-3').hide().delay(500).fadeIn(1000);
      $('.firulete-libreria-4').hide().delay(2000).fadeIn(1000);

      // EN FRANQUICIAS
      $('.firulete-franquicias1').hide().fadeIn(1000);
      $('.firulete-franquicias2').hide().delay(1500).fadeIn(1000);

  }

  // FILTRO GALERIA
  var $container = $('.portfolioContenedor');
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
         
            $('.filtrar a').click(function(){
                $('.filtrar .actual').removeClass('actual');
                $(this).addClass('actual');
         
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                 });
                 return false;
            });

});

// Hide the extra content initially, using JS so that if JS is disabled, no problemo:
  $('.read-more-content').addClass('hide');
  $('.read-more-show, .read-more-hide').removeClass('hide');

  // Set up the toggle effect:
  $('.read-more-show').on('click', function(e) {
    $(this).next('.read-more-content').removeClass('hide');
    $(this).addClass('hide');
    e.preventDefault();
  });

  // Changes contributed by @diego-rzg
  $('.read-more-hide').on('click', function(e) {
    var p = $(this).parent('.read-more-content');
    p.addClass('hide');
    p.prev('.read-more-show').removeClass('hide'); // Hide only the preceding "Read More"
    e.preventDefault();
  });

  $('#ver').on('click', function() {
    $(".description").show("fast");
  });

  $('#cerrar').on('click', function() {
    $(".description").hide("fast");
  });

  $('.fancybox').fancybox();

  // SELECT EN FOOTER
  $('.mySelectBoxClass').customSelect();


$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      navigation : true,
      pagination : false,
      navigationText : ["",""],
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
 
});

$("#form").validate({
        debug: false,
        errorClass: "LV_invalid_field",
        validClass: "LV_valid_field",
        errorElement: "label",
        rules: {
            nombre: {
                required: true,
                minlength: 2,
                maxlength: 40
            },
            email: {
                required: true,
                email: true
            },
            mensaje: {
                required: true,
                minlength: 5,
                maxlength: 2000
            },
        },
    });