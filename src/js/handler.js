(function () {
	// Locate buttons being deferred to other controls.
	var wpam_button = document.querySelectorAll( '.js-modal-hidden' );
	wpam_button.forEach( (el) => {
		var target   = el.getAttribute( 'data-control' );
		var targetEl = document.querySelector( target );
		if ( targetEl ) {
			var classVal = el.getAttribute( 'data-modal-prefix-class' );
			var contentId = el.getAttribute( 'data-modal-content-id' );
			var modalTitle = el.getAttribute( 'data-modal-title' );
			var closeText = el.getAttribute( 'data-modal-close-text' );
			var external  = el.classList.contains( 'wpam-external' ) ? true : false;

			targetEl.removeAttribute( 'target' );
			targetEl.classList.add( 'js-modal', 'wpam-modal' );
			if ( external ) {
				targetEl.classList.add( 'wpam-external' );
			}
			targetEl.setAttribute( 'data-modal-prefix-class', classVal );
			targetEl.setAttribute( 'data-modal-content-id', contentId );
			targetEl.setAttribute( 'data-modal-title', modalTitle );
			targetEl.setAttribute( 'data-modal-close-text', closeText );
			el.remove();
		} else {
			console.log( target + ' was not found' );
		}
	});

	var wpam_external_buttons = document.querySelectorAll( '.wpam-external' );
	wpam_external_buttons.forEach( (el) => {
		var content   = el.getAttribute( 'data-modal-content-id' );
		var contentEl = document.querySelector( '#' + content );
		contentEl.classList.add( 'modal-content' );
	});
})();