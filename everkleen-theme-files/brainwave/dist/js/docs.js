$( document ).ready(function(){
	'use strict';
	$( '.prettyprint' ).each(function() {
		$( this ).html( $( this ).html().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;') );

		$( this ).niceScroll({
			cursorcolor: '#222222',
			zindex: 9999,
			cursorborder: 'none',
			cursorborderradius: 0,
			mousescrollstep: 60,
			railpadding: {
				top: 5,
				right: 5,
				left: 0,
				bottom: 5
			}
		});

	});

} );