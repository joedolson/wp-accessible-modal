(function () {
	// Locate buttons being deferred to other controls.
	var wpam_button = document.querySelectorAll( '.js-modal-hidden' );
	console.log( wpam_button );
	wpam_button.forEach( (el) => {
		var target      = el.getAttribute( 'data-control' );
		var targetEl    = document.querySelector( target );
		console.log( targetEl );
		console.log( target );
		if ( targetEl ) {
			var classVal = el.getAttribute( 'data-modal-prefix-class' );
			var contentId = el.getAttribute( 'data-modal-content-id' );
			var modalTitle = el.getAttribute( 'data-modal-title' );
			var closeText = el.getAttribute( 'data-modal-close-text' );

			targetEl.removeAttribute( 'target' );
			targetEl.classList.add( 'js-modal' );
			targetEl.setAttribute( 'data-modal-prefix-class', classVal );
			targetEl.setAttribute( 'data-modal-content-id', contentId );
			targetEl.setAttribute( 'data-modal-title', modalTitle );
			targetEl.setAttribute( 'data-modal-close-text', closeText );
		} else {
			console.log( target + ' was not found' );
		}
	});
})();