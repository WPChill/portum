<?php
/**
 * Template part for displaying the author bio
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>

<?php

if ( ! get_theme_mod( 'portum_enable_author_box', true ) ) {
	return;
}

$curauth = get_userdata( $post->post_author );
?>
<div class="author-bio">
	<div class="author-bio-avatar">
		<!-- Avatar -->
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
	</div><!-- end .author-bio-avatar -->

	<div class="author-bio-info">
		<h6>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="post-author">
				<span class="post-author-name"><?php echo esc_html( get_the_author() ); ?></span> </a>
			<?php Portum_Profile_Fields::echo_social_media(); ?>
		</h6>

		<?php if ( ! empty( $curauth->description ) ) : ?>
			<p><?php esc_html( the_author_meta( 'description' ) ); ?></p>
		<?php endif; ?>
	</div><!-- end .author-bio-info -->
</div><!-- end .author-bio -->
