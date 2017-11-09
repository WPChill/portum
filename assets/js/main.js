(function( $ ) {
  'use strict';
  /**
   * Window scroll events
   */
  $( window ).scroll( function() {
    Portum.Theme.animations();
  } );

  /**
   * Window resize event
   */
  $( window ).resize( function() {
    Portum.Mobile.menu();
  } );

  /**
   * Document ready event
   */
  $( document ).ready( function() {
    /**
     * Initiate plugins
     */
    Portum.Plugins.owlSlider();
    Portum.Plugins.video();
    Portum.Plugins.magnificPopup();

    /**
     * Initiate Theme related functions
     */
    Portum.Theme.map();
    Portum.Theme.blog();
    Portum.Theme.menu();
    Portum.Theme.animations();
    Portum.Theme.contact();
    Portum.Theme.newsletter();
    Portum.Theme.backTop();
    Portum.Theme.footerLogo();

    /**
     * Mobile functions
     */
    Portum.Mobile.testimonials();
    Portum.Mobile.blog();
    Portum.Mobile.menu();
  } );

  $( document ).on( 'epsilon-selective-refresh-ready', function() {
    /**
     * Initiate plugins
     */
    Portum.Plugins.owlSlider();
    Portum.Plugins.video();
    Portum.Plugins.magnificPopup();
  } );

})( jQuery );
