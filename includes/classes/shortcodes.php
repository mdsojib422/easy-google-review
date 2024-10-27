<?php
namespace EasyGR;
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Shortcode {
    protected $token = '';
    public function __construct() {
        if ( !shortcode_exists( "easygr" ) ) {
            add_shortcode( "easygr", [$this, "easygr_callback_fun"] );
            $this->token = get_option( "easygr_token" );
            add_action( "wp_enqueue_scripts", [$this, 'easygr_assets'] );
        }
    }
    public function easygr_assets() {
        wp_enqueue_script( "easygr-frontend", EASYGR_URL . '/assets/js/frontend.js', ['jquery'], EASYGR_VERSION, true );
    }
    public function easygr_callback_fun( $atts ) {
        $atts = shortcode_atts(
            [
                'id'     => '',
                'width'  => '100%',
                'height' => '900px',
            ], $atts
        );
        ob_start();
        if ( !empty( $this->token ) ) {
            echo '<div class="easygr-wrapper">';
            printf( "<div class='easygr-iframe-box' data-data='%s'></div>", json_encode($atts) );
            echo "</div>";

        } else {
            echo '<div class="easygr-warning"><p>Connect your application to retrieve the application widget.</p></div>';
        }
        return ob_get_clean();

    }

}