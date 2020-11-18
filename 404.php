<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">
	<div class="section-inner error404-content">
		<h1 class="entry-title"><?php echo "Siden ble ikke funnet" ?></h1>
		<div class="intro-text"><p><?php echo "Siden du lette etter eksisterer ikke. Den kan ha blitt flyttet, fått nytt navn eller har ikke eksistert i utgangspunktet." ?></p></div>
	</div><!-- .section-inner -->
</main><!-- #site-content -->
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
