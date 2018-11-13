(function( $ ) {
	'use strict';
	/**
	 * Window scroll events
	 */
	$( window ).scroll( function() {
		/**
		 * Initiate plugins
		 */
		try {
			Portum.Plugins.animateCounters();
			Portum.Plugins.animateProgress();
			Portum.Plugins.animatePieCharts();
			Portum.Theme.hideBackTop();
			Portum.Theme.header();
		} catch ( error ) {

		}
	} );

	/**
	 * Window resize event
	 */
	$( window ).resize( function() {
		Portum.Plugins.animatePieCharts();
		Portum.Plugins.setDimensionsPieCharts();
		Portum.Theme.header();
	} );

	/**
	 * Document ready event
	 */
	$( document ).ready( function( $ ) {
		/**
		 * Initiate plugins
		 */
		try {
			Portum.Plugins.advancedSlider();
			Portum.Plugins.video();
			Portum.Plugins.magnificPopup();
			Portum.Plugins.animateCounters();
			Portum.Plugins.animateProgress();
			Portum.Plugins.animatePieCharts();
			Portum.Plugins.setDimensionsPieCharts();

			/**
			 * Initiate Theme related functions
			 */
			Portum.Theme.header();
			Portum.Theme.menu();
			Portum.Theme.classicMenu();
			Portum.Theme.offCanvasMenu();
			Portum.Theme.map();
			Portum.Theme.backTop();
			Portum.Theme.hideBackTop();
			Portum.Theme.smoothScroll();
			Portum.Theme.handleAccordions();

		} catch ( error ) {
			console.log( error );
		}
	} );

	$( document ).on( 'epsilon-selective-refresh-ready', function() {
		/**
		 * Initiate plugins
		 */
		Portum.Plugins.advancedSlider();
		Portum.Plugins.video();
		Portum.Plugins.magnificPopup();
		Portum.Plugins.animateCounters();
		Portum.Plugins.animateProgress();
		Portum.Plugins.animatePieCharts();
		Portum.Plugins.setDimensionsPieCharts();

		/**
		 * Initiate theme scripts
		 */
		Portum.Theme.map();
		Portum.Theme.header();
		Portum.Theme.menu();
		Portum.Theme.classicMenu();
		Portum.Theme.offCanvasMenu();

		/**
		 * Initiate Event related functions
		 */

	} );

})( jQuery );