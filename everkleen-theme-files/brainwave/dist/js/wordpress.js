var $ = jQuery;
$(document).ready(function() {
	"use strict";
	/* ------------------------------------
	 * Magnific Popups START
	 -------------------------------------*/
	$('.wp-tiles-tile').click( function( event ) {
		event.preventDefault();
		$.magnificPopup.open({
			delegate: 'a',
			items: {
				src: $(this).find('.wp-tiles-tile-bg').css('background-image').replace('url("','').replace('")',''),
			},
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			image: {
				verticalFit: true,
			},
			mainClass: 'mfp-no-margins mfp-with-zoom',
		});
	});

	// Portfolio Popup
	$('.ajax-popup-link').click( function( event ) {
		event.preventDefault();
		$.magnificPopup.open({
  		type: 'ajax',
			items: {
				src: $(this).attr('href'),
			},
			modal:true,

			mainClass: 'mfp-portfolio',
			callbacks: {
			  ajaxContentAdded: function() {
					carousel();
					init();
					$('.mfp-portfolio .mfp-content').append('<button title="%title%" type="button" class="mfp-close">&#215;</button>');
			  }
			}
		});
	});


	$('.thumbnail.img-thumbnail').click( function( event ) {
		event.preventDefault();
		$.magnificPopup.open({
			delegate: 'a',
			items: {
				src: $('img', this).attr('src'),
			},
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			image: {
				verticalFit: true,
			},
			mainClass: 'mfp-no-margins mfp-with-zoom',
		});
	});


	$('.wp-caption').magnificPopup({
		delegate: 'a',
		mainClass: 'mfp-no-margins mfp-with-zoom',
		closeOnContentClick: true,
		closeBtnInside: false,
	  image: {
	  	verticalFit: true,
	  },
	  type: 'image',
	  zoom: {
	  	enabled: true,
	  	duration: 100,
	  }
	});
	/* ------------------------------------
	 * Magnific Popups END
	 -------------------------------------*/

	resizeIframe();

	/* ------------------------------------
	 * Comments Form Validation START
	 -------------------------------------*/
	$( 'body' ).on( 'submit', '#commentform', function ( e ) {
		e.preventDefault();
		var $this =	$( this );
		if ( $this.hasClass( 'send' ) ) {
			return false;
		}

		$this.addClass( 'send' );
		var stop = false;
		$( '.form-control', this ).each(function(){
			if ( $(this).attr('aria-required') === 'true' && $(this).val() === '' ) {
				$( '#' + $(this).attr('id'), $this ).css({
					"border-color": "rgba(255, 159, 136, 1)",
				});
				stop = true;
			} else if ( $(this).attr('id')==='email' && ! isValidEmailAddress( $(this).val() ) ) {
				$( '#' + $(this).attr('id'), $this ).css({
					"border-color": "rgba(255, 159, 136, 1)",
				});
				stop = true;
			} else {
				$( '#' + $(this).attr('id'), $this ).css({
					"border-color": "#e9e9e9",
				});
			}
		});

		if ( stop ) {
			$this.removeClass( 'send' );
		} else if ( ! stop ) {
			$this.ajaxSubmit({url: $this.attr('action'), type: 'post'});
			$( '.form-control', this ).each(function(){
				$(this).val('');
			});
			$this.removeClass( 'send' );
		}

	} );
	/* ------------------------------------
	 * Comments Form Validation END
	 -------------------------------------*/

	 /* ------------------------------------
 	 * Price Filter START
 	 -------------------------------------*/
	$( 'body' ).on( "slidestop", "#price-range", function() {
		var sort = $( '.select-sorting .list li[data-selected="selected"]' ).data('id');
	 	filter_products(sort);
	});
	$( 'body' ).on( "click", ".select-sorting .list li", function(){
		var sort = $(this).data('id');
		filter_products(sort);
	});
 	/* ------------------------------------
 	 * Price Filter END
 	 -------------------------------------*/

	/* ------------------------------------
	 * Ajax load page START
	 -------------------------------------*/
	 $(document).on('pjax:send', function(e) {
	 		$( 'body' ).addClass( 'load' );
	 	});

	 	$(document).on('pjax:complete', function(e) {
	 		var portfolio = false;

	 		if (e.relatedTarget) {
	 			var url = $(e.relatedTarget).attr('href'),
	 				hash = url.substring(url.indexOf('#'));

	 			if ($(e.relatedTarget).hasClass('work-all')) {
	 				portfolio = true;
	 			}
	 		}

	 		setTimeout(function() {
	 			init();
	 			mapInit();
	 			slider();
	 			styleHelper();
	 			carousel();
	 			isotopeInit();

	 			$('.navigation li').removeClass( 'active' );
	 			$( '[href="' + url + '"]' ).parent('li').addClass( 'active' );
	 			$( '[href="' + hash + '"]' ).parent('li').addClass( 'active' );
	 		}, 1);

	 		setTimeout(function() {

	 			if ( portfolio === true ) {
					$("html, body").animate({ scrollTop: $( '.portfolio' ).position().top }, 1);
	 			} else if (url === hash) {
	 				$("html, body").animate({ scrollTop: 0 }, 1);
	 			} else {
	 				$("html, body").animate({ scrollTop: $(hash).position().top }, 1);
	 			}

	 			setTimeout(function() {
	 				$( 'body' ).removeClass( 'load' );
	 			}, 200);

	 		}, 700);
	 	});

		$(document).on('pjax:timeout', function(event) {
			// Prevent default timeout redirection behavior
			event.preventDefault()
		})

	 	$(document).pjax('.page-load, .single-page-load', '.wrapper', {
	 		fragment: '.wrapper'
	 	});

	/* ------------------------------------
	 * Ajax load page END
	 -------------------------------------*/
});

// Responsive oembed video
function resizeIframe () {
    $( 'iframe' ).attr( 'width', $( 'iframe' ).parent().width() );
    $( 'iframe' ).attr( 'height', $( 'iframe' ).parent().width() / 1.4 );
    $( 'embed' ).attr( 'width', $( 'embed' ).parent().width() );
    $( 'embed' ).attr( 'height', $( 'embed' ).parent().width() / 1.4 );
}

$(window).resize(function () {
	resizeIframe();
});

function updateQueryStringParam(key, value) {
  baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
  urlQueryString = document.location.search;
  var newParam = key + '=' + value,
  params = '?' + newParam;

  // If the "search" string exists, then build params from it
  if (urlQueryString) {
    keyRegex = new RegExp('([\?&])' + key + '[^&]*');
    // If param exists already, update it
    if (urlQueryString.match(keyRegex) !== null) {
      params = urlQueryString.replace(keyRegex, "$1" + newParam);
    } else { // Otherwise, add it to end of query string
      params = urlQueryString + '&' + newParam;
    }
  }
  window.history.replaceState({}, "", baseUrl + params);
}

function filter_products(sort) {
		var $this = $(".products");
		$this.addClass( 'load' );

		updateQueryStringParam( 'min_price', $( '#price-range > input[name=curr_min_price]' ).val() );
		updateQueryStringParam( 'max_price', $( '#price-range > input[name=curr_max_price]' ).val() );
		updateQueryStringParam( 'orderby', sort );

		var url = document.URL;

		url = url.replace(/page\/.*\//, '');
		url = url.replace(/(&|\?)paged=\d+/, '');
		//var title = $(this).data('title');
		$( 'body' ).addClass( 'load' );

		setTimeout(function() {
			$( ".wrapper" ).load( url + ' .wrapper', function( response, status, xhr ) {

				if ( status == 'success' ) {
					window.history.pushState({path: url},'',url);
					//document.title = title;

					setTimeout(function() {
						init();
						slider();
						styleHelper();
						carousel();
						isotopeInit();

					}, 1);

					$(document).on( 'scroll' , onScroll);

					onScroll();

					setTimeout(function() {

						setTimeout(function() {
							$( 'body' ).removeClass( 'load' );
						}, 200);

					}, 700);
				}
			});
		}, 300);

	}

	function isValidEmailAddress(emailAddress) {
	    var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return pattern.test(emailAddress);
	}
