<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<script src="https://kit.fontawesome.com/32229c90e3.js" crossorigin="anonymous"></script>
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body class="home page-template page-template-templates page-template-template-cover page-template-templates template-cover-php page page-id-326 <?php if (is_admin_bar_showing()) {
		echo "logged-in admin-bar";
	}  ?> custom-background wp-custom-logo wp-embed-responsive singular overlay-header has-post-thumbnail has-no-pagination not-showing-comments show-avatars template-cover footer-top-visible customize-support" data-new-gr-c-s-check-loaded="14.984.0" data-gr-ext-installed="" data-gr-ext-disabled="forever">
		<?php
		wp_body_open();
		?>
		<header id="site-header" class="header" role="banner">
			<div class="header-inner section-inner">
				<div class="header-titles-wrapper">
					<div class="header-titles">
						<?php
							twentytwenty_site_logo();
						?>
					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php echo "Meny"; ?></span>
						</span>
					</button><!-- .nav-toggle -->
				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper">
					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>
							<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">
								<ul class="primary-menu reset-list-style">
								<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);
								} elseif ( ! has_nav_menu( 'expanded' ) ) {
									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);
								}
								?>
								</ul>
							</nav><!-- .primary-menu-wrapper -->
						<?php
					}

					if ( has_nav_menu( 'expanded' ) ) {
						?>
						<div class="header-toggles hide-no-js">
						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>
							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">
								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->
							</div><!-- .nav-toggle-wrapper -->
						<?php
						}
            ?>
						</div><!-- .header-toggles -->
						<?php
					}
					?>
				</div><!-- .header-navigation-wrapper -->
			</div><!-- .header-inner -->
		</header><!-- #site-header -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
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
			//$cover_header_classes .= ' bg-attachment-fixed';
		}
		?>

		<div class="cover-header<?php echo $cover_header_classes; ?>"<?php echo $cover_header_style; ?>>
			<div class="cover-header-inner-wrapper screen-height">
				<div class="cover-header-inner">
					<div class="forside">
					</div>
					<header class="entry-header has-text-align-center">
						<div class="entry-header-inner section-inner medium">
							<div class="wp-block-columns alignwide">
								<div class="wp-block-column is-vertically-aligned-top">
									<a href="http://careco.no/ser-du-etter-nye-muligheter/">
										<div class="wp-block-group has-background" style="background-color:rgba(91, 127, 149, 1); border-radius: 2rem;">
											<div class="wp-block-group__inner-container">
												<h2>
													Ser du etter nye muligheter?
												</h2>
											</div>
										</div>
									</a>
								</div>
								<div class="wp-block-column">
									<a href="http://careco.no/din-rekrutteringspartner/">
										<div class="wp-block-group has-background" style="background-color:rgba(91, 127, 149, 1); border-radius: 2rem;">
											<div class="wp-block-group__inner-container">
												<h2>
													Din IT-rekrutteringspartner
												</h2>
											</div>
										</div>
									</a>
								</div>
							</div>
							<?php
								$logoURL = get_post_custom_values('hovedlogo')[0];
								if ($logoURL) {
									/*echo "<img src='$logoURL'/>";*/
								}
							?>
							<div class="to-the-content-wrapper">
								<a href="#post-inner" class="to-the-content fill-children-current-color">
									<?php twentytwenty_the_theme_svg( 'arrow-down' ); ?>
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
