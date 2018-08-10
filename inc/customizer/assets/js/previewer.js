/**
 * Portum Previewer Scripts
 *
 * @type {{}}
 */

/**
 * Sort'of document ready
 */
(function( $ ) {
  $( document ).ready( function() {
    if ( 'undefined' === typeof wp || ! wp.customize || ! wp.customize.selectiveRefresh ) {
      return;
    }

    wp.customize.selectiveRefresh.bind( 'widget-updated', function( placement ) {
      // Portum.Theme.footerLogo();
    } );
  } );
})( jQuery );
