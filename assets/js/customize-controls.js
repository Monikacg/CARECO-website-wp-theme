/* global twentyTwentyBgColors, twentyTwentyColor, jQuery, wp, _ */
/**
 * Customizer enhancements for a better user experience.
 *
 * Contains extra logic for our Customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 */

( function() {
	// Wait until the customizer has finished loading.
	wp.customize.bind( 'ready', function() {

		// Add a listener for background-color changes.
		Object.keys( twentyTwentyBgColors ).forEach( function( context ) {
			wp.customize( twentyTwentyBgColors[ context ].setting, function( value ) {
				value.bind( function( to ) {
					// Update the value for our accessible colors for this area.
					twentyTwentySetAccessibleColorsValue( context, to, wp.customize( 'accent_hue' ).get(), to );
				} );
			} );
		} );

		// Show or hide retina_logo setting on the first load.
		twentyTwentySetRetineLogoVisibility( !! wp.customize( 'custom_logo' )() );

		// Add a listener for custom_logo changes.
		wp.customize( 'custom_logo', function( value ) {
			value.bind( function( to ) {
				// Show or hide retina_logo setting on changing custom_logo.
				twentyTwentySetRetineLogoVisibility( !! to );
			} );
		} );
	} );


	function twentyTwentySetRetineLogoVisibility( visible ) {
		wp.customize.control( 'retina_logo' ).container.toggle( visible );
	}
}( jQuery ) );
