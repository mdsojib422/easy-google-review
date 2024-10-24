<?php
namespace EasyGR;
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Admin {
    public static $instance = '';

    /**
     * Singleton Instance
     * @return $instance
     */
    public static function Instance() {
        if ( self::$instance == null ) {
            self::$instance = new Admin();
        }
        return self::$instance;
    }
    public function __construct() {
        add_action( 'admin_menu', [$this, 'easygr_options_page'] );
        add_action( 'admin_enqueue_scripts', [$this, 'easygr_options_page_assets'] );
    }

    public function easygr_options_page_assets( $screen ) {
        if ( $screen !== 'toplevel_page_easygr-options' ) {
            return;
        }
        wp_enqueue_style( 'easygr-options-page', EASYGR_URL . 'assets/css/easygr-main.css' ); 
        wp_enqueue_script( 'easygr-options-page', EASYGR_URL . 'assets/js/easygr-main.js', [], time(), true );

        $obj = [
            'redirectUrl'=> admin_url('admin.php?page=easygr-options'),
            'ajax_url' => admin_url("admin-ajax.php"),
            'nonce'   => wp_create_nonce( 'easygr_nonce' ),
            
        ];
        
        wp_localize_script("easygr-options-page",'easygr',$obj);

    }

    public function easygr_options_page() {
        add_menu_page(
            __( "EasyGR Panel", "glossy-mega-menu" ),
            __( "EasyGR Panel", "glossy-mega-menu" ),
            'manage_options', // Capability
            'easygr-options', // Menu slug
            [$this, 'easygr_options_page_display'],
            'dashicons-admin-generic', // Icon
            20
        );

    }

    public function easygr_options_page_display() {
        HandleRequest::storedToken($_GET);
        include_once EASYGR_PATH . 'view/options.php';
    }

}
