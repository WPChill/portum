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
	<h3>
		<?php esc_html_e( 'We believe in a better & streamlined user experiences', 'epsilon-framework' ); ?>
	</h3>
	<p>
		<?php esc_html_e( 'And as such, we\'ve made it easy for you - our user, to disable all of our theme upsells & recommendations.', 'epsilon-framework' ); ?>
	</p>
	<p>
		<?php esc_html_e( 'Mind you that we use these as a way to facilitate compatible product discovery - as in: plugins that enhance the
		user experience with any of our products. But, in the end, the user should always have a say in it.', 'epsilon-framework' ); ?>
	</p>
	<br/>
	<p>
		<?php echo wp_kses_post( __( 'By turning any or all of the toggles below to the <span style="color: green;">ON</span> position you\'ll be able
		to hide all upsells & recommended plugin discovery sections & actions.', 'epsilon-framework' ) ); ?>
	</p>
	<br/>
	<p>
		<?php echo wp_kses_post( __( '<u>We really hope</u> you\'ll enjoy using our products as much as we\'ve enjoyed building them.', 'epsilon-framework' ) ); ?>
	</p>
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
