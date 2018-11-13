/*jshint strict:false */
/* jshint -W079 */
var Portum = {
	/**
	 * Mobile Break Point
	 */
	MOBILEBREAKPOINT: 991,
	sticky_header: false,
	sticky_point: -1,
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
		 * Initiate Slick slider
		 */
		advancedSlider: function() {
			if ( typeof jQuery.fn.slick !== 'undefined' ) {
				jQuery( '.ewf-slider' ).each( function( index, element ) {
					let self = jQuery( element );

					let slider = self.find( '.ewf-slider__slides' );
					let slides = slider.children().length;
					let slidesToShow = self.data( 'slides-shown' );
					if ( slidesToShow > slides ) {
						slidesToShow = slides;
					}

					if ( slider.hasClass( 'slick-initialized' ) ) {
						return true;
					}

					slider.slick( {
						//lazyLoad: self.data( 'slider-lazyload' ) ? 'ondemand' : false,
						slidesToShow: slidesToShow,
						slidesToScroll: self.data( 'slides-scrolled' ),
						//centerMode: self.data( 'slides-centermode' ),
						adaptiveHeight: false,
						fade: false,
						cssEase: 'linear',
						speed: self.data( 'slider-speed' ) ? parseInt( self.data( 'slider-speed' ), 10 ) : 500,
						autoplay: self.data( 'slider-autoplay' ),
						infinite: self.data( 'slider-loop' ),
						arrows: self.data( 'slider-enable-controls' ),
						prevArrow: '<button type="button" aria-label="Previous" role="button" class="slick-arrow slick-arrow--prev">Prev</button>',
						nextArrow: '<button type="button" aria-label="Next" role="button" class="slick-arrow slick-arrow--next">Next</button>',
						appendArrows: self.find( '.ewf-slider__arrows' ),
						dots: self.data( 'slider-enable-pager' ),
						appendDots: self.find( '.ewf-slider__pager' ),
						customPaging: function( slider, i ) {

							let current = i + 1;
							current = current < 10 ? "0" + current : current;

							let total = slider.slideCount;
							total = total < 10 ? "0" + total : total;

							return (
								'<button type="button" role="button" tabindex="0" class="slick-dots-button">\
								<span class="slick-dots-current">' + current + '</span>\
									<span class="slick-dots-separator"></span>\
									<span class="slick-dots-total">' + total + '</span>\
								</button>'
							);

						}
					} );

				} );
			}
		},
		/**
		 * Set Pie Chart Dimensions accordion to the width they occupy in the
		 */
		setDimensionsPieCharts: function() {
			jQuery( '.ewf-pie__chart' ).each( function( index, element ) {

				let self = jQuery( element ),
					n = self.parent().width(),
					r = self.data( 'barsize' );

				if ( n < r ) {
					r = n;
				}

				self.find( 'canvas' ).css( {
					'height': r,
					'width': r,
				} );

				self.find( '.ewf-pie__icon i' ).css( {
					'line-height': r + 'px',
					'font-size': r / 3
				} );

				self.parent().css( {
					'line-height': r + 'px'
				} )

			} );
		},
		/**
		 * Animate Pie Charts
		 */
		animatePieCharts: function() {
			if ( typeof jQuery.fn.easyPieChart !== 'undefined' ) {

				jQuery( '.ewf-pie__chart:in-viewport' ).each( function( index, element ) {

					let self = jQuery( element );

					n = self.parent().width(),
						r = self.data( 'barSize' ),
						l = 'square';

					if ( self.data( 'lineCap' ) !== undefined ) {
						l = self.attr( 'lineCap' );
					}

					if ( n < r ) {
						r = n;
					}

					self.easyPieChart( {
						animate: 1300,
						lineCap: l,
						lineWidth: self.attr( 'data-lineWidth' ),
						size: r,
						barColor: self.attr( 'data-barColor' ),
						trackColor: self.attr( 'data-trackColor' ),
						scaleColor: 'transparent',
						onStep: function( from, to, percent ) {
							jQuery( this.el ).find( '.ewf-pie__percent span' ).text( Math.round( percent ) );
						}

					} );

				} );

			}
		},
		animateProgress: function() {
			jQuery( '.ewf-progress__bar-liniar:in-viewport' ).each( function( index, element ) {

				let self = jQuery( element );

				if ( !self.hasClass( 'already-animated' ) ) {
					self.addClass( 'already-animated' );

					self.animate( {
						width: self.data( 'value' ) + '%'
					}, 2000 );
				}

			} );
		},
		/**
		 * Animate counters on page scroll
		 */
		animateCounters: function() {
			jQuery( '.ewf-counter__standard:in-viewport' ).each( function( index, element ) {

				let self = jQuery( element ),
					n = self.data( 'value' ),
					r = parseInt( self.data( 'speed' ), 10 );

				if ( !self.hasClass( 'already-animated' ) ) {
					self.addClass( 'already-animated' );
					jQuery( {
						countNum: self.text()
					} ).animate( {
						countNum: n
					}, {
						duration: r,
						easing: 'linear',
						step: function() {
							self.text( Math.floor( this.countNum ) );
						},
						complete: function() {
							self.text( this.countNum );
						}
					} );
				}

			} );

			if ( typeof window.Odometer !== 'undefined' ) {

				jQuery( '.ewf-counter__odometer:in-viewport' ).each( function( index ) {

					var newID = 'ewf-counter__odometer-' + index;

					this.id = newID;

					var value = jQuery( this ).attr( 'data-value' );

					if ( !jQuery( this ).hasClass( 'already-animated' ) ) {

						jQuery( this ).addClass( 'already-animated' );

						setTimeout( function() {
							document.getElementById( newID ).innerHTML = value;
						} );

					}

				} );

			}

		},
		/**
		 * Initiate the magnific Popup
		 */
		magnificPopup: function() {
			if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
				jQuery( '.magnific-link' ).magnificPopup( {
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [ 0, 1 ]
					},
				} );
			}
		},
		/**
		 * Initiate Plyr library on video elements
		 */
		video: function() {
			if ( typeof Plyr !== 'undefined' ) {
				let videos = jQuery( '.portum-video-area' );
				jQuery.each( videos, function( index, videoContainer ) {
					let video = jQuery( videoContainer ).find( 'div' );
					new Plyr( video );
				} );
			}
		}
	},
	/**
	 * Theme related functions
	 */
	Theme: {

		/**
		 * Function that handles accordion toggles
		 */
		handleAccordions: function() {

			jQuery( document ).on( 'click', '.accordion-item-toggle', function() {

				// show the clicked on panel
				jQuery( this ).next().slideToggle( 'fast' );

				// hide the other panels
				jQuery( '.accordion-item-content' ).not( $( this ).next() ).slideUp( 'fast' );

			} );

		},

		/**
		 * Initiate smooth scroll
		 */
		smoothScroll: function() {
			// Select all links with hashes
			jQuery( 'a[href*="#"]' )

			// Remove links that don't actually link to anything
				.not( '[href="#"]' ).click( function( event ) {

				// On-page links
				if (
					location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' ) &&
					location.hostname === this.hostname
				) {

					// Figure out element to scroll to
					let target = jQuery( this.hash );
					target = target.length ? target : jQuery( '[name=' + this.hash.slice( 1 ) + ']' );

					// Does a scroll target exist?
					if ( target.length ) {

						// Only prevent default if animation is actually gonna happen
						event.preventDefault();
						jQuery( 'html, body' ).animate( {
							scrollTop: target.offset().top
						}, 1000, function() {

							// Callback after animation
							// Must change focus!
							let target = jQuery( target );
							target.focus();
							if ( target.is( ':focus' ) ) { // Checking if the target was focused
								return false;
							} else {
								target.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
								target.focus(); // Set focus again
							}
						} );
					}
				}
			} );
		},

		/**
		 * =Sticky header
		 */

		header: function() {

			if ( Portum.sticky_point < 0 ) {
				Portum.sticky_point = 0;

				if ( jQuery( 'body' ).hasClass( 'sticky-header' ) ) {
					Portum.sticky_header = true;
					Portum.sticky_point = jQuery( '#header' ).outerHeight();
				}

			}

			var b = document.documentElement,
				e = false;

			function f() {

				window.addEventListener( 'scroll', function( h ) {

					if ( !e ) {
						e = true;
						setTimeout( d, 50 );
					}
				}, false );

				window.addEventListener( 'load', function( h ) {

					if ( !e ) {
						e = true;
						setTimeout( d, 50 );
					}
				}, false );
			}

			function d() {

				let h = c();

				if ( h >= Portum.sticky_point ) {
					jQuery( '#header' ).addClass( 'stuck' );
					jQuery( 'body' ).css( { marginTop: Portum.sticky_point } );
				} else {
					jQuery( '#header' ).removeClass( 'stuck' );
					jQuery( 'body' ).css( { marginTop: "" } );
				}
				e = false;
			}

			function c() {

				return window.pageYOffset || b.scrollTop;

			}

			if ( Portum.sticky_header ) {
				f();
			}
		},

		menu: function() {

			jQuery( '.menu-item-has-children' ).append( '<div class="arrow"></div>' );
			jQuery( '.menu-item-has-children > .arrow' ).on( 'click', function( e ) {
				jQuery( this ).toggleClass( 'is-active' );
				jQuery( this ).siblings( '.sub-menu' ).toggleClass( 'is-visible' );
			} );

		},

		classicMenu: function() {

			if ( ! jQuery( '#header.portum-classic' ).length ) {
				return;
			}

			jQuery( '.portum-menu-icon' ).on( 'click', function( e ) {
				e.preventDefault();
				jQuery( '.portum-menu-icon' ).toggleClass( 'portum-menu-icon--open' );
				jQuery( '.portum-menu' ).toggleClass( 'portum-menu--visible' );
			} );
		},

		offCanvasMenu: function() {

			if ( ! jQuery( '#header.portum-offcanvas' ).length ) {
				return;
			}

			jQuery( '.portum-menu-icon' ).on( 'click', function( e ) {
				e.preventDefault();

				if ( ! jQuery( '.offcanvas' ).hasClass( 'offcanvas--visible' ) ) {
					jQuery( '.offcanvas' ).addClass( 'offcanvas--visible' );
					jQuery( '.portum-menu-icon' ).addClass( 'portum-menu-icon--open' );
				}
				else {
					jQuery( '.offcanvas' ).removeClass( 'offcanvas--visible' );
					jQuery( '.portum-menu-icon' ).removeClass( 'portum-menu-icon--open' );
				}
			} );

		},

		/**
		 * Back to top function
		 */
		hideBackTop: function() {
			if ( jQuery( window ).scrollTop() > jQuery( window ).height() / 2 ) {
				jQuery( '#back-to-top' ).removeClass( 'gone' ).addClass( 'visible' );
			} else {
				jQuery( '#back-to-top' ).removeClass( 'visible' ).addClass( 'gone' );
			}
		},
		backTop: function() {
			jQuery( '#back-to-top' ).on( 'click', function() {
				jQuery( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
				return false;
			} );
		},
		/**
		 * Generate the map based on an address
		 */
		map: function() {
			if ( typeof google !== 'undefined' ) {

				self = this;

				jQuery( '.map-canvas' ).each( function() {
					let map_element = this;
					let geocoder = new google.maps.Geocoder(),
						address = jQuery( this );

					if ( !address.length ) {
						return;
					}

					geocoder.geocode( {
						'address': address.attr( 'data-address' )
					}, function( results, status ) {
						if ( status === google.maps.GeocoderStatus.OK ) {
							self._mapCallback( results, address.attr( 'data-zoom' ), map_element );
						}
					} );

				} );
			}
		},

		/**
		 * After we "find" out the center, initiate the map & marker
		 * @param results
		 * @param zoom
		 * @param map_element
		 * @private
		 */
		_mapCallback: function( results, zoom, map_element ) {

			let map, marker, totalHeight, mapHeight, section,
				config = {
					zoom: parseFloat( zoom ),
					center: results[ 0 ].geometry.location,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDefaultUI: true,
					styles: Portum.mapStyle
				};

			section = jQuery( map_element ).closest( '.ewf-section' );
			mapHeight = parseInt( jQuery( map_element ).attr( 'data-mapheight' ) );
			map = new google.maps.Map( map_element, config );
			marker = new google.maps.Marker( {
				map: map,
				position: results[ 0 ].geometry.location
			} );

			if ( jQuery( section ).hasClass( 'ewf-section--title-top' ) ) {
				jQuery( section ).css( 'padding-top', mapHeight + 'px' );
				totalHeight = jQuery( section ).height();
				panValue = (totalHeight - ((totalHeight + mapHeight) / 2)) + (mapHeight / 2);
				map.panBy( 0, panValue );
			} else {

			}
		},
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