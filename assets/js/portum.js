'use strict';
var Portum = {
  /**
   * Mobile Break Point
   */
  MOBILEBREAKPOINT: 991,
  /**
   * Map styles
   */
  mapStyle: [
    {
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#f5f5f5'
        }
      ]
    },
    {
      'elementType': 'labels.icon',
      'stylers': [
        {
          'visibility': 'off'
        }
      ]
    },
    {
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#616161'
        }
      ]
    },
    {
      'elementType': 'labels.text.stroke',
      'stylers': [
        {
          'color': '#f5f5f5'
        }
      ]
    },
    {
      'featureType': 'administrative.land_parcel',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#bdbdbd'
        }
      ]
    },
    {
      'featureType': 'poi',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#eeeeee'
        }
      ]
    },
    {
      'featureType': 'poi',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#757575'
        }
      ]
    },
    {
      'featureType': 'poi.park',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#e5e5e5'
        }
      ]
    },
    {
      'featureType': 'poi.park',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#9e9e9e'
        }
      ]
    },
    {
      'featureType': 'road',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#ffffff'
        }
      ]
    },
    {
      'featureType': 'road.arterial',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#757575'
        }
      ]
    },
    {
      'featureType': 'road.highway',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#dadada'
        }
      ]
    },
    {
      'featureType': 'road.highway',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#616161'
        }
      ]
    },
    {
      'featureType': 'road.local',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#9e9e9e'
        }
      ]
    },
    {
      'featureType': 'transit.line',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#e5e5e5'
        }
      ]
    },
    {
      'featureType': 'transit.station',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#eeeeee'
        }
      ]
    },
    {
      'featureType': 'water',
      'elementType': 'geometry',
      'stylers': [
        {
          'color': '#c9c9c9'
        }
      ]
    },
    {
      'featureType': 'water',
      'elementType': 'labels.text.fill',
      'stylers': [
        {
          'color': '#9e9e9e'
        }
      ]
    }
  ],
  /**
   * Plugin related functions
   */
  Plugins: {
    /**
     * Initiate the magnific Popup
     */
    magnificPopup: function() {
      jQuery( '.magnific-link' ).magnificPopup( { type: 'image' } );
    },
    /**
     * Initiate owl slider
     * @todo won't work if there are more than 1 sliders on page
     */
    owlSlider: function() {
      var owl = jQuery( '.main-slider' );
      if ( owl.length ) {
        owl.on( 'initialized.owl.carousel', function() {
          jQuery( '.pager-slider' ).addClass( 'active' );
        } );

        owl.owlCarousel( {
          items: 1,
          dots: true,
          mouseDrag: true,
          navText: '',
          nav: false,
          navClass: '',
          autoplay: true,
          loop: true,
          autoplayTimeout: 5000,
          responsive: {
            1: {
              nav: false
            },
            600: {
              nav: false
            },
            991: {
              nav: false
            },
            1300: {
              nav: false
            }
          }
        } ).on( 'translated.owl.carousel', function( event ) {
          jQuery( '.pager-slider li.active' ).removeClass( 'active' );
          jQuery( '.pager-slider li:eq(' + event.page.index + ')' ).addClass( 'active' );
        } );

        jQuery( '.pager-slider li' ).click( function() {
          var slide_index = jQuery( this ).index();
          owl.trigger( 'to.owl.carousel', [ slide_index, 300 ] );
          return false;
        } );
      }
    },
    /**
     * Initiate Plyr library on video elements
     */
    video: function() {
      var instances = plyr.setup( {
        debug: false,
        controls: []
      } );
    }
  },
  /**
   * Theme related functions
   */
  Theme: {
    /**
     * Footer logo resizing ( applies a class if some conditions are met )
     */
    footerLogo: function() {
      var footer = jQuery( '#footer' ),
          widgets,
          image;

      if ( footer.length ) {
        widgets = jQuery( '[id^=\'footer-widget-area-\']' );
        /**
         * In case there's more than 1 widget areas, terminate
         */
        if ( widgets.length > 1 ) {
          return false;
        }

        image = widgets.find( '[id^=\'media_image-\']' );
        /**
         * In case there's more than 1 media widget, terminate
         */
        if ( image.length > 1 ) {
          return false;
        }

        image.addClass( 'footer-logo' );
      }
    },
    /**
     * Back to top function
     */
    backTop: function() {
      if ( jQuery( window ).scrollTop() > jQuery( window ).height() / 2 ) {
        jQuery( '#back-to-top' ).removeClass( 'gone' ).addClass( 'visible' );
      } else {
        jQuery( '#back-to-top' ).removeClass( 'visible' ).addClass( 'gone' );
      }

      jQuery( '#back-to-top' ).on( 'click', function() {
        jQuery( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
        return false;
      } );
    },
    /**
     * Generate the contact map based on an address
     */
    map: function() {
      var geocoder = new google.maps.Geocoder(),
          self = this,
          address = jQuery( '#contact-map' );
      if ( ! address.length ) {
        return;
      }

      geocoder.geocode( {
        'address': address.attr( 'data-address' )
      }, function( results, status ) {
        if ( status === google.maps.GeocoderStatus.OK ) {
          self._mapCallback( results, address.attr( 'data-zoom' ) );
        }
      } );
    },
    /**
     * After we "find" out the center, initiate the map & marker
     * @param results
     * @param zoom
     * @private
     */
    _mapCallback: function( results, zoom ) {

      var map, marker, totalHeight,
          config = {
            zoom: parseFloat( zoom ),
            center: results[ 0 ].geometry.location,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            styles: Portum.mapStyle
          };

      map = new google.maps.Map( document.getElementById( 'contact-map' ), config );
      marker = new google.maps.Marker( {
        map: map,
        position: results[ 0 ].geometry.location
      } );

      totalHeight = jQuery( '.section-contact' ).height();
      map.panBy( 0, (totalHeight - 200) - (totalHeight / 2) );
    },

    /**
     * Blog Related functions
     */
    blog: function() {
      jQuery( '.post.sticky .post-thumbnail' ).each( function() {
        var $image = jQuery( 'img', this ),
            parent = jQuery( this );

        $image.on( 'load', function() {
          $image.clone().addClass( 'effect' ).insertAfter( $image );
          $image.clone().addClass( 'effect' ).insertAfter( $image );

          $image.addClass( 'animate' );
        } );

        if ( 'undefined' === typeof $image[ 0 ] ) {
          return;
        }

        if ( $image[ 0 ].complete ) {
          $image.load();
        }

      } );

      jQuery( '.post-thumbnail-preloader' ).each( function() {
        var $image = jQuery( 'img', this ),
            parent = jQuery( this ).closest( '.post-thumbnail-preloader' );

        $image.on( 'load', function() {
          jQuery( '.preloader', parent ).addClass( 'preloaded' );
        } );

        if ( $image[ 0 ].complete ) {
          $image.load();
        }

      } );

    },

    /**
     * Dropdown menu
     */
    menu: function() {
      if ( typeof jQuery.fn.superfish !== 'undefined' ) {
        jQuery( '#menu' ).superfish( {
          delay: 500,
          animation: { opacity: 'show', height: 'show' },
          speed: 100,
          cssArrows: false
        } );
      }

      jQuery( '#mobile-menu-trigger' ).click( function( event ) {
        var $t = jQuery( this ),
            $n = jQuery( '#mobile-menu' );

        if ( $t.hasClass( 'mobile-menu-opened' ) ) {
          $t.removeClass( 'mobile-menu-opened' ).addClass( 'mobile-menu-closed' );
          $n.slideUp( 300 );
        } else {
          $t.removeClass( 'mobile-menu-closed' ).addClass( 'mobile-menu-opened' );
          $n.slideDown( 300 );
        }
        event.preventDefault();
      } );

    },

    /**
     * Section Animations
     */
    animations: function() {
      jQuery( '.section:in-viewport' ).each( function() {
        jQuery( this ).addClass( 'animate' );
      } );

      jQuery( '.post-thumbnail-preloader:in-viewport' ).each( function() {
        jQuery( this ).addClass( 'animate' );
      } );

    },

    /**
     * Homepage contact form
     */
    contact: function() {
      jQuery( '.contact-action' ).click( function() {
        jQuery( '.contact-form-content' ).slideDown( '500' );
        jQuery( '.contact-action' ).hide();
      } );

      jQuery( '.contact-trigger' ).click( function() {
        jQuery( '.contact-form-content' ).slideUp( '500', function() {
          jQuery( '.contact-action' ).show();
        } );
      } );
    },
    /**
     * Newsletter form "styling"
     */
    newsletter: function() {
      jQuery( '#mc_mv_EMAIL' ).attr( 'placeholder', 'Email address' );
      /**
       * @todo add them in css
       */
      jQuery( '.mc_header_email' ).css( 'display', 'none' );
      jQuery( '#mc_signup_submit' ).css( { 'margin-top': 0, 'width': 'initial' } );
    }
  },
  /**
   * Mobile related functions
   */
  Mobile: {
    /**
     * Testimonials
     */
    testimonials: function() {
      jQuery( '.hidden-testimonial' ).slice( 0, 1 ).show();
      jQuery( '.show-more-comments' ).on( 'click', function( e ) {
        var hidden = jQuery( '.hidden-testimonial:hidden' );
        e.preventDefault();
        hidden.slice( 0, 1 ).fadeIn( 'fast' );
        if ( 0 === hidden.length ) {
          jQuery( '.show-more-comments' ).fadeOut( 'slow' );
        }
      } );

    },

    /**
     * Blog
     */
    blog: function() {
      jQuery( '.item-carousel-blog' ).slice( 0, 1 ).show();
      jQuery( '.blog-load-more' ).on( 'click', function( e ) {
        var hidden = jQuery( '.item-carousel-blog:hidden' );
        e.preventDefault();
        hidden.slice( 0, 1 ).slideDown();
        if ( 0 === hidden.length ) {
          jQuery( '#load' ).slideUp();
        }

        jQuery( '.blog-carousel-mobile' ).animate( {
          scrollTop: jQuery( this ).offset().top
        }, 500 );
      } );
    },

    /**
     * Mobile menu
     */
    menu: function() {
      if ( jQuery( window ).width() > Portum.MOBILEBREAKPOINT ) {
        jQuery( '#mobile-menu' ).hide();
        jQuery( '#mobile-menu-trigger' ).removeClass( 'mobile-menu-opened' ).addClass( 'mobile-menu-closed' );

      } else if ( ! jQuery( '#mobile-menu' ).length ) {
        jQuery( '#menu' ).clone().attr( {
          id: 'mobile-menu',
          'class': ''
        } ).insertAfter( '#header' );

        jQuery( '#mobile-menu > li > a, #mobile-menu > li > ul > li > a' ).each( function() {
          var $t = jQuery( this );
          if ( $t.next().hasClass( 'sub-menu' ) || $t.next().is( 'ul' ) || $t.next().is( '.sf-mega' ) ) {
            $t.append( '<span class="fa fa-angle-down mobile-menu-submenu-arrow mobile-menu-submenu-closed"></span>' );
          }
        } );

        jQuery( '.mobile-menu-submenu-arrow' ).on( 'click', function( event ) {
          var $t = jQuery( this );
          if ( $t.hasClass( 'mobile-menu-submenu-closed' ) ) {
            $t.removeClass( 'mobile-menu-submenu-closed fa-angle-down' ).addClass( 'mobile-menu-submenu-opened fa-angle-up' ).parent().siblings( 'ul, .sf-mega' ).slideDown( 300 );
          } else {
            $t.removeClass( 'mobile-menu-submenu-opened fa-angle-up' ).addClass( 'mobile-menu-submenu-closed fa-angle-down' ).parent().siblings( 'ul, .sf-mega' ).slideUp( 300 );
          }
          event.preventDefault();
        } );

        jQuery( '#mobile-menu li, #mobile-menu li a, #mobile-menu ul' ).attr( 'style', '' );
      }
    }
  },
  /**
   * Javascript events in the theme
   */
  Events: {},
  /**
   * Helper functions
   */
  Helpers: {}
};
