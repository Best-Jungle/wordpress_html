<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fora
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="main_footer">
			<?php 
				$socialFooter = get_theme_mod('fora_theme_options_socialfooter', '');
				$facebookURL = get_theme_mod('fora_theme_options_facebookurl', '');
				$twitterURL = get_theme_mod('fora_theme_options_twitterurl', '');
				$googleplusURL = get_theme_mod('fora_theme_options_googleplusurl', '');
				$linkedinURL = get_theme_mod('fora_theme_options_linkedinurl', '');
				$instagramURL = get_theme_mod('fora_theme_options_instagramurl', '');
				$youtubeURL = get_theme_mod('fora_theme_options_youtubeurl', '');
				$pinterestURL = get_theme_mod('fora_theme_options_pinteresturl', '');
				$tumblrURL = get_theme_mod('fora_theme_options_tumblrurl', '');
				$vkURL = get_theme_mod('fora_theme_options_vkurl', '');
			?>
			<?php if($socialFooter == 1): ?>
					<div class="site-social-footer">
						<?php if (!empty($facebookURL)) : ?>
							<a href="<?php echo esc_url($facebookURL); ?>" title="<?php esc_attr_e( 'Facebook', 'fora' ); ?>"><i class="fa fa-facebook"><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($twitterURL)) : ?>
							<a href="<?php echo esc_url($twitterURL); ?>" title="<?php esc_attr_e( 'Twitter', 'fora' ); ?>"><i class="fa fa-twitter"><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($googleplusURL)) : ?>
							<a href="<?php echo esc_url($googleplusURL); ?>" title="<?php esc_attr_e( 'Google Plus', 'fora' ); ?>"><i class="fa fa-google-plus"><span class="screen-reader-text"><?php esc_html_e( 'Google Plus', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($linkedinURL)) : ?>
							<a href="<?php echo esc_url($linkedinURL); ?>" title="<?php esc_attr_e( 'Linkedin', 'fora' ); ?>"><i class="fa fa-linkedin"><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($instagramURL)) : ?>
							<a href="<?php echo esc_url($instagramURL); ?>" title="<?php esc_attr_e( 'Instagram', 'fora' ); ?>"><i class="fa fa-instagram"><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($youtubeURL)) : ?>
							<a href="<?php echo esc_url($youtubeURL); ?>" title="<?php esc_attr_e( 'YouTube', 'fora' ); ?>"><i class="fa fa-youtube"><span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($pinterestURL)) : ?>
							<a href="<?php echo esc_url($pinterestURL); ?>" title="<?php esc_attr_e( 'Pinterest', 'fora' ); ?>"><i class="fa fa-pinterest"><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($tumblrURL)) : ?>
							<a href="<?php echo esc_url($tumblrURL); ?>" title="<?php esc_attr_e( 'Tumblr', 'fora' ); ?>"><i class="fa fa-tumblr"><span class="screen-reader-text"><?php esc_html_e( 'Tumblr', 'fora' ); ?></span></i></a>
						<?php endif; ?>
						<?php if (!empty($vkURL)) : ?>
							<a href="<?php echo esc_url($vkURL); ?>" title="<?php esc_attr_e( 'VK', 'fora' ); ?>"><i class="fa fa-vk"><span class="screen-reader-text"><?php esc_html_e( 'VK', 'fora' ); ?></span></i></a>
						<?php endif; ?>
					</div><!-- .site-social -->
				<?php endif; ?>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fora' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fora' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'fora' ), '<a target="_blank" href="https://crestaproject.com/downloads/fora/" rel="nofollow" title="Fora Theme">Fora Light</a>', 'CrestaProject WordPress Themes' ); ?>
			</div><!-- .site-info -->
		</div><!-- .main_footer -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#top" id="toTop"><i class="fa fa-angle-up fa-lg"></i></a>
<?php wp_footer(); ?>

</body>
</html>
