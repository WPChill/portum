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
		$this->set_upsell();
		$this->set_integrations();
	}

	/**
	 * Invoking function
	 */
	public function __invoke() {
		return apply_filters(
			'portum_section_' . $this->id,
			array(
				'id'          => $this->id,
				'fields'      => $this->fields,
				'groups'      => $this->groups,
				'image'       => $this->image,
				'title'       => $this->title,
				'description' => $this->description,
				'upsell'      => $this->upsell,
				// 'integration' => $this->integrations
			)
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
	 * Sets upsell
	 */
	public function set_upsell() {
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
