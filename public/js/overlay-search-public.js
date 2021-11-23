( function( $ ) {

	// Document ready start.
	$(function() {

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
			if(e.keyCode == 27) {
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