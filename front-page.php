<?php
get_header();
?>

<main id="site-content-front-page" role="main">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php
		$cover_header_style   = '';
		$cover_header_classes = '';

		$image_url = ! post_password_required() ? get_the_post_thumbnail_url( get_the_ID(), 'twentytwenty-fullscreen' ) : '';

		if ( $image_url ) {
			$cover_header_style   = ' style="background-image: url( ' . esc_url( $image_url ) . ' );"';
			$cover_header_classes = ' bg-image';
		}

		// Get the fixed background attachment option.
		if ( get_theme_mod( 'cover_template_fixed_background', true ) ) {
			$cover_header_classes .= ' bg-attachment-fixed';
		}
		?>

		<div class="cover-header<?php echo $cover_header_classes; ?>"<?php echo $cover_header_style; ?>>
			<div class="cover-header-inner-wrapper screen-height">
				<div class="cover-header-inner">
					<div class="forside"></div>
					<header class="entry-header has-text-align-center">
						<div class="entry-header-inner section-inner medium">
							<?php
							$logoURL = get_post_custom_values('hovedlogo')[0];
							if ($logoURL) {
								echo "<img src='$logoURL'/>";
							}
							?>
							<div class="to-the-content-wrapper">
								<a href="#post-inner" class="to-the-content">
									<div class="screen-reader-text"><?php _e( 'Scroll Down', 'twentytwenty' ); ?></div>
								</a><!-- .to-the-content -->
							</div><!-- .to-the-content-wrapper -->
						</div><!-- .entry-header-inner -->
					</header><!-- .entry-header -->
				</div><!-- .cover-header-inner -->
			</div><!-- .cover-header-inner-wrapper -->
		</div><!-- .cover-header -->

		<div class="post-inner" id="post-inner">
			<div class="entry-content">
				<?php
				the_content();
				?>
			</div><!-- .entry-content -->
		</div><!-- .post-inner -->
	</article><!-- .post -->
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
