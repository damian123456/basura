$(window).load(function(){$(".container-novedades").length&&$(".container-novedades").mCustomScrollbar({setHeight:540,theme:"dark-3"}),$(".flexslider").length&&$(".flexslider").flexslider({animation:"slide",directionNav:!1}),$(".flexslider-empresas").length&&$(".flexslider-empresas").flexslider({animation:"slide",directionNav:!1}),$(".flexslider-cursos").length&&$(".flexslider-cursos").flexslider({animation:"slide",directionNav:!1}),$(window).width()>=1200&&($(".firulete-brasil").hide().fadeIn(1e3),$(".firulete-argentina").hide().delay(1500).fadeIn(1e3),$(".firulete-italia").hide().delay(2e3).fadeIn(1e3),$(".firulete-alemania").hide().delay(500).fadeIn(1e3),$(".firulete-inglaterra").hide().delay(1500).fadeIn(1e3),$(".firulete-francia").hide().delay(2e3).fadeIn(1e3),$(".firulete-brasil-agenda").hide().fadeIn(1e3),$(".firulete-inglaterra-agenda").hide().delay(1500).fadeIn(1e3),$(".firulete-galeria-1").hide().fadeIn(1e3),$(".firulete-galeria-2").hide().delay(1500).fadeIn(1e3),$(".firulete-empresas1").hide().fadeIn(1e3),$(".firulete-empresas2").hide().delay(1500).fadeIn(1e3),$(".firulete-empresas3").hide().delay(500).fadeIn(1e3),$(".firulete-cursos-chino-1").hide().fadeIn(1e3),$(".firulete-cursos-chino-2").hide().delay(1500).fadeIn(1e3)),$(window).width()>=1400&&($(".firulete-libreria-1").hide().fadeIn(1e3),$(".firulete-libreria-2").hide().delay(1500).fadeIn(1e3),$(".firulete-libreria-3").hide().delay(500).fadeIn(1e3),$(".firulete-libreria-4").hide().delay(2e3).fadeIn(1e3),$(".firulete-franquicias1").hide().fadeIn(1e3),$(".firulete-franquicias2").hide().delay(1500).fadeIn(1e3));var e=$(".portfolioContenedor");e.isotope({filter:"*",animationOptions:{duration:750,easing:"linear",queue:!1}}),$(".filtrar a").click(function(){$(".filtrar .actual").removeClass("actual"),$(this).addClass("actual");var i=$(this).attr("data-filter");return e.isotope({filter:i,animationOptions:{duration:750,easing:"linear",queue:!1}}),!1})}),$(".read-more-content").addClass("hide"),$(".read-more-show, .read-more-hide").removeClass("hide"),$(".read-more-show").on("click",function(e){$(this).next(".read-more-content").removeClass("hide"),$(this).addClass("hide"),e.preventDefault()}),$(".read-more-hide").on("click",function(e){var i=$(this).parent(".read-more-content");i.addClass("hide"),i.prev(".read-more-show").removeClass("hide"),e.preventDefault()}),$("#ver").on("click",function(){$(".description").show("fast")}),$("#cerrar").on("click",function(){$(".description").hide("fast")}),$(".fancybox").fancybox(),$(".mySelectBoxClass").customSelect(),$(document).ready(function(){$("#owl-demo").owlCarousel({autoPlay:3e3,navigation:!0,pagination:!1,navigationText:["",""],items:3,itemsDesktop:[1199,3],itemsDesktopSmall:[979,3]})});