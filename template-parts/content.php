<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	get_template_part( 'template-parts/entry-header' );
	get_template_part( 'template-parts/featured-image' );
	?>
	<div class="post-inner">
		<div class="entry-content">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->
	</div><!-- .post-inner -->
</article><!-- .post -->
