<?php
get_header();
?>

<main id="site-content" role="main">
	<?php
	$archive_title    = '';
	$archive_subtitle = '';

	if ( $archive_title || $archive_subtitle ) {
		?>
		<header class="archive-header has-text-align-center header-footer-group">
			<div class="archive-header-inner section-inner medium">
				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>
				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>
			</div><!-- .archive-header-inner -->
		</header><!-- .archive-header -->
		<?php
	}

	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}
  
  get_template_part( 'template-parts/pagination' ); ?>
</main><!-- #site-content -->
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php
get_footer();
