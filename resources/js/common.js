$(function(){
    var stickyNavTop = $('nav.main_nav').offset().top;
 
var stickyNav = function(){
var scrollTop = $(window).scrollTop();
      
if (scrollTop > stickyNavTop) { 
    $('nav.main_nav').addClass('sticky');
} else {
    $('nav.main_nav').removeClass('sticky'); 
}
};
 
stickyNav();
 
$(window).scroll(function() {
    stickyNav();
});

/*Homepage Slider*/
$.fn.cycle.transitions.scrollVert = {
    before: function( opts, curr, next, fwd ) {
        opts.API.stackSlides( opts, curr, next, fwd );
        var height = opts.container.css('overflow','hidden').height();
        opts.cssBefore = { top: fwd ? -height : height, left: 0, opacity: 1, display: 'block', visibility: 'visible' };
        opts.animIn = { top: 0 };
        opts.animOut = { top: fwd ? height : -height };
    }
};
/*Homepage Slider*/

/*Offcanvas navigation*/
$('[data-toggle="offcanvas"]').click(function () {
	$('.row-offcanvas').toggleClass('active')
});
/*Offcanvas navigation*/


$(".open-panel").click(function(){
    $("html").addClass("openNav");
    });

    $(".close-panel, #content").click(function(){
    $("html").removeClass("openNav");
    });
});

$(window).resize(function(){
  //  $('.top_nav').insertBefore('.menu');
   // $('.search').insertBefore('.menu');
});

$(window).load(function(){					
	function initialize() {
	  var myLatlng = new google.maps.LatLng(40.252476,-74.777711);
	  var myLatlngBel = new google.maps.LatLng(40.234975,-74.757173);

	  var mapOptions = {
		zoom: 17,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
	  }

	  var mapOptionsBel = {
		zoom: 20,
		center: myLatlngBel,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
	  }

	  var map = new google.maps.Map(document.getElementById('map-canvas-1'), mapOptions);
	  var mapB = new google.maps.Map(document.getElementById('map-canvas-2'), mapOptionsBel);

	marker = new google.maps.Marker({
	map:map,
	draggable:false,
	animation: google.maps.Animation.DROP,
	position: myLatlng,
	title: "Church of the Incarnation"
	});

	  markerB = new google.maps.Marker({
		map:mapB,
		draggable:false,
		animation: google.maps.Animation.DROP,
		position: myLatlngBel,
		title: "Saint James Roman Catholic Church",
	  });
		marker.setAnimation(google.maps.Animation.DROP);
		markerB.setAnimation(google.maps.Animation.DROP);
	}   
	google.maps.event.addDomListener(window, 'load', initialize);

	$(document).ready(function() {
            initialize();
	});
});

