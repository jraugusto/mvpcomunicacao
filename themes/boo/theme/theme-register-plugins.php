<?php
/**
 * Themerella Theme Framework
 * Include the TGM_Plugin_Activation class and register the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 */

rella()->load_library( 'class-tgm-plugin-activation' );

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', '_s_register_required_plugins' );

function _s_register_required_plugins() {

	$images = get_template_directory_uri() . '/theme/plugins/images';

	$plugins = array(

		array(
			'name' 		        => esc_html__( 'Infinite Addons', 'boo' ),
			'slug' 		        => 'infinite-addons',
			'required' 	        => true,
			'source'            => 'http://api.themerella.com/download.php?type=plugins&file=infinite-addons.zip',
			'rella_logo'        => $images . '/extension-placeholder.jpg',
			'version'               => '1.3.8',
			'rella_author'      => 'Themerella',
			'rella_description' => 'Boo core theme plugin.',
		),

		array(
			'name' 		        => esc_html__( 'Infinite Portfolio', 'boo' ),
			'slug' 		        => 'infinite-portfolio',
			'version'               => '1.2',
			'required' 	        => false,
            'source'            => 'http://api.themerella.com/download.php?type=plugins&file=infinite-portfolio.zip',
			'rella_logo'        => $images . '/extension-placeholder.jpg',
			'rella_author'      => 'Themerella',
			'rella_description' => 'Portfolio custom posts for Boo theme',
		),

		array(
			'name' 		        => esc_html__( 'Visual Composer', 'boo' ),
			'slug' 		        => 'js_composer',			
			'required' 	        => true,
            'source'            => 'http://api.themerella.com/download.php?type=plugins&file=js_composer.zip',
			'rella_logo'        => $images . '/vcomposer.png',
			'version'               => '5.4.7',
			'rella_author'      => 'Wpbakery',
			'rella_description' => 'A premium plugin bundled with the Boo theme',
		),
		
		array(
			'name'              => esc_html__( 'Redux Framework', 'boo' ),
			'slug' 		        => 'redux-framework',
			'required' 	        => true,
			'rella_logo'        => $images . '/redux.png',
			'rella_author'      => 'Team Redux',
			'rella_description' => 'Redux is a simple, truly extensible and fully responsive options framework for WordPress themes and plugins.'
		),
		
		array(
			'name'              => esc_html__( 'Revolution Slider', 'boo' ),
			'slug'              => 'revslider',
			'required' 	        => true,
            'source'            => 'http://api.themerella.com/download.php?type=plugins&file=revslider.zip',
			'rella_logo'        => $images . '/revslider.png',
			'rella_author'      => 'ThemePunch',
			'version'               => '5.4.5.1',
			'rella_description' => 'Slider Revolution - Premium responsive slider'
		),

        array(
			'name'              => esc_html__( 'Contact Form 7', 'boo' ),
			'slug'              => 'contact-form-7',
			'required'          => false,
			'rella_logo'        => $images . '/extension-placeholder.jpg',
			'rella_author'      => 'Takayuki Miyoshi',
			'rella_description' => 'Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup.'
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
	);

	tgmpa( $plugins, $config );
}