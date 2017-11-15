<?php
/**
 * Template part for the support tab in welcome screen
 *
 * @package Epsilon Framework
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<div class="feature-section">
	<div class="row two-col">
		<div class="col">
			<h3><i class="dashicons dashicons-sos"></i><?php esc_html_e( 'Contact Support', 'epsilon-framework' ); ?></h3>
			<p>
				<i><?php esc_html_e( 'We offer excellent support through our advanced ticketing system. Make sure to register your purchase before contacting support!', 'epsilon-framework' ); ?></i>
			</p>
			<p><a target="_blank" class="button button-primary"
				  href="<?php echo esc_url( 'https://www.machothemes.com/support/?utm_source=' . $this->theme_slug . '&utm_medium=customizer' ); ?>"><?php esc_html_e( 'Contact Support', 'epsilon-framework' ); ?></a>
			</p>
		</div><!--/.col-->

		<div class="col">
			<h3><i class="dashicons dashicons-book-alt"></i><?php esc_html_e( 'Documentation', 'epsilon-framework' ); ?></h3>
			<p>
				<i><?php esc_html_e( 'This is the place to go to reference different aspects of the theme. Our online documentation is an incredible resource for learning the ins and outs of using our theme.', 'epsilon-framework' ); ?></i>
			</p>
			<p>
				<a target="_blank"
				   href="<?php echo esc_url( 'http://docs.machothemes.com/' ); ?>"><?php esc_html_e( 'See our full documentation', 'epsilon-framework' ); ?></a>
			</p>
		</div><!--/.col-->
	</div>
	<div class="row three-col">
		<div class="col">
			<h3><i class="dashicons dashicons-performance"></i><?php esc_html_e( 'How to speed up WordPress', 'epsilon-framework' ); ?></h3>
			<p>
				<i><?php esc_html_e( 'Take a look at why website speed is crucial and ways you can speed up WordPress so that you can confidently say you hold your own amongst the billions of web pages!', 'epsilon-framework' ); ?></i>
			</p>
			<p><a target="_blank"
				  href="<?php echo esc_url( 'https://www.machothemes.com/blog/how-to-speed-up-wordpress/?utm_source=worg&utm_medium=customizer&utm_campaign=blog-links' ); ?>"><?php esc_html_e( 'Read more', 'epsilon-framework' ); ?></a>
			</p>
		</div><!--/.col-->

		<div class="col">
			<h3><i class="dashicons dashicons-shield"></i><?php esc_html_e( 'Best security plugins', 'epsilon-framework' ); ?></h3>
			<p>
				<i><?php esc_html_e( 'Thinking that the best WordPress security plugins aren’t going to come cheap, not to mention free? Luckily, that’s not the case.', 'epsilon-framework' ); ?></i>
			</p>
			<p>
				<a target="_blank"
				   href="<?php echo esc_url( 'https://www.machothemes.com/blog/best-wordpress-security-plugins/?utm_source=worg&utm_medium=customizer&utm_campaign=blog-links' ); ?>"><?php esc_html_e( 'Read more', 'epsilon-framework' ); ?></a>
			</p>
		</div><!--/.col-->

		<div class="col">
			<h3><i class="dashicons dashicons-analytics"></i><?php esc_html_e( 'Cheap WordPress hosting', 'epsilon-framework' ); ?></h3>
			<p>
				<i><?php esc_html_e( 'There are so many services offering cheap WordPress hosting out there that picking a winner can often seem like a game of chance. This article will hopefully allow you to make an informed decision, catered to your needs', 'epsilon-framework' ); ?></i>
			</p>
			<p>
				<a target="_blank"
				   href="<?php echo esc_url( 'https://www.machothemes.com/blog/cheap-wordpress-hosting/?utm_source=worg&utm_medium=customizer&utm_campaign=blog-links' ); ?>"><?php esc_html_e( 'Read more', 'epsilon-framework' ); ?></a>
			</p>
		</div><!--/.col-->
	</div>
</div><!--/.feature-section-->
