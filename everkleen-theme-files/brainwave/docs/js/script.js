var $ = jQuery;

/* ------------------------------------
 * LOAD START
 -------------------------------------*/
$( window ).load(function() {

	$('img:not(".logo-img, .scroll-down-img, .avatar")').each(function() {
		if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
		  var ieversion=new Number(RegExp.$1)
		  if (ieversion>=9)
			if (typeof this.naturalWidth === "undefined" || this.naturalWidth === 0) {
			  this.src = "http://placehold.it/" + ($(this).attr('width') || this.width || $(this).naturalWidth()) + "x" + (this.naturalHeight || $(this).attr('height') || $(this).height());
			}
		} else {
		  if (!this.complete || typeof this.naturalWidth === "undefined" || this.naturalWidth === 0) {
			this.src = "http://placehold.it/" + ($(this).attr('width') || this.width) + "x" + ($(this).attr('height') || $(this).height());
		  }
		}
	});

	$( 'body' ).removeClass( 'display-h' );
	$( '.site-footer' ).removeClass( 'display-h' );

	// Touch device
	if( navigator.userAgent.match( /iPad|iPhone|Android/i ) ) {
		$( 'body' ).addClass( 'touch-device' );
	} else {
		$( 'body' ).addClass( 'no-touch-device' );
	}

	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

	if ( $( 'body' ).hasClass( 'no-touch-device' ) && ! isSafari ) {

		$("html").niceScroll({
			cursorcolor: '#222222',
			zindex: 9999,
			cursorborder: 'none',
			cursorborderradius: 0,
			mousescrollstep: 250,
			railpadding: {
				top: 5,
				right: 5,
				left: 0,
				bottom: 5
			}
		});
	}

	// ready
	init();

	// section background
	styleHelper();

	/* ------------------------------------
	 * Menu active item BEGIN
	 -------------------------------------*/
	$(document).on( 'scroll' , onScroll);

	onScroll();
	/* ------------------------------------
	 * Menu active item END
	 -------------------------------------*/

	setTimeout(function() {
		$( 'body' ).removeClass( 'load' );
	}, 300);
});
/* ------------------------------------
 * LOAD END
 -------------------------------------*/

/* ------------------------------------
 * READY BEGIN
 -------------------------------------*/
$( document ).ready(function(){
	'use strict';

	var $navbarStyle2 = $( '.navbar.style2, .navbar-fixed-top' );
	menuFixedButton( $navbarStyle2 );

	$( 'img.frame' ).each(function() {
		$( this ).wrap( "<div class='img-frame'></div>" );
		$( this ).closest( ".img-frame" ).prepend( "<div class='dot'></div><div class='dot'></div><div class='dot'></div>" );
	});

	/* ------------------------------------
	 * Navigation scroll START
	 -------------------------------------*/
	$( 'body' ).on( 'click', '.navigation a:not(.page-load, .single-page-load, [target="_blank"]), .scrollTo', function() {

		if ( $( this ).closest( 'li' ).hasClass( 'sub-close' ) ) {
			return false;
		}

		var $navbarStyle2 = $( '.navbar-fixed-top' );
		menuFixedButton( $navbarStyle2 );

		$( 'body' ).addClass( 'scrollTo' );

		var url = $(this).attr('href'),
			hash = url.substring(url.indexOf('#'));

		window.history.pushState({path: url},'',url);

		$('.navigation li').removeClass( 'active' );

		$( this ).parent( 'li' ).addClass( 'active' );

		$("html, body").animate({ scrollTop: $(hash).position().top }, 1000, function() {
			$( 'body' ).removeClass( 'scrollTo' );
			$( '.navigation.style-3' ).removeClass( 'open' );
		});

		return false;
	});
	/* ------------------------------------
	 * Navigation scroll END
	 -------------------------------------*/

} );
/* ------------------------------------
 * READY END
 -------------------------------------*/

/* ------------------------------------
 * RESIZE BEGIN
 -------------------------------------*/
$( window ).resize( function(){

	// slider conteiner resize
	$( '.slide .display-tc' ).css({width: $(window).width(), height: $(window).height()});

	// Featured item auto height
	autoHeightFeatured();

	// Set height for home section
	$( '.video-bg, .image-bg, .home-text-rotate' ).css( 'height', $( window ).height() );

	// Set height and width for paralax portfolio item
	$( '.info-wrapper' ).css( {'height': $( '.portfolio-item' ).height(), 'width': $( '.portfolio-item' ).width()} );

	// Set not found page height
	$( '.not-found' ).css( {'height': $( window ).height(), 'width': $( window ).width()} );

} );
/* ------------------------------------
 * RESIZE END
 -------------------------------------*/

/* ------------------------------------
 * Ready function Start
 -------------------------------------*/
function init() {

	// features (:before, :after)
	// $( '.features-icon' ).append( '<div class="before"></div><div class="after"></div>' );

	/* ------------------------------------
	 * Menu BEGIN
	 -------------------------------------*/

	// Hide Header on on scroll down
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('.navigation').outerHeight();

	$(window).scroll(function(event){
	    didScroll = true;
	});

	// Map elements animation
	if (typeof menuInterval !== 'undefined') {
		clearInterval(menuInterval);
	}

	menuInterval = setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);

	function hasScrolled() {
	    var st = $(this).scrollTop();

	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;

	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        $('.navigation').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            $('.navigation').removeClass('nav-up').addClass('nav-down');
	        }
	    }

	    lastScrollTop = st;
	}

	$(".full-height-wrapper .sub").prepend('<li class="sub-close"><a href="#">+</a></li>');
	$(".has-sub i").click(function() {
        var a = $(this).closest("li");
        if ( a.hasClass("open") ) {
        	a.removeClass("open");
        } else {
        	a.addClass("open");
        }
        a.find("> ul").css("padding-top", ($(".full-height-wrapper").height() - a.find("> ul").height()) / 2 + "px");
        a.find("> ul").css("bottom", "0px");
        return !1;
    });

    $(".sub-close").click(function() {
        $(this).closest("ul").removeAttr("style");
        $(this).closest(".has-sub").removeClass("open");
    });

    $("body").on("click", ".navbar-toggle-close, .navbar-toggle", function() {
        var a = $(".navigation, .navbar-close");
        if (a.hasClass("open")) {
        	a.removeClass("open");
        	$(".full-height-wrapper > .table > .table-cell > ul > li").removeClass("animated");
        } else {
            a.addClass("open");
            var e = 250;
            $(".full-height-wrapper > .table > .table-cell > ul > li").each(function() {
                var a = $(this);
                e += 100;
                setTimeout(function() {
                    a.addClass("animated");
                }, e);
            });
        }
        return !1;
    });

	// menu fixed style2
	var $navbarStyle2 = $( '.navbar-fixed-top' );

	menuFixedButton( $navbarStyle2 );

	$( window ).on( 'scroll', function() {
		menuFixedButton( $navbarStyle2 );
	} );

	/* ------------------------------------
	 * Menu END
	 -------------------------------------*/

}
/* ------------------------------------
 * Ready function END
 -------------------------------------*/

/* ------------------------------------
 * Menu style2 scroll START
 -------------------------------------*/
function menuFixedButton( $navbarStyle2 ) {

	if ( $( this ).scrollTop() >= 100 ) {
		$navbarStyle2.addClass( 'scrolled' );
	} else {
		if ( $navbarStyle2.hasClass( 'scrolled' ) ) {
			$navbarStyle2.removeClass( 'scrolled' );
		}
	}
}
/* ------------------------------------
 * Menu style2 scroll END
 -------------------------------------*/

/* ------------------------------------
 * Section Background START
 -------------------------------------*/
function styleHelper () {

	$( '[data-color]' ).each( function(){
        $( this ).css( "color", $( this ).data( "color" ) );
	} );

	$( '[data-border-color]' ).each( function(){
        $( this ).css( "border-color", $( this ).data( "border-color" ) );
	} );

	$( '[data-background]' ).each( function(){
        $( this ).css( "background-image", "url(" + $( this ).data( "background" ) + ")" );
	} );

	$( '[data-background-color]' ).each( function() {
		$( this ).css( "background-color", $( this ).data( "background-color" ) );
	} );

	$( '[data-overlay-color]' ).each( function() {
		$( this ).css( 'z-index', 0 );
		if ( $( this ).find( '.overlay' ).length === 0 ) {
			$( this ).append( '<div class="overlay" style="background-color: ' + $( this ).data( "overlay-color" ) + '; opacity: ' + $( this ).data( "overlay-opacity" ) + '"></div>' );
		}
	} );
}
/* ------------------------------------
 * Section Background END
 -------------------------------------*/

/* ------------------------------------
 * Home video bg START
 -------------------------------------*/
function onScroll(){
	var $navbarStyle2 = $( '.navbar-fixed-top' );
	menuFixedButton( $navbarStyle2 );

	var scrollPos = $(document).scrollTop();

    if ( $( 'body' ).hasClass( 'scrollTo' ) ) {
    	return false;
    }

    $( '.navigation li a:not(.page-load, .single-page-load)' ).each(function () {

    	var attr = $(this).attr('target');
    	if (typeof attr !== typeof undefined && attr !== false) {
    		return false;
    	}

        var currLink = $(this);
        var refElement = $( currLink.attr( 'href' ) );

		if ( refElement.length === 1 ) {
			if ( refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos ) {
				$( '.navigation li' ).removeClass( 'active' );
				currLink.closest( 'li' ).addClass( 'active' );
			} else{
				currLink.closest( 'li' ).removeClass( 'active' );
			}
		}
	});
}
