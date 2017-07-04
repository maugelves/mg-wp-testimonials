<?php
/*
Plugin Name: MG Testimonials
Plugin URI:  https://github.com/maugelves/mg-wp-testimonials
Description: Add Testimonials to your WordPress website with testimonial, name, image and position.
Version:     1.0
Author:      Mauricio Gelves
Author URI:  https://maugelves.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mgtestimonials
Domain Path: /languages
*/

// CONSTANTS
define( 'MGT_PATH', dirname( __FILE__ ) );
define( 'MGT_FOLDER', basename( MGT_PATH ) );
define( 'MGT_URL', plugins_url() . '/' . MGT_FOLDER );


/*
*   =================================================================================================
*   BASE CLASS
*   =================================================================================================
*/
include ( MGT_PATH . "/inc/base.php" );



/*
*   =================================================================================================
*   PLUGIN DEPENDENCIES
*   =================================================================================================
*/
include ( MGT_PATH . "/inc/libs/class-tgm-plugin-activation.php" );
add_action( 'tgmpa_register', array( 'MGSP_Base', 'check_plugin_dependencies' ) );



/*
*   =================================================================================================
*   CUSTOM POST TYPES
*   Include all the Custom Post Types you need in the 'includes/cpts/' folder and they will be loaded
*   automatically.
*   =================================================================================================
*/
foreach (glob(MGT_PATH . "/inc/cpts/*.php") as $filename)
	include $filename;




/*
*   =================================================================================================
*   ADVANCED CUSTOM FIELDS
*   Include all the Advanced Custom Fields you need in the 'includes/acfs/' folder and they will be loaded
*   automatically.
*   =================================================================================================
*/
foreach (glob(MGT_PATH . "/inc/acfs/*.php") as $filename)
	include $filename;