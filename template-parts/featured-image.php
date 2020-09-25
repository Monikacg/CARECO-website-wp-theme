<?php

if ( has_post_thumbnail() && ! post_password_required() ) {
	$featured_media_inner_classes = '';
	if ( ! is_singular() ) {
		$featured_media_inner_classes .= ' medium';
	}
	?>

	<figure class="featured-media">
		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; ?>">
			<?php
			the_post_thumbnail();
			$caption = get_the_post_thumbnail_caption();
			if ( $caption ) {
				?>
				<figcaption class="wp-caption-text"><?php echo wp_kses_post( $caption ); ?></figcaption>
				<?php
			}
			?>
		</div><!-- .featured-media-inner -->
	</figure><!-- .featured-media -->
	<?php
}
