( function( $ ) {

	// Document ready start.
	$(function() {

		/**
		* Search results
	 	*/
	    // $('.a11y-overlaysearch__input').on( 'propertychange change click keyup input paste', debounce(function() {
	    //   let search = $('.a11y-overlaysearch__input').val();
	    //   let theme = theme_name.get_themename;
	    //   let lang = document.documentElement.lang.substr(0, 2);
	    //   let no_results = translations.no_results_found;

	    //   if ( ! search.trim() ) {
	    //     $('.a11y-overlaysearch_results').empty();
	    //     return;
	    //   }

	    //   $.getJSON( "/wp-json/" + theme + "/v2/search?s=" + search + "&lang=" + lang, function(results) {
	    //     $('.a11y-overlaysearch_results').empty();

	    //     if ( results.length === 0 ) {
	    //       $('.a11y-overlaysearch_results').append( '<li class="no-results"><p>' + no_results + '</p></li>' );
	    //     } else {
	    //       $.each( results, function( i, result ) {
	    //         $('.a11y-overlaysearch_results').append( '<li><p><a href="' + result.permalink + '"><span class="title">' + result.title + '</span><span class="post-type-badge">' + result.post_type + '</span></a></p></li>' );
	    //       } );
	    //     }
	    //   } );
	    // }, 250) );

    	/**
	 	* Debounce
	 	*/
	    // function debounce(func, wait, immediate) {
	    //   let timeout;
	    //   return function() {
	    //     let context = this, args = arguments;
	    //     let later = function() {
	    //       timeout = null;
	    //       if (!immediate) func.apply(context, args);
	    //     };
	    //     let callNow = immediate && !timeout;
	    //     clearTimeout(timeout);
	    //     timeout = setTimeout(later, wait);
	    //     if (callNow) func.apply(context, args);
	    //   };
	    // };

		// Open overlay search from button.
		$('.a11y-overlaysearch__open').click(function(e) {
			toggleSearch();
		});

		// Close overlay search from button.
		$('.a11y-overlaysearch__close').click(function(e) {
			toggleSearch();
		});

		// Close search by clicking anywhere outside form.
		window.onclick = function(event) {
			if ( $(event.target).hasClass( 'a11y-overlaysearch__dialog--show' ) ) {
				toggleSearch();
			}
		}

		// Close search from escape and allow scrolling again.
		$(document).keydown(function(e){
			if ( $('body').hasClass('a11y-overlaysearch__dialog-visible') && (e.keyCode == 27) ) {
				toggleSearch();
			}
		});

	});

	/**
	 * Create toggle functionality to open/close search dialog.
	 */
	function toggleSearch() {
		let elements = $('div, footer, header, a, button, form, input, select').not('.a11y-overlaysearch__dialog, .a11y-overlaysearch__dialog *');

		$('.a11y-overlaysearch__dialog').toggleClass('a11y-overlaysearch__dialog--show');
		$('body').toggleClass('a11y-overlaysearch__dialog-visible');

		if ( $('.a11y-overlaysearch__dialog').hasClass('a11y-overlaysearch__dialog--show') ) {
			elements.attr('aria-hidden', 'true');
			$('.a11y-overlaysearch__input').focus();
		} else {
			elements.removeAttr('aria-hidden');
			$('.a11y-overlaysearch__open').focus();
		}
	}

} )( jQuery );

// Focus  trap for a11y-overlaysearch__dialog.
window.addEventListener('keydown', handleKey);

function handleKey(e) {
	if (e.keyCode === 9) {
		// focusable elements
		let focusable = document.querySelector('.a11y-overlaysearch__dialog').querySelectorAll('input, button, a');

		if ( focusable.length ) {
			let first = focusable[0];
			let last = focusable[focusable.length - 1];
			let shift = e.shiftKey;

			if (shift) {
				if (e.target === first) { // shift-tab pressed on first input in dialog
					last.focus();
					e.preventDefault();
				}
			} else {
				if (e.target === last) { // tab pressed on last input in dialog
					first.focus();
					e.preventDefault();
				}
			}
		}
	}
}