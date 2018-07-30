(function($) {
	'use strict';
	/**
	 * Window scroll events
	 */
	$(window).scroll(function() {
		/**
		 * Initiate plugins
		 */
		try {
			Portum.Theme.animations();
			Portum.Plugins.animateCounters();
			Portum.Plugins.animateProgress();
			Portum.Plugins.animatePieCharts();
			Portum.Theme.hideBackTop();
			Portum.Theme.header();
		} catch (error) {

		}
	});

	/**
	 * Window resize event
	 */
	$(window).resize(function() {
		Portum.Mobile.menu();
		Portum.Plugins.animatePieCharts();
		Portum.Plugins.setDimensionsPieCharts();
		Portum.Theme.header();
	});

	/**
	 * Document ready event
	 */
	$(document).ready(function($) {
		/**
		 * Initiate plugins
		 */
		try {
			Portum.Plugins.owlSlider();
			Portum.Plugins.clientList();
			Portum.Plugins.advancedSlider();
			Portum.Plugins.video();
			Portum.Plugins.videoSections($);
			Portum.Plugins.magnificPopup();
			Portum.Plugins.animateCounters();
			Portum.Plugins.animateProgress();
			Portum.Plugins.animatePieCharts();
			Portum.Plugins.setDimensionsPieCharts();

			/**
			 * Initiate Theme related functions
			 */
			Portum.Theme.header();
			Portum.Theme.map();
			Portum.Theme.blog();
			Portum.Theme.menu();
			Portum.Theme.animations();
			Portum.Theme.newsletter();
			Portum.Theme.backTop();
			Portum.Theme.hideBackTop();
			Portum.Theme.footerLogo();
			Portum.Theme.smoothScroll();
			Portum.Theme.contact();

			/**
			 * Mobile functions
			 */
			Portum.Mobile.testimonials();
			Portum.Mobile.blog();
			Portum.Mobile.menu();
		} catch (error) {
			console.log(error);
		}
	});

	$(document).on('epsilon-selective-refresh-ready', function() {
		/**
		 * Initiate plugins
		 */
		Portum.Plugins.owlSlider();
		Portum.Plugins.clientList();
		Portum.Plugins.advancedSlider();
		Portum.Plugins.video();
		Portum.Plugins.videoSections($);
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
	});

})(jQuery);