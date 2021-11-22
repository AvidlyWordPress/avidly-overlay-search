( function( $ ) {

  // document ready start
  $(function() {

	let elements = $('div, footer, header, a, button, form, input, select').not('.a11y-overlaysearch__dialog, .a11y-overlaysearch__dialog *');

	// Open overlay search from button.
	$('.a11y-overlaysearch__open').click(function(e) {
		$('.a11y-overlaysearch__dialog').addClass('a11y-overlaysearch__dialog--show');
		$('body').addClass('a11y-overlaysearch__dialog-visible');
		elements.attr('aria-hidden', 'true');
		$('.a11y-overlaysearch__input').focus();
		console.log( $('.a11y-overlaysearch__input') );
	});

	// Close overlay search from button.
	$('.a11y-overlaysearch__close').click(function(e) {
		$('.a11y-overlaysearch__dialog').removeClass('a11y-overlaysearch__dialog--show');
		$('body').removeClass('a11y-overlaysearch__dialog-visible');
		elements.removeAttr('aria-hidden');
		$('.a11y-overlaysearch__open').focus();
	});

	// Close search by clicking anywhere outside form.
	window.onclick = function(event) {
		if ( $(event.target).hasClass( 'a11y-overlaysearch__dialog--show' ) ) {
			$('.a11y-overlaysearch__dialog').removeClass('a11y-overlaysearch__dialog--show');
			$('body').removeClass('a11y-overlaysearch__dialog-visible');
			elements.removeAttr('aria-hidden');
			$('.a11y-overlaysearch__open').focus();
		}
	}

	// Close search from escape and allow scrolling again.
	$(document).keydown(function(e){
		if(e.keyCode == 27) {
			$('.a11y-overlaysearch__dialog').removeClass('a11y-overlaysearch__dialog--show');
			$('body').removeClass('a11y-overlaysearch__dialog-visible');
			elements.removeAttr('aria-hidden');
			$('.a11y-overlaysearch__open').focus();
		}
	});

  });
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