(function ($) {
    "use strict";
    var counterJs = function ($scope, $) {
        //Fact Counter + Text Count
        if($('.count-box').length){
            $('.count-box').appear(function(){
        
                var $t = $(this),
                    n = $t.find(".count-text").attr("data-stop"),
                    r = parseInt($t.find(".count-text").attr("data-speed"), 10);
                    
                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".count-text").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".count-text").text(this.countNum);
                        }
                    });
                }
                
            },{accY: 0});
        }
        
    }
    var galleryCarousel = function ($scope, $) {
        if ($('.gallery-carousel').length) {
            $('.gallery-carousel').owlCarousel({
                loop:true,
                margin:0,
                nav:true,
                smartSpeed: 700,
                autoplay: 4000,
                autoHeight: false,
                navText: [ '<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow-1"></span>' ],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    800:{
                        items:3
                    },
                    1024:{
                        items:4
                    }
                }
            });    		
        }
        
    }
    var testimonialsTwo = function ($scope, $) {
        // Main Slider Carousel
        if ($('.slider-carousel').length) {
            var swiper = new Swiper('.slider-carousel', {
                //animateOut: 'slideInDown',
                //animateIn: 'slideIn',
                pagination: {
                el: '.swiper-pagination',
                //type: 'progressbar',
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            });   		
        }


        //Banner Carousel
        if ($('.gallery-thumbs').length) {
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 0,
                    slidesPerView: 3,
                        loop: true,
                        freeMode: true,
                        loopedSlides: 5, //looped slides should be the same
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                    });
                    var galleryTop = new Swiper('.slider-content', {
                        spaceBetween: 10,
                        loop:true,
                        loopedSlides: 5, //looped slides should be the same
                        navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    thumbs: {
                    swiper: galleryThumbs,
                },
            });
        }
    }
    var sponsorsJs = function ($scope, $) {
        if ($('.sponsors-carousel').length) {
            $('.sponsors-carousel').owlCarousel({
                loop:true,
                margin:0,
                nav:false,
                smartSpeed: 500,
                autoplay: true,
                navText: [ '<span class="flaticon-back-7"></span>', '<span class="flaticon-right-arrow"></span>' ],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    768:{
                        items:3
                    },
                    1024:{
                        items:5
                    }
                }
            });
        }
        
    }
    var mapJs = function ($scope, $) {

        /* --------------------------------------------
        Google Map
        -------------------------------------------- */	
        window.onload = MapLoadScript;
        function GmapInit() {
            Gmap = jQuery('.map-canvas');
            Gmap.each(function() {
                var $this           = jQuery(this),
                    lat             = '',
                    lng             = '',
                    zoom            = 12,
                    scrollwheel     = false,
                    zoomcontrol 	= true,
                    draggable       = true,
                    mapType         = google.maps.MapTypeId.ROADMAP,
                    title           = '',
                    contentString   = '',
                    theme_icon_path         = $this.data('icon-path'),
                    dataLat         = $this.data('lat'),
                    dataLng         = $this.data('lng'),
                    dataZoom        = $this.data('zoom'),
                    dataType        = $this.data('type'),
                    dataScrollwheel = $this.data('scrollwheel'),
                    dataZoomcontrol = $this.data('zoomcontrol'),
                    dataHue         = $this.data('hue'),
                    dataTitle       = $this.data('title'),
                    dataContent     = $this.data('content');
                    
                if( dataZoom !== undefined && dataZoom !== false ) {
                    zoom = parseFloat(dataZoom);
                }
                if( dataLat !== undefined && dataLat !== false ) {
                    lat = parseFloat(dataLat);
                }
                if( dataLng !== undefined && dataLng !== false ) {
                    lng = parseFloat(dataLng);
                }
                if( dataScrollwheel !== undefined && dataScrollwheel !== null ) {
                    scrollwheel = dataScrollwheel;
                }
                if( dataZoomcontrol !== undefined && dataZoomcontrol !== null ) {
                    zoomcontrol = dataZoomcontrol;
                }
                if( dataType !== undefined && dataType !== false ) {
                    if( dataType == 'satellite' ) {
                        mapType = google.maps.MapTypeId.SATELLITE;
                    } else if( dataType == 'hybrid' ) {
                        mapType = google.maps.MapTypeId.HYBRID;
                    } else if( dataType == 'terrain' ) {
                        mapType = google.maps.MapTypeId.TERRAIN;
                    }		  	
                }
                if( dataTitle !== undefined && dataTitle !== false ) {
                    title = dataTitle;
                }
                if( navigator.userAgent.match(/iPad|iPhone|Android/i) ) {
                    draggable = false;
                }
                
                var mapOptions = {
                zoom        : zoom,
                scrollwheel : scrollwheel,
                zoomControl : zoomcontrol,
                draggable   : draggable,
                center      : new google.maps.LatLng(lat, lng),
                mapTypeId   : mapType
                };		
                var map = new google.maps.Map($this[0], mapOptions);
                
                //var image = 'images/icons/map-marker.png';
                var image = theme_icon_path;
                
                if( dataContent !== undefined && dataContent !== false ) {
                    contentString = '<div class="map-data">' + '<h6>' + title + '</h6>' + '<div class="map-content">' + dataContent + '</div>' + '</div>';
                }
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                
                var marker = new google.maps.Marker({
                position : new google.maps.LatLng(lat, lng),
                map      : map,
                icon     : image,
                title    : title
                });
                if( dataContent !== undefined && dataContent !== false ) {
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map,marker);
                    });
                }
                
                if( dataHue !== undefined && dataHue !== false ) {
                var styles = [
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#444444"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#f2f2f2"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 45
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#d1cac7"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            }
        ];
                map.setOptions({styles: styles});
                }
            });
        }
            
        function MapLoadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            GmapInit();
            document.body.appendChild(script);
        }

    }
    var sliderCarouselJs = function ($scope, $) {
        // Main Slider Carousel
        if ($('.slider-carousel').length) {
            var swiper = new Swiper('.slider-carousel', {
                //animateOut: 'slideInDown',
                //animateIn: 'slideIn',
                pagination: {
                el: '.swiper-pagination',
                //type: 'progressbar',
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            });   		
        }
    }
    var imgPopup = function ($scope, $) {
        if($('.ts-image-popup').length){
            $('.ts-image-popup').magnificPopup({
                type: 'inline',
                closeOnContentClick: false,
                midClick: true,
                callbacks: {
                beforeOpen: function () {
                    this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
                zoom: {
                    enabled: true,
                    duration: 500, // don't foget to change the duration also in CSS
                },
                mainClass: 'mfp-fade',
            });
        }
        
	//Progress Bar
	if($('.progress-line').length){
		$('.progress-line').appear(function(){
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width',percent+'%');
		},{accY: 0});
	}
	
    }
    var testimonialJs = function ($scope, $) {
        	
	// Testimonial Carousel
	if ($('.testimonial-carousel').length) {
		$('.testimonial-carousel').owlCarousel({
			loop:true,
			margin:40,
			nav:true,
			smartSpeed: 700,
			autoplay: 4000,
			autoHeight: false,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},
				1024:{
					items:3
				}
			}
		});    		
	}
	
    }
    var singleCarsoJs = function ($scope, $) {
        // Single Item Carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			smartSpeed: 700,
			autoplay: 4000,
			autoHeight: false,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				}
			}
		});    		
	}
    }
    var filterJs = function ($scope, $) {
        //Gallery Filters
        if($('.filter-list').length){
            $('.filter-list').mixItUp({});
        }
    }
    var timerJs = function ($scope, $) {
        //Event Countdown Timer
        if($('.time-countdown').length){  
            $('.time-countdown').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                var $this = $(this).html(event.strftime('' + '<div class="counter-column"><span class="count">%D</span><span class="unit">Days</div></div> ' + '<div class="counter-column"><span class="count">%H</span><span class="unit">Hrs</div></div>  ' + '<div class="counter-column"><span class="count">%M</span><span class="unit">Mins</div></div>  ' + '<div class="counter-column"><span class="count">%S</span><span class="unit">Secs</div></div>'));
            });
        });
        }
    }
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/time_area__o.default', timerJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/event_info_area__t.default', timerJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/counter_area__o.default', counterJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/gallery_area__t.default', galleryCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/testimonials_area__t.default', testimonialsTwo);
        elementorFrontend.hooks.addAction('frontend/element_ready/sponsors_area__s.default', sponsorsJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/sponsors_area__two.default', sponsorsJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/banner_area_three.default', sliderCarouselJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/profile_area__o.default', imgPopup);
        elementorFrontend.hooks.addAction('frontend/element_ready/testimonials_area__o.default', testimonialJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/about_us_area__four.default', singleCarsoJs);
        elementorFrontend.hooks.addAction('frontend/element_ready/Gallery.default', filterJs);
        //elementorFrontend.hooks.addAction('frontend/element_ready/map_area__o.default', mapJs);
    });
})(jQuery);