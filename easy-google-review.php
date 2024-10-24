<?php
/**
 * Plugin Name:       Easy Google Review
 * Description:       This is the helper plugin of easy google review service
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            Glossy It
 * Author URI:        https://www.glossyit.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easy-google-review
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( !class_exists( "EasyGR" ) ) {

    final class EasyGR {

        /**
         * Instance Of EasyGR
         *
         * @var [instance]
         */
        private static $instance = null;

        /**
         * Container Of Classes
         *
         * @var array
         */
        public $controllers = [];

        /**
         * Construct of EasyGR
         */
        function __construct() {
            add_action( "plugin_loaded", [$this, "init"] );
        }

        /**
         * Singleton Instance
         * @return $instance
         */
        public static function Instance() {
            if ( self::$instance == null ) {
                self::$instance = new EasyGR();
            }
            return self::$instance;
        }

        /**
         * Initialization
         * @return void
         */
        public function init() {
            // Fire on plugins load and ready the textdomain for the plugin.
            $this->easygr_load_textdomain();
            //define constants for plugin
            $this->defineConstants();
            // Included Required Files
            $this->includeFiles();
            // Instantiate Classes
            $this->instantiateClasses();
        }

        /**
         * Define Constant
         * @return void
         */
        public function defineConstants() {
            if ( !defined( "EASYGR_URL" ) ) {
                define( "EASYGR_URL", plugin_dir_url( __FILE__ ) );
            }
            if ( !defined( "EASYGR_VERSION" ) ) {
                define( "EASYGR_VERSION", '1.0.0' );
            }
            if ( !defined( "EASYGR_PATH" ) ) {
                define( "EASYGR_PATH", plugin_dir_path( __FILE__ ) );
            }
            if ( !defined( "EASYGR_CLASS_PATH" ) ) {
                define( "EASYGR_CLASS_PATH", plugin_dir_path( __FILE__ ) . 'includes/classes/' );
            }
        }

        /**
         * Included Required Files
         */
        public function includeFiles() {
            require_once EASYGR_PATH . "/includes/helper-functions.php";
            require_once EASYGR_CLASS_PATH . "handlerequest.php";
            //Class File
            require_once EASYGR_CLASS_PATH . "assets.php";
            require_once EASYGR_CLASS_PATH . "admin.php";
            // require_once EASYGR_PATH . "/includes/elementor/elementor.php";
        }

        /**
         * Instantiate Classes
         *
         * @return void
         */
        public function instantiateClasses() {
            if ( is_admin() ) {
                $this->controllers['admin'] = EasyGR\Admin::Instance();
            }
            $this->controllers['assets'] = new EasyGR\Assets();
        }

        /**
         * Plugin Language file
         * @return void
         */
        public function easygr_load_textdomain() {
            load_plugin_textdomain( "easy-google-review", false, dirname( __FILE__ ) . "/languages" );
        }

    }

}

if ( !function_exists( 'easygr_init' ) ) {
        function easygr_init() {
            // globals
            global $easygr;
            // initialize
            if ( !isset( $easygr ) ) {
                $easygr = new \EasyGR();
            }
            return $easygr;
        }
}

// initialize
easygr_init();
