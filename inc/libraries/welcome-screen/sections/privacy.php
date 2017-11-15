<?php
/**
 * Template part for the getting started tab in welcome screen
 *
 * @package Epsilon Framework
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
<div class="privacy-section">
	<form method="post" action="options.php">
		<?php settings_fields( 'portum-privacy' ); ?>
		<?php foreach ( $this->privacy_options as $option ) { ?>

			<div class="checkbox_switch" style="width:60%">
				<span class="customize-control-title onoffswitch_label">
					<?php echo esc_html( $option['label'] ); ?>
				</span>
				<div class="onoffswitch">
					<input type="checkbox" id="<?php echo esc_attr( $option['id'] ); ?>" name="<?php echo esc_attr( $option['id'] ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $option['value'] ); ?>"
						<?php echo ( $option['checked'] ) ? 'checked="checked"' : ''; ?> >
					<label class="onoffswitch-label" for="<?php echo esc_attr( $option['id'] ); ?>"></label>
				</div>
			</div>
		<?php } ?>
		<br/>
		<?php wp_nonce_field( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ); ?>
		<?php submit_button(); ?>
	</form>
</div><!--/.feature-section-->
