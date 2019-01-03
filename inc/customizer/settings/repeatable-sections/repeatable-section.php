<?php
/**
 * Portum Theme Customizer repeatable section
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Repeatable_Section
 */
abstract class Repeatable_Section {

	/**
	 * Section fields
	 *
	 * @var array
	 */
	public $fields = array();
	/**
	 * Groups (TABS)
	 *
	 * @var array
	 */
	public $groups = array();
	/**
	 * @var string
	 */
	public $image = '';
	/**
	 * @var string
	 */
	public $id = '';
	/**
	 * @var string
	 */
	public $title = '';
	/**
	 * @var string
	 */
	public $description = '';
	/**
	 * @var boolean
	 */
	public $upsell = false;
	/**
	 * @var string
	 */
	public $upsell_text = '';
	/**
	 * @var string
	 */
	public $upsell_url = '';
	/**
	 * Integrations
	 *
	 * @var array
	 */
	public $integrations = array();

	/**
	 * Repeatable_Section constructor.
	 */
	public function __construct() {
		$this->set_id();
		$this->create_groups();
		$this->create_fields();
		$this->set_image();
		$this->set_title();
		$this->set_description();
		$this->set_integrations();
	}

	/**
	 * Invoking function
	 */
	public function __invoke() {
		return apply_filters( 'portum_section_' . $this->id, array(
				'id'          => $this->id,
				'fields'      => $this->fields,
				'groups'      => $this->groups,
				'image'       => $this->image,
				'title'       => $this->title,
				'description' => $this->description,
				'upsell'      => $this->upsell,
				'upsell_text' => $this->upsell_text,
				'upsell_url'  => $this->upsell_url,
				// 'integration' => $this->integrations
			) );
	}

	/**
	 * Creates the margin fields
	 */
	public function create_margin_fields() {
		return array(
			$this->id . '_margins_device_setter' => array(
				'label'   => esc_html__( 'Section margins', 'epsilon-framework' ),
				'type'    => 'select',
				'group'   => 'layout',
				'choices' => array(
					'desktop' => esc_html__( 'Desktop', 'epsilon-framework' ),
					'tablet'  => esc_html__( 'Tablet', 'epsilon-framework' ),
					'mobile'  => esc_html__( 'Mobile', 'epsilon-framework' ),
				),
			),
			$this->id . '_margins_desktop'       => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_margins_device_setter',
					'desktop',
				),
			),
			$this->id . '_margins_tablet'        => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_margins_device_setter',
					'tablet',
				),
			),
			$this->id . '_margins_mobile'        => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_margins_device_setter',
					'mobile',
				),
			),
		);
	}

	/**
	 * Creates the padding fields
	 */
	public function create_padding_fields() {
		return array(
			$this->id . '_paddings_device_setter' => array(
				'label'   => esc_html__( 'Section paddings', 'epsilon-framework' ),
				'type'    => 'select',
				'group'   => 'layout',
				'choices' => array(
					'desktop' => esc_html__( 'Desktop', 'epsilon-framework' ),
					'tablet'  => esc_html__( 'Tablet', 'epsilon-framework' ),
					'mobile'  => esc_html__( 'Mobile', 'epsilon-framework' ),
				),
			),
			$this->id . '_paddings_desktop'       => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_paddings_device_setter',
					'desktop',
				),
			),
			$this->id . '_paddings_tablet'        => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_paddings_device_setter',
					'tablet',
				),
			),
			$this->id . '_paddings_mobile'        => array(
				'label'     => '',
				'type'      => 'epsilon-margins-paddings',
				'group'     => 'layout',
				'condition' => array(
					$this->id . '_paddings_device_setter',
					'mobile',
				),
			),
		);
	}

	/**
	 * Creates the section fields
	 */
	public function create_fields() {
	}

	/**
	 * Creates groups
	 */
	public function create_groups() {
	}

	/**
	 * Set image
	 */
	public function set_image() {
	}

	/**
	 * Sets ID
	 */
	public function set_id() {
	}

	/**
	 * Sets title
	 */
	public function set_title() {
	}

	/**
	 * Sets description
	 */
	public function set_description() {
	}

	/**
	 * Sets integrations
	 */
	public function set_integrations() {
	}

	/**
	 * Set group type
	 *
	 * @param $choices ;
	 *
	 * @return string;
	 */
	public function set_group_type( $choices = array() ) {
		$arr = array(
			0 => 'none',
			1 => 'one',
			2 => 'two',
			3 => 'three',
			4 => 'four',
			5 => 'five',
			6 => 'six',
		);

		return $arr[ count( $choices ) ];
	}
}
