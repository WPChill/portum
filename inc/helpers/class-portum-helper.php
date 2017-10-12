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
	/**
	 * Create a "default" value for the footer layout
	 */
	public static function get_footer_default() {
		return wp_json_encode(
			array(
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
			)
		);
	}

	/**
	 * Create a "default" value for the blog layout
	 */
	public static function get_blog_default() {
		return wp_json_encode(
			array(
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
			)
		);
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
		$subtitle = '',
		$title = '',
		$args = array(
			'doubled' => false,
			'center'  => true,
		)
	) {
		$class = 'headline';
		if ( $args['center'] ) {
			$class .= ' text-center';
		}
		$html = '<div class="' . $class . '">';

		if ( $args['doubled'] && ! ( empty( $subtitle ) ) ) {
			$html .= '<strong>' . $subtitle . '</strong>';
		}

		if ( ! empty( $subtitle ) ) {
			$html .= '<span>' . $subtitle . '</span>';
		}
		if ( ! empty( $title ) ) {
			$html .= '<h3>' . $title . '</h3>';
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
	 */
	public static function generate_pencil() {
		if ( is_customize_preview() ) {
			return '<a href="#" class="epsilon-section-editor"><span class="dashicons dashicons-edit"></span></a>';
		}

		return '';
	}
}
