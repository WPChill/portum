/**
 * Portum Customizer Scripts
 *
 * @type {{}}
 */

/**
 * Check if we have the object created somewhere else
 * @type {{}}
 */
var Portum = typeof (Portum) ? {} : Portum;

/**
 * Portum Customizer functions
 *
 * @type {{pairedSettings: Portum.Customizer.pairedSettings, _addOptionsToSelect: Portum.Customizer._addOptionsToSelect, _getValueFromRepeater:
 *     Portum.Customizer._getValueFromRepeater}}
 */
Portum.Customizer = {
	/**
	 * Helpers array
	 */
	helpers: {
		/**
		 * Cleans an array (undefined values), returns value
		 *
		 * @param actual
		 * @returns {Array}
		 */
		cleanArray: function (actual) {
			var newArray = [];
			for (var i = 0; i < actual.length; i++) {
				if (actual[i]) {
					newArray.push(actual[i]);
				}
			}
			return newArray;
		}
	},

	/**
	 * Disable a select if it does not have values
	 * @param id
	 */
	checkValuesAndDisable: function (id) {
		var select = jQuery(id).find('select'),
			options;
		if (select.length) {
			select.val(0);
			options = select.find('option');
		}

		if (1 === options.length) {
			select.prop('disabled', true);
		}
	},

	/**
	 * Populates selects based on another option
	 *
	 * @param object
	 * @param api
	 */
	pairedSettings: function (object, api) {
		var self = this;
		_.each(object, function (v, k) {
			/**
			 * Handle updates ( basically, when the user types in the doctors field -> an option is being created in the select )
			 */
			api.control(k).container.on('row:update', _.debounce(function () {
				var val = api.control(k).setting.get(),
					selects = jQuery('.repeater-sections').find('[data-field=\'' + v.field + '\']');

				_.each(selects, function (k) {
					jQuery(k).empty();
					self._addOptionsToSelect(jQuery(k), val, v.filter);
				});

			}, 500));

			/**
			 * When you remove a row, the value gets cleaned ( array could contain undefined elements, we need to get RID of them )
			 */
			api.control(k).container.on('row:remove', function () {
				var val = api.control(k).setting.get(),
					selects = jQuery('.repeater-sections').find('[data-field=\'' + v.field + '\']');
				val = self.helpers.cleanArray(val);
				_.each(selects, function (k) {
					jQuery(k).empty();
					self._addOptionsToSelect(jQuery(k), val, v.filter);
				});
			});
		});
	},

	/**
	 * Create options from an object of values
	 * @param select
	 * @param options
	 * @param key
	 * @private
	 */
	_addOptionsToSelect: function (select, options, key) {
		if (select.hasClass('selectized')) {
			select[0].selectize.clearOptions();
			select[0].selectize.addOption({ value: 'all', text: 'All' });
			_.each(options, function (v) {
				select[0].selectize.addOption({ value: v[key], text: v[key] });
				select[0].selectize.refreshOptions(false);
				//select[ 0 ].selectize.setValue( 'all', false );
			});
		} else {
			select.append(jQuery('<option></option>').attr('value', 'all').text('All'));
			_.each(options, function (v) {
				select.append(jQuery('<option></option>').attr('value', v[key]).text(v[key]));
			});
		}
	},

	/**
	 * Content panels should be last ( The nested panels functionality adds Panels and then Sections )
	 */
	handleAwfulSorting: function () {
		jQuery(document).on('epsilon-reflown-panels', function () {
			var element = jQuery('#accordion-panel-portum_panel_section_content');
			element.appendTo(element.parent());
		});
	},

	/**
	 * Handles active callback
	 *
	 * @param object
	 */
	handleActiveCallback: function (object) {
		var self = this;
		_.each(object, function (v, k) {
			self._handleActiveCallback(wp.customize.control(k).setting.get(), v);

			wp.customize.control(k).container.find('input').on('change', function () {
				self._handleActiveCallback(wp.customize.control(k).setting.get(), v);
			});
		});
	},

	/**
	 *
	 * @param currentValue
	 * @param obj
	 * @returns {boolean}
	 * @private
	 */
	_handleActiveCallback: function (currentValue, obj) {
		if (obj.value === currentValue) {
			_.each(obj.fields, function (k) {
				jQuery('#' + k).removeClass('hidden-section-panel');
			});
		} else {
			_.each(obj.fields, function (k) {
				jQuery('#' + k).addClass('hidden-section-panel');
			});
		}
	},

	/**
	 * Hide/show controls, depending on other customizer settings.   
	 */
	toggleControls: function () {

		function handleControls() {

			// handle 'portum_header_sticky' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' ) {
				toggleControl( 'portum_header_sticky', true );
			}
			else {
				toggleControl( 'portum_header_sticky', false );
			}

			// handle 'portum_header_over_content' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' ) {
				toggleControl( 'portum_header_over_content', true );
			}
			else {
				toggleControl( 'portum_header_over_content', false );
			}

			// handle 'portum_header_shadow' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' ) {
				toggleControl( 'portum_header_shadow', true );
			}
			else {
				toggleControl( 'portum_header_shadow', false );
			}

			// handle 'portum_header_shadow' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' ) {
				toggleControl( 'portum_header_width', true );
			}
			else {
				toggleControl( 'portum_header_width', false );
			}

			// handle 'portum_logo_sticky' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' && getSetting('portum_header_sticky') ) {
				toggleControl( 'portum_logo_sticky', true );
			}
			else {
				toggleControl( 'portum_logo_sticky', false );
			}

			
			// handle 'epsilon_header_background_sticky' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' && getSetting('portum_header_sticky') ) {
				toggleControl( 'epsilon_header_background_sticky', true );
			}
			else {
				toggleControl( 'epsilon_header_background_sticky', false );
			}

			// handle 'epsilon_header_background_border_bot' control
			if ( getSetting('portum_header_layout') !== 'portum-sidebar' ) {
				toggleControl( 'epsilon_header_background_border_bot', true );
			}
			else {
				toggleControl( 'epsilon_header_background_border_bot', false );
			}

		}

		function toggleControl( controlName, value ) {
			if ( wp.customize.control( controlName ) ) {
				wp.customize.control( controlName ).toggle( value );
			}
		}

		function getSetting( controlName ) {
			return wp.customize.control( controlName ).setting.get();
		}

		wp.customize('portum_header_layout', function (setting) {
			setting.bind(function (value) {
				handleControls();
			});
		}); 

		wp.customize('portum_header_sticky', function (setting) {
			setting.bind(function (value) {
				handleControls();
			});
		}); 

		handleControls();


	}


};

/**
 * Sort'of document ready
 */
wp.customize.bind('ready', function () {
	/**
	 * Object that handles pairing of options in customizer
	 *
	 * KEY is the section
	 * VALUE.field -> the select field
	 * VALUE.filter -> the field from where it generates the options
	 *
	 * e.g.
	 *
	 var obj = {
		  'portum_doctors': {
			field: 'doctors_group',
			filter: 'doctor_name'
		  },
		  'portum_specialties': {
			field: 'specialties_grouping',
			filter: 'specialties_title'
		  },
		  'portum_about_info': {
			field: 'about_grouping',
			filter: 'info_title'
		  }
		};
  
	 Portum.Customizer.pairedSettings( obj, wp.customize );
	 */

	/**
	 * Gray out sections of the customizer, based on another control
	 *
	 * @type {{show_on_front: {value: string, fields: [string,string]}}}
	 *
	 * e.g.
	 *
	 var activeCallbacked = {
		  'show_on_front': {
			value: 'page',
			fields: [ 'accordion-panel-portum_panel_section_content', 'accordion-section-portum_repeatable_section' ]
		  }
	   };
  
	 Portum.Customizer.handleActiveCallback( activeCallbacked );
	 */

	var obj = {
		'portum_slides': {
			field: 'slider_grouping',
			filter: 'slides_title'
		},
		'portum_advanced_slides': {
			field: 'slider_advanced_grouping',
			filter: 'slide_cta'
		},
		'portum_expertise': {
			field: 'expertise_grouping',
			filter: 'expertise_title'
		},
		'portum_portfolio': {
			field: 'portfolio_grouping',
			filter: 'portfolio_title'
		},
		'portum_price_boxes': {
			field: 'pricing_grouping',
			filter: 'price_box_title'
		},
		'portum_services': {
			field: 'services_grouping',
			filter: 'service_title'
		},
		'portum_team_members': {
			field: 'team_grouping',
			filter: 'member_title'
		},
		'portum_testimonials': {
			field: 'testimonials_grouping',
			filter: 'testimonial_title'
		},
		'portum_contact_section': {
			field: 'google_map_grouping',
			filter: 'contact_title'
		},
		'portum_counter_boxes': {
			field: 'counters_grouping',
			filter: 'counter_title'
		},
		'portum_progress_bars': {
			field: 'progress_bars_grouping',
			filter: 'progress_bar_title'
		},
		'portum_pie_charts': {
			field: 'piecharts_grouping',
			filter: 'piechart_title'
		},
		'portum_clients': {
			field: 'clientlist_grouping',
			filter: 'client_title'
		}
	};

	// Portum.Customizer.pairedSettings( obj, wp.customize );

	var activeCallbacked = {
		'show_on_front': {
			value: 'page',
			fields: ['accordion-section-portum_repeatable_section']
		}
	};

	//Portum.Customizer.handleActiveCallback( activeCallbacked );
	Portum.Customizer.handleAwfulSorting();
	Portum.Customizer.toggleControls();
});
