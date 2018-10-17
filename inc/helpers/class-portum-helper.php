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

	public static function generate_section_id( $key ){

		$random = rand(1, 999999);
		$id = $key . '-' . $random;

		while ( in_array( $id, self::$section_ids ) ) {
			$random = rand(1, 999999);
			$id = $key . '-' . $random;
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
			echo '<div class="ewf-section__overlay-color" style="background-color:' . esc_attr( $fields[ $key . '_background_color' ] ) . '; opacity: ' . esc_attr( $fields[ $key . '_background_color_opacity' ] ) . '"></div>';
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
			$layout = Portum_Helper::get_blog_default();
		}

		if ( ! is_array( $layout ) ) {
			$layout = json_decode( $layout, true );
		}

		$layout['type'] = 'right-sidebar';

		$layout['columns']['content'] = isset( $layout['columns'][1] ) ? $layout['columns'][1] : null;
		$layout['columns']['sidebar'] = isset( $layout['columns'][2] ) ? $layout['columns'][2] : null;

		unset( $layout['columns'][1] );
		unset( $layout['columns'][2] );

		if ( $layout['columns']['content']['span'] < $layout['columns']['sidebar']['span'] ) {
			$layout['type'] = 'left-sidebar';
			$temp           = $layout['columns']['content']['span'];

			$layout['columns']['content']['span'] = $layout['columns']['sidebar']['span'];
			$layout['columns']['sidebar']['span'] = $temp;
		}

		if ( 1 === $layout['columnsCount'] ) {
			$layout['type'] = 'fullwidth';
		}

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
			case 'author':
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
				echo ' <span class="comments-link"><a title="' . esc_attr__( 'Comment on Post', 'portum' ) . '" href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '#comments">' . esc_html( $comments->approved ) . '</a></span>';
				break;
			case 'tags':
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

	/**
	 * Generates the section title properly formatted
	 *
	 * @param string $subtitle
	 * @param string $title
	 * @param array  $args
	 *
	 * @return string;
	 */
	public static function generate_section_title(
		$subtitle = '', $title = '', $args = array(
		'bottom' => false,
		'center' => false,
	)
	) {
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
	 * Static method used to generate the corresponding CSS for the Colors Tab
	 *
	 * @param $section_id
	 * @param $key
	 * @param $fields
	 */
	public static function generate_inline_css( $section_id, $key, $fields ) {
		$defaults = array(
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
			'unit'   => 'px'
		);

		$desktop = array(
			$key . '_margins_desktop' => 'margin',
			$key . '_paddings_desktop' => 'padding',
		);

		$mobile = array(
			$key . '_paddings_mobile' => 'padding',
			$key . '_margins_mobile' => 'margin',
		);

		$keys = array(
			$key . '_margins_tablet' => 'margin',
			$key . '_paddings_tablet' => 'padding',
		);

		echo '<style type="text/css" media="all">';
		
		// Desktop CSS
		$desktop_style = array();
		if ( isset( $fields[ $key . '_margins_desktop' ] ) && '' !=  $fields[ $key . '_margins_desktop' ] ) {
			$margins_desktop = wp_parse_args( json_decode( $fields[ $key . '_margins_desktop' ] ), $defaults );
			$desktop_style[] = 'margin:' . $margins_desktop['top'] . $margins_desktop['unit'] . ' ' . $margins_desktop['right'] . $margins_desktop['unit'] . ' ' . $margins_desktop['bottom'] . $margins_desktop['unit'] . ' ' . $margins_desktop['left'] . $margins_desktop['unit'];
		}

		if ( isset( $fields[ $key . '_paddings_desktop' ] ) && '' !=  $fields[ $key . '_paddings_desktop' ] ) {
			$paddings_desktop = wp_parse_args( json_decode( $fields[ $key . '_paddings_desktop' ] ), $defaults );
			$desktop_style[] = 'padding:' . $paddings_desktop['top'] . $paddings_desktop['unit'] . ' ' . $paddings_desktop['right'] . $paddings_desktop['unit'] . ' ' . $paddings_desktop['bottom'] . $paddings_desktop['unit'] . ' ' . $paddings_desktop['left'] . $paddings_desktop['unit'];
		}

		if ( ! empty( $desktop_style ) ) {
			echo '#' . $section_id . '{' . implode( ';', $desktop_style ) . '}';
		}


		// Tablet CSS
		echo '@media (max-width: 768px) {';
		
		$tablet_style = array();
		if ( isset( $fields[ $key . '_margins_tablet' ] ) && '' !=  $fields[ $key . '_margins_tablet' ] ) {
			$margins_tablet = wp_parse_args( json_decode( $fields[ $key . '_margins_tablet' ] ), $defaults );
			$tablet_style[] = 'margin:' . $margins_tablet['top'] . $margins_tablet['unit'] . ' ' . $margins_tablet['right'] . $margins_tablet['unit'] . ' ' . $margins_tablet['bottom'] . $margins_tablet['unit'] . ' ' . $margins_tablet['left'] . $margins_tablet['unit'];
		}

		if ( isset( $fields[ $key . '_paddings_tablet' ] ) && '' !=  $fields[ $key . '_paddings_desktop' ] ) {
			$paddings_tablet = wp_parse_args( json_decode( $fields[ $key . '_paddings_tablet' ] ), $defaults );
			$tablet_style[] = 'padding:' . $paddings_tablet['top'] . $paddings_tablet['unit'] . ' ' . $paddings_tablet['right'] . $paddings_tablet['unit'] . ' ' . $paddings_tablet['bottom'] . $paddings_tablet['unit'] . ' ' . $paddings_tablet['left'] . $paddings_tablet['unit'];
		}

		if ( ! empty( $tablet_style ) ) {
			echo '#' . $section_id . '{' . implode( ';', $tablet_style ) . '}';
		}

		echo '}';

		// Mobile CSS
		echo '@media (max-width: 576px) {';

		$mobile_style = array();
		if ( isset( $fields[ $key . '_margins_mobile' ] ) && '' !=  $fields[ $key . '_margins_mobile' ] ) {
			$margins_mobile = wp_parse_args( json_decode( $fields[ $key . '_margins_mobile' ] ), $defaults );
			$mobile_style[] = 'margin:' . $margins_mobile['top'] . $margins_mobile['unit'] . ' ' . $margins_mobile['right'] . $margins_mobile['unit'] . ' ' . $margins_mobile['bottom'] . $margins_mobile['unit'] . ' ' . $margins_mobile['left'] . $margins_mobile['unit'];
		}

		if ( isset( $fields[ $key . '_paddings_mobile' ] ) && '' !=  $fields[ $key . '_paddings_mobile' ] ) {
			$paddings_mobile = wp_parse_args( json_decode( $fields[ $key . '_paddings_mobile' ] ), $defaults );
			$mobile_style[] = 'padding:' . $paddings_mobile['top'] . $paddings_mobile['unit'] . ' ' . $paddings_mobile['right'] . $paddings_mobile['unit'] . ' ' . $paddings_mobile['bottom'] . $paddings_mobile['unit'] . ' ' . $paddings_mobile['left'] . $paddings_mobile['unit'];
		}

		if ( ! empty( $mobile_style ) ) {
			echo '#' . $section_id . '{' . implode( ';', $mobile_style ) . '}';
		}

		echo '}';

		echo '</style>';

	}


}
