<?php
/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
* THEME SUPPORT
*/
function twentytwenty_theme_support() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	load_theme_textdomain( 'twentytwenty' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	add_theme_support( 'customize-selective-refresh-widgets' );

	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
* REQUIRED FILES
*/
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';
require get_template_directory() . '/classes/class-twentytwenty-customize.php';
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';
require get_template_directory() . '/inc/custom-css.php';

/**
* Register and Enqueue Styles.
*/
function twentytwenty_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
* Register navigation menus uses wp_nav_menu in five places.
*/
function twentytwenty_menus() {
	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'twentytwenty_menus' );

function twentytwenty_get_custom_logo( $html ) {
	$logo_id = get_theme_mod( 'custom_logo' );
	if ( ! $logo_id ) {
		return $html;
	}
	$logo = wp_get_attachment_image_src( $logo_id, 'full' );
	if ( $logo ) {
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );
			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);
			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}
			$html = preg_replace( $search, $replace, $html );
		}
	}
	return $html;
}
add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}
add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

function twentytwenty_sidebar_registration() {
	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);
	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
				'before_title'  => '<h5 class="widget-title subheading heading-size-5">',
				'after_title'   => '</h5>',
			)
		)
	);
	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
				'before_title'  => '<h5 class="widget-title subheading heading-size-5">',
				'after_title'   => '</h5>',
			)
		)
	);
	// Footer #3.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #3', 'twentytwenty' ),
				'id'          => 'sidebar-3',
				'description' => __( 'Widgets in this area will be displayed in the third column in the footer.', 'twentytwenty' ),
				'before_title'  => '<h5 class="widget-title subheading heading-size-5">',
				'after_title'   => '</h5>',
			)
		)
	);
}
add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {
	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);
	add_editor_style( $classic_editor_styles );
}
add_action( 'init', 'twentytwenty_classic_editor_styles' );

function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {
	$styles = twentytwenty_get_customizer_css( 'classic-editor' );
	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}
	return $mce_init;
}
add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {
	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );
	if ( ! $styles ) {
		return $mce_init;
	}
	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}
	return $mce_init;
}
add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);
	add_theme_support( 'editor-styles' );

	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}
}
add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}
add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );
/*
	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);*/
}
add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#707372',
				'accent'    => '#ed8b00',
				'secondary' => '#707372',
				'borders'   => '#d6d2c4',
			),
			'footer' => array(
				'text'      => '#707372',
				'accent'    => '#ed8b00',
				'secondary' => '#707372',
				'borders'   => '#d6d2c4',
			),
			'header' => array(
				'text'      => '#707372',
				'accent'    => '#ed8b00',
				'secondary' => '#707372',
				'borders'   => '#d6d2c4',
			),
		)
	);
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	} else {
		return false;
	}
}

function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'footer' => array(
			'setting' => 'footer_background_color',
		),
		'header' => array(
			'setting' => 'header_background_color'
		)
	);
	return $colors;
}

function twentytwenty_get_elements_array() {

}
