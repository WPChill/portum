<?php
/**
 * Portum Theme Helpers
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Helper
 */
class Portum_Helper {

	public static $section_ids = array();

	/**
	 * Create a "default" value for the header layout
	 */
	public static function get_header_default() {
		return wp_json_encode( array(
			'columnsCount' => 2,
			'columns'      => array(
				array(
					'index' => 1,
					'span'  => 6,
				),
				array(
					'index' => 2,
					'span'  => 6,
				),
			),
		) );
	}

	/**
	 * Create a "default" value for the footer layout
	 */
	public static function get_footer_default() {
		return wp_json_encode( array(
			'columnsCount' => 4,
			'columns'      => array(
				array(
					'index' => 1,
					'span'  => 3,
				),
				array(
					'index' => 2,
					'span'  => 3,
				),
				array(
					'index' => 3,
					'span'  => 3,
				),
				array(
					'index' => 4,
					'span'  => 3,
				),
			),
		) );
	}

	/**
	 * Create a "default" value for the blog layout
	 */
	public static function get_blog_default() {
		return wp_json_encode( array(
			'columnsCount' => 2,
			'columns'      => array(
				1 => array(
					'index' => 1,
					'span'  => 8,
				),
				2 => array(
					'index' => 2,
					'span'  => 4,
				),
			),
		) );
	}

	public static function generate_section_id( $key ) {

		$random = rand( 1, 999999 );
		$id     = $key . '-' . $random;

		while ( in_array( $id, self::$section_ids ) ) {
			$random = rand( 1, 999999 );
			$id     = $key . '-' . $random;
		}

		self::$section_ids[] = $id;

		return $id;

	}

	/**
	 * Generate a set of classes to be applied on a section
	 *
	 * @param $key
	 * @param $fields
	 *
	 */
	public static function generate_section_class( $key, $fields ) {
		$additional = '';
		if ( ! empty( $fields[ $key . '_background_parallax' ] ) && 'false' != $fields[ $key . '_background_parallax' ] ) {
			$additional .= ' ewf-section--parallax';
		}

		echo esc_attr( $additional );
	}

	/**
	 * Generate section attrbiutes
	 *
	 * @param $key
	 * @param $fields
	 *
	 * @return bool | string | echo
	 */
	public static function generate_section_attr( $key, $fields ) {
		if ( empty( $fields[ $key . '_background_image' ] ) ) {
			return false;
		}
		$arr = array(
			'background-image'    => 'url(' . esc_url( $fields[ $key . '_background_image' ] ) . ')',
			'background-position' => esc_attr( $fields[ $key . '_background_position' ] ),
			'background-size'     => esc_attr( $fields[ $key . '_background_size' ] ),
		);

		$style = 'style="';
		foreach ( $arr as $k => $v ) {
			$style .= $k . ':' . $v . ';';
		}
		$style .= '"';

		echo $style;
	}

	/**
	 * Generates overlay attr
	 *
	 * @param $key
	 * @param $fields
	 */
	public static function generate_color_overlay( $key, $fields ) {
		if ( ! empty( $fields[ $key . '_background_color' ] ) ) {
			echo '<div class="ewf-section__overlay-color" style="background-color:' . esc_attr( $fields[ $key . '_background_color' ] ) . ';"></div>';
		}

		echo '';

	}

	/**
	 * Returns the class of the container
	 *
	 * @param $key
	 * @param $fields
	 *
	 * @return string
	 */
	public static function container_class( $key, $fields ) {
		$class = array(
			'boxedin'     => 'container',
			'boxedcenter' => 'container container-boxedcenter',
			'fullwidth'   => 'container-fluid ewf-padding-right--none ewf-padding-left--none',
		);

		if ( ! isset( $fields[ $key . '_column_stretch' ] ) ) {
			return $class['boxedin'];
		}

		if ( $fields[ $key . '_column_stretch' ] == 'boxedin' ) {
			return $class['boxedin'];
		} else if ( $fields[ $key . '_column_stretch' ] == 'boxedcenter' ) {
			return $class['boxedcenter'];
		} else if ( $fields[ $key . '_column_stretch' ] == 'fullwidth' ) {
			return $class['fullwidth'];
		}

		return $class['boxedin']; // default is container
	}


	/**
	 * Get blog layout
	 *
	 * @param string $option Option to retrieve in the backend
	 *
	 * @return array|mixed|object|string
	 */
	public static function get_layout( $option = '' ) {
		$layout = empty( $option ) ? get_theme_mod( 'portum_layout', false ) : get_theme_mod( $option, false );

		if ( ! $layout ) {
			$layout = 'narrow';
		}

		if ( is_home() || is_search() || is_author() || is_archive() ) {
			$layout = 'fullwidth';
		}

		switch ( $layout ) :
			case 'narrow':
				$layout = array();
				$layout['type'] = 'narrow';
				$layout['columns']['content'] = array( 'index' => 1, 'span'  => 8, 'class' => 'col-sm-8 col-sm-offset-2' );
				break;
			case 'right-sidebar':
				$layout = array();
				$layout['type'] = 'right-sidebar';
				$layout['columns']['content'] = array( 'index' => 1, 'span'  => 8, 'class' => 'col-sm-8' );
				$layout['columns']['sidebar'] = array( 'index' => 2, 'span'  => 4 );
				break;
			case 'left-sidebar':
				$layout = array();
				$layout['type'] = 'left-sidebar';
				$layout['columns']['content'] = array( 'index' => 1, 'span'  => 8, 'class' => 'col-sm-8' );
				$layout['columns']['sidebar'] = array( 'index' => 2, 'span'  => 4 );
				break;
			case 'fullwidth':
				$layout = array();
				$layout['type'] = 'fullwidth';
				$layout['columns']['content'] = array( 'index' => 1, 'span'  => 12, 'class' => 'col-sm-12' );
				break;
		endswitch;

		$layout['columnsCount'] = count( $layout['columns'] );

		return $layout;
	}

	/**
	 * Get the footer layout
	 *
	 * @return array|mixed|object|string
	 */
	public static function get_footer_layout() {
		$footer_layout = get_theme_mod( 'portum_footer_columns', false );
		if ( ! $footer_layout ) {
			$footer_layout = Portum_Helper::get_footer_default();
		}
		if ( ! is_array( $footer_layout ) ) {
			$footer_layout = json_decode( $footer_layout, true );
		}

		return $footer_layout;
	}

	/**
	 * Render the post meta
	 *
	 * @param string $element Element that we need to render in the frontend.
	 */
	public static function posted_on( $element = 'default' ) {
		$comments = wp_count_comments( get_the_ID() );

		switch ( $element ) {
			case 'date':
				if ( false == get_theme_mod( 'portum_show_single_post_date', true ) ) {
					return;
				}

				$html = '<a class="posted-on" href="#">' . get_the_date() . '</a>';

				echo wp_kses_post( $html );
				break;
			case 'author':
				if ( false == get_theme_mod( 'portum_show_single_post_author', true ) ) {
					return;
				}

				$html = '<span class="byline">' . esc_html_e( 'by ', 'portum' );
				$html .= '<a class="post-author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>';
				$html .= '</span>';

				echo wp_kses_post( $html );
				break;
			case 'category':
				$html = '<div class="cat-links">' . __( 'Categories: ', 'portum' );
				$html .= get_the_category_list( ' ' );
				$html .= '</div><!-- .cat-links -->';

				echo wp_kses_post( $html );
				break;
			case 'comments':
				if ( false == get_theme_mod( 'portum_show_single_post_comments', true ) ) {
					return;
				}

				echo ' <span class="comments-link"><a title="' . esc_attr__( 'Comment on Post', 'portum' ) . '" href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '#comments">' . esc_html( $comments->approved ) . '</a></span>';
				break;
			case 'tags':
				if ( false == get_theme_mod( 'portum_show_single_post_tags', true ) ) {
					return;
				}
				$html = '<div class="tags-links">';
				$html .= get_the_tag_list( '', ' ' );
				$html .= '</div><!-- .tags-links -->';
				echo wp_kses_post( $html );
				break;
			default:
				echo '';
				break;
		}
	}

	public static function render_button( $fields, $name, $url = '' ) {

		if ( empty( $fields[ $name . '_label' ] ) ) {
			return;
		}

		if ( ! $url ) {
			$url = $fields[ $name . '_url' ];
		}

		$button_class  = 'ewf-btn ';
		$button_class .= ! empty( $fields[ $name . '_size' ] ) ? esc_attr( $fields[ $name . '_size' ] ) : 'ewf-btn--huge';

		$button_style  = '';
		$button_style .= isset( $fields[ $name . '_background_color' ] ) ? 'background-color:' . esc_attr( $fields[ $name . '_background_color' ] ) . ';'  : '';
		$button_style .= isset( $fields[ $name . '_text_color' ] ) ? 'color:' . esc_attr( $fields[ $name . '_text_color' ] ) . ';' : '';
		$button_style .= isset( $fields[ $name . '_border_color' ] ) ? 'border-color:' . esc_attr( $fields[ $name . '_border_color' ] ) . ';' : '';
		$button_style .= isset( $fields[ $name . '_radius' ] ) ? 'border-radius:' . esc_attr( $fields[ $name . '_radius' ] ) . 'px;' : '';
		?>
			<a class="<?php echo esc_attr( $button_class ); ?>" style="<?php echo esc_attr( $button_style ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo wp_kses_post( $fields[ $name . '_label' ] );  ?></a>
		<?php
	}

	public static function render_icon( $fields, $id ) {

		if ( empty( $fields[ $id ] ) ) {
			return;
		}

		$icon_style  = '';
		$icon_style .= isset( $fields[ $id . '_color' ] ) ? 'color:' . esc_attr( $fields[ $id . '_color' ] ) . ';' : '';
		$icon_style .= isset( $fields[ $id . '_size' ] ) ? 'font-size:' . esc_attr( $fields[ $id . '_size' ] ) . 'px;' : '';
		$icon_style .= isset( $fields[ $id . '_background_color' ] ) ? 'background-color:' . esc_attr( $fields[ $id . '_background_color' ] ) . ';' : '';
		$icon_style .= isset( $fields[ $id . '_border_color' ] ) ? 'border-color:' . esc_attr( $fields[ $id . '_border_color' ] ) . ';' : '';
		$icon_style .= isset( $fields[ $id . '_border_size' ] ) ? 'border-width:' . esc_attr( $fields[ $id . '_border_size' ] ) . 'px;' : '';
		$icon_style .= isset( $fields[ $id . '_radius' ] ) ? 'border-radius:' . esc_attr( $fields[ $id . '_radius' ] ) . 'px;' : '';
		$icon_style .= isset( $fields[ $id . '_padding' ] ) ? 'padding:' . esc_attr( $fields[ $id . '_padding' ] ) . 'px;' : '';

		?>
			<i class="ewf-icon <?php echo esc_attr( $fields[ $id ] ); ?>" style="<?php echo esc_attr( $icon_style ); ?>"></i>
		<?php
	}

	/**
	 * Generates the section title properly formatted
	 *
	 * @param string $subtitle
	 * @param string $title
	 * @param array  $args
	 *
	 * @return string;
	 */
	public static function generate_section_title( $subtitle = '', $title = '', $args = array(
		'bottom' => false,
		'center' => false,
	) ) {
		$class = 'headline';
		if ( ! empty( $args['center'] ) ) {
			$class .= ' text-center';
		}
		if ( ! empty( $args['bottom'] ) ) {
			$class .= ' headline--xs-bottom';
		}
		$html = '<div class="' . $class . '">';
		if ( ! empty( $title ) ) {
			$html .= '<h3>' . $title . '</h3>';
		}
		if ( ! empty( $subtitle ) ) {
			$html .= '<span>' . $subtitle . '</span>';
		}

		$html .= '</div>';

		return $html;
	}

	/**
	 * Retrieve values saved in another customizer field
	 *
	 * @param string $field  Repeater field.
	 * @param string $filter Filtering.
	 *
	 * @return array
	 */
	public static function get_group_values( $field = '', $filter = '' ) {
		$groups = get_theme_mod( $field, array() );
		$arr    = array(
			'all' => esc_html__( 'All', 'portum' ),
		);

		if ( empty( $groups ) ) {
			return $arr;
		}

		foreach ( $groups as $k => $v ) {
			if ( isset( $groups[ $k ][ $filter ] ) ) {
				$arr[ $v[ $filter ] ] = $v[ $filter ];
			}
		}

		$arr = array_unique( $arr );

		return $arr;
	}

	/**
	 * @param string $key    Repeater field.
	 * @param string $filter Filtering.
	 *
	 * @return array|string
	 */
	public static function get_group_values_from_meta( $key = '', $filter = '' ) {
		$data = get_post_meta( Epsilon_Content_Backup::get_instance()->setting_page, $key, true );
		$arr  = array(
			'all' => esc_html__( 'All', 'portum' ),
		);

		if ( empty( $data ) ) {
			return $arr;
		}

		if ( ! isset( $data[ $key ] ) ) {
			return $arr;
		}

		$data = $data[ $key ];

		foreach ( $data as $k => $v ) {
			if ( isset( $data[ $k ][ $filter ] ) ) {
				$arr[ $v[ $filter ] ] = $v[ $filter ];
			}
		}

		$arr = array_unique( $arr );

		return $arr;
	}

	/**
	 * Search in an array for a certain value
	 *
	 * @param array  $array  Array.
	 * @param string $column Column to search for.
	 * @param string $value  Value.
	 *
	 * @return array;
	 */
	public static function search_in_array( $array = array(), $column = '', $value = '' ) {
		foreach ( $array as $index => $element ) {
			if ( ! array_key_exists( $column, $element ) ) {
				continue;
			}

			if ( ! array_search( $value, $element, true ) ) {
				unset( $array[ $index ] );
			}
		}

		return $array;
	}


	public static function generate_button_controls( $button_id, $button_name, $condition = true ) {

		return array(
			$button_id . '_size'             => array(
				'label'   => sprintf( esc_html__( '%s Size', 'portum' ), $button_name ),
				'type'    => 'select',
				'default' => 'ewf-btn--huge',
				'choices' => array(
					'ewf-btn--huge'   => __( 'Huge', 'portum' ),
					'ewf-btn--medium' => __( 'Medium', 'portum' ),
					'ewf-btn--small'  => __( 'Small', 'portum' ),
				),
				'condition' => $condition,
			),
			$button_id . '_radius'           => array(
				'label'   => sprintf( esc_html__( '%s Radius', 'portum' ), $button_name ),
				'type'    => 'epsilon-slider',
				'default' => 32, //the default border radius of buttons is: 32px
				'choices' => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
				'condition' => $condition,
			),
			$button_id . '_background_color' => array(
				'label'             => sprintf( esc_html__( '%s Background Color', 'portum' ), $button_name ),
				'type'              => 'epsilon-color-picker',
				'mode'              => 'rgba',
				'default'           => get_theme_mod( 'epsilon_accent_color', '#0962ea' ),  //the default bg color of buttons is the accent color #1
				'condition'         => $condition,
			),
			$button_id . '_text_color'       => array(
				'label'             => sprintf( esc_html__( '%s Text Color', 'portum' ), $button_name ),
				'type'              => 'epsilon-color-picker',
				'mode'              => 'rgba',
				'default'           => '#ffffff', //the default text color of buttons is: #fff
				'condition'         => $condition,
			),
			$button_id . '_border_color'     => array(
				'label'             => sprintf( esc_html__( '%s Border Color', 'portum' ), $button_name ),
				'type'              => 'epsilon-color-picker',
				'mode'              => 'rgba',
				'default'           => 'transparent', //the default border color of buttons is: transparent
				'condition'         => $condition,
			),
		);
	}


	public static function generate_icon_controls( $icon_id, $icon_name, $condition = true ) {

		$controls =  array(
			$icon_id . '_background_color'     => array(
				'label'   => sprintf( esc_html__( '%s Background Color', 'portum' ), $icon_name ),
				'type'    => 'epsilon-color-picker',
				'default' => '', // by default, icons have no background color.
				'condition' => $condition,
			),
			$icon_id . '_border_color'  => array(
				'label'   => sprintf( esc_html__( '%s Border Color', 'portum' ), $icon_name ),
				'type'    => 'epsilon-color-picker',
				'default' => '', // by default, icons have border color: inherit.
				'condition' => $condition,
			),
			$icon_id . '_size'             => array(
				'label'   => sprintf( esc_html__( '%s Size', 'portum' ), $icon_name ),
				'description' => esc_html__( 'Value in pixels.', 'portum' ),
				'type'      => 'epsilon-slider',
				'default'   => 36,  //the default size of icons is: 36px
				'choices'   => array(
					'min'  => 20,
					'max'  => 100,
					'step' => 1,
				),
				'condition' => $condition,
			),
			$icon_id . '_border_size'   => array(
				'label'   => sprintf( esc_html__( '%s Border Size', 'portum' ), $icon_name ),
				'description' => esc_html__( 'Value in pixels.', 'portum' ),
				'type'        => 'epsilon-slider',
				'default'     => 0, // the default icon border width is: 0px
				'choices'     => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 1,
				),
				'condition' => $condition,
			),
			$icon_id . '_padding'   => array(
				'label'   => sprintf( esc_html__( '%s Padding', 'portum' ), $icon_name ),
				'description' => esc_html__( 'Value in pixels.', 'portum' ),
				'type'        => 'epsilon-slider',
				'default'     => 0, // the default icon padding is: 0px
				'choices'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'condition' => $condition,
			),
			$icon_id . '_radius'   => array(
				'label'   => sprintf( esc_html__( '%s Border Radius', 'portum' ), $icon_name ),
				'description' => esc_html__( 'Value in pixels.', 'portum' ),
				'type'        => 'epsilon-slider',
				'default'     => 0, // the default icon border radius is: 0px
				'choices'     => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'condition' => $condition,
			),
		);

		return $controls;
	}

	/**
	 * Insert a value or key/value pair after a specific key in an array.  If key doesn't exist, value is appended
	 * to the end of the array.
	 *
	 * @param array $array
	 * @param string $key
	 * @param array $new
	 *
	 * @return array
	 */
	public static function array_insert_after( array $array, $key, array $new ) {
		$keys  = array_keys( $array );
		$index = array_search( $key, $keys );
		$pos   = false === $index ? count( $array ) : $index + 1;
		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}

	/**
	 * Generate an edit shortcut for the frontend sections
	 *
	 * @deprecated
	 *
	 */
	public static function generate_pencil( $class_name = '', $section_type = '' ) {
		return Epsilon_Helper::generate_pencil( $class_name, $section_type );
	}

	/**
	 * @param $url
	 *
	 * @return array
	 */
	public static function video_type( $url ) {
		$youtube = preg_match( '/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/', $url, $yt_matches );

		$vimeo = preg_match( '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([‌​0-9]{6,11})[?]?.*/', $url, $vm_matches );

		$video_id = 0;
		$type     = 'none';

		if ( $youtube ) {
			$video_id = $yt_matches[5];
			$type     = 'youtube';
		} elseif ( $vimeo ) {
			$video_id = $vm_matches[5];
			$type     = 'vimeo';
		}

		return array(
			'video_id'   => $video_id,
			'video_type' => $type,
		);

	}

	/**
	 * @param $section_id
	 * @param $key
	 * @param $fields
	 *
	 * @return string
	 */
	public static function generate_color_styles( $section_id, $key, $fields ) {
		$obj = Epsilon_Section_Styling::get_instance( 'portum-main', 'portum_frontpage_sections_', Portum_Repeatable_Sections::get_instance() );
		return $obj->gather_static_options( $fields );
	}

	/**
	 * Static method used to generate the corresponding CSS for the Colors Tab
	 *
	 * @param $section_id
	 * @param $key
	 * @param $fields
	 */
	public static function generate_inline_css( $section_id, $key, $fields ) {

		$main_css = array();

		$defaults = array(
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
			'unit'   => 'px',
		);

		$desktop = array(
			$key . '_margins_desktop'  => 'margin',
			$key . '_paddings_desktop' => 'padding',
		);

		$mobile = array(
			$key . '_paddings_mobile' => 'padding',
			$key . '_margins_mobile'  => 'margin',
		);

		$keys = array(
			$key . '_margins_tablet'  => 'margin',
			$key . '_paddings_tablet' => 'padding',
		);


		// section CSS.
		$css = array();

		if ( isset( $fields[ $key . '_margins_desktop' ] ) && '' != $fields[ $key . '_margins_desktop' ] ) {
			$margins_desktop = wp_parse_args( json_decode( $fields[ $key . '_margins_desktop' ] ), $defaults );

			if ( isset( $margins_desktop['top'] ) && '' != $margins_desktop['top'] ) {
				$css[]  = 'margin-top:' . $margins_desktop['top'] . $margins_desktop['unit'];
			}
			if ( isset( $margins_desktop['bottom'] ) && '' != $margins_desktop['bottom'] ) {
				$css[]  = 'margin-bottom:' . $margins_desktop['bottom'] . $margins_desktop['unit'];
			}
			if ( isset( $margins_desktop['left'] ) && '' != $margins_desktop['left'] ) {
				$css[]  = 'margin-left:' . $margins_desktop['left'] . $margins_desktop['unit'];
			}
			if ( isset( $margins_desktop['right'] ) && '' != $margins_desktop['right'] ) {
				$css[]  = 'margin-right:' . $margins_desktop['right'] . $margins_desktop['unit'];
			}
		}

		if ( isset( $fields[ $key . '_paddings_desktop' ] ) && '' != $fields[ $key . '_paddings_desktop' ] ) {
			$paddings_desktop = wp_parse_args( json_decode( $fields[ $key . '_paddings_desktop' ] ), $defaults );

			if ( isset( $paddings_desktop['top'] ) && '' != $paddings_desktop['top'] ) {
				$css[]  = 'padding-top:' . $paddings_desktop['top'] . $paddings_desktop['unit'];
			}
			if ( isset( $paddings_desktop['bottom'] ) && '' != $paddings_desktop['bottom'] ) {
				$css[]  = 'padding-bottom:' . $paddings_desktop['bottom'] . $paddings_desktop['unit'];
			}
			if ( isset( $paddings_desktop['left'] ) && '' != $paddings_desktop['left'] ) {
				$css[]  = 'padding-left:' . $paddings_desktop['left'] . $paddings_desktop['unit'];
			}
			if ( isset( $paddings_desktop['right'] ) && '' != $paddings_desktop['right'] ) {
				$css[]  = 'padding-right:' . $paddings_desktop['right'] . $paddings_desktop['unit'];
			}
		}

		switch ( $fields[ $key . '_background_type' ] ) {
			case 'bgcolor':
				if ( empty( $fields[ $key . '_background_color' ] ) ) {
					continue;
				}

				$css[] = 'background-color:' . esc_attr( $fields[ $key . '_background_color' ] ) . ';';
				break;
			case 'bgimage':
			default:
				if ( empty( $fields[ $key . '_background_image' ] ) ) {
					continue;
				}

				$css[] = 'background-image:url(' . esc_url( $fields[ $key . '_background_image' ] ) . ')';
				$css[] = 'background-position:' . esc_attr( $fields[ $key . '_background_position' ] );
				$css[] = 'background-size:' . esc_attr( $fields[ $key . '_background_size' ] );
				$css[] = 'background-repeat:' . esc_attr( $fields[ $key . '_background_repeat' ] );
				break;
		}

		if ( ! empty( $css ) ) {
			$main_css[] = '#' . $section_id . '{' . implode( ';', $css ) . '}';
		}

		// Tablet CSS
		$css = array();
		if ( isset( $fields[ $key . '_margins_tablet' ] ) && '' != $fields[ $key . '_margins_tablet' ] ) {
			$margins_tablet = wp_parse_args( json_decode( $fields[ $key . '_margins_tablet' ] ), $defaults );

			if ( isset( $margins_tablet['top'] ) && '' != $margins_tablet['top'] ) {
				$css[]  = 'margin-top:' . $margins_tablet['top'] . $margins_tablet['unit'];
			}
			if ( isset( $margins_tablet['bottom'] ) && '' != $margins_tablet['bottom'] ) {
				$css[]  = 'margin-bottom:' . $margins_tablet['bottom'] . $margins_tablet['unit'];
			}
			if ( isset( $margins_tablet['left'] ) && '' != $margins_tablet['left'] ) {
				$css[]  = 'margin-left:' . $margins_tablet['left'] . $margins_tablet['unit'];
			}
			if ( isset( $margins_tablet['right'] ) && '' != $margins_tablet['right'] ) {
				$css[]  = 'margin-right:' . $margins_tablet['right'] . $margins_tablet['unit'];
			}
		}

		if ( isset( $fields[ $key . '_paddings_tablet' ] ) && '' != $fields[ $key . '_paddings_tablet' ] ) {
			$paddings_tablet = wp_parse_args( json_decode( $fields[ $key . '_paddings_tablet' ] ), $defaults );

			if ( isset( $paddings_tablet['top'] ) && '' != $paddings_tablet['top'] ) {
				$css[]  = 'padding-top:' . $paddings_tablet['top'] . $paddings_tablet['unit'];
			}
			if ( isset( $paddings_tablet['bottom'] ) && '' != $paddings_tablet['bottom'] ) {
				$css[]  = 'padding-bottom:' . $paddings_tablet['bottom'] . $paddings_tablet['unit'];
			}
			if ( isset( $paddings_tablet['left'] ) && '' != $paddings_tablet['left'] ) {
				$css[]  = 'padding-left:' . $paddings_tablet['left'] . $paddings_tablet['unit'];
			}
			if ( isset( $paddings_tablet['right'] ) && '' != $paddings_tablet['right'] ) {
				$css[]  = 'padding-right:' . $paddings_tablet['right'] . $paddings_tablet['unit'];
			}
		}

		if ( ! empty( $css ) ) {
			$main_css[] = '@media (max-width: 768px) {#' . $section_id . '{' . implode( ';', $css ) . '}}';
		}


		// Mobile CSS
		$css = array();
		if ( isset( $fields[ $key . '_margins_mobile' ] ) && '' != $fields[ $key . '_margins_mobile' ] ) {
			$margins_mobile = wp_parse_args( json_decode( $fields[ $key . '_margins_mobile' ] ), $defaults );

			if ( isset( $margins_mobile['top'] ) && '' != $margins_mobile['top'] ) {
				$css[]  = 'margin-top:' . $margins_mobile['top'] . $margins_mobile['unit'];
			}
			if ( isset( $margins_mobile['bottom'] ) && '' != $margins_mobile['bottom'] ) {
				$css[]  = 'margin-bottom:' . $margins_mobile['bottom'] . $margins_mobile['unit'];
			}
			if ( isset( $margins_mobile['left'] ) && '' != $margins_mobile['left'] ) {
				$css[]  = 'margin-left:' . $margins_mobile['left'] . $margins_mobile['unit'];
			}
			if ( isset( $margins_mobile['right'] ) && '' != $margins_mobile['right'] ) {
				$css[]  = 'margin-right:' . $margins_mobile['right'] . $margins_mobile['unit'];
			}
		}

		if ( isset( $fields[ $key . '_paddings_mobile' ] ) && '' != $fields[ $key . '_paddings_mobile' ] ) {
			$paddings_mobile = wp_parse_args( json_decode( $fields[ $key . '_paddings_mobile' ] ), $defaults );

			if ( isset( $paddings_mobile['top'] ) && '' != $paddings_mobile['top'] ) {
				$css[]  = 'padding-top:' . $paddings_mobile['top'] . $paddings_mobile['unit'];
			}
			if ( isset( $paddings_mobile['bottom'] ) && '' != $paddings_mobile['bottom'] ) {
				$css[]  = 'padding-bottom:' . $paddings_mobile['bottom'] . $paddings_mobile['unit'];
			}
			if ( isset( $paddings_mobile['left'] ) && '' != $paddings_mobile['left'] ) {
				$css[]  = 'padding-left:' . $paddings_mobile['left'] . $paddings_mobile['unit'];
			}
			if ( isset( $paddings_mobile['right'] ) && '' != $paddings_mobile['right'] ) {
				$css[]  = 'padding-right:' . $paddings_mobile['right'] . $paddings_mobile['unit'];
			}
		}

		if ( ! empty( $css ) ) {
			$main_css[] = '@media (max-width: 576px) {#' . $section_id . '{' . implode( ';', $css ) . '}}';
		}

		echo '<style type="text/css">' . Portum_Helper::generate_color_styles( $section_id, $key, $fields ) . '</style>';

		if ( ! empty( $main_css ) ) {
			echo '<style type="text/css" media="all">' . implode( '', $main_css ) . '</style>';
		}

	}


}
