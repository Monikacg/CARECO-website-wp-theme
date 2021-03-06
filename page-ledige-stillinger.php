<?php
get_header();
?>

<main id="site-content-ledige-stillinger" role="main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?><article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      	<?php
      	get_template_part( 'template-parts/entry-header' );
      	?>
      	<div class="post-inner">
      		<div class="entry-content">
      			<?php
      			the_content();
      			?>
      		</div><!-- .entry-content -->
      	</div><!-- .post-inner -->

      	<div class="section-inner">
      		<?php
      		wp_link_pages(
      			array(
      				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
      				'after'       => '</nav>',
      				'link_before' => '<span class="page-number">',
      				'link_after'  => '</span>',
      			)
      		);
      		?>
      	</div><!-- .section-inner -->
      </article><?php
		}
	}?>
</main><!-- #site-content -->
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
