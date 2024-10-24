<?php
/*
 * Functions For EasyGR
 *
 */

use EasyGR\HandleRequest;

function handle_easygr_disconnect_apps() {
    check_ajax_referer( 'easygr_nonce', 'nonce' );
    if ( delete_option( "easygr_token" ) ) {
        // Return a success message
        wp_send_json_success( [ 'message' => 'Successfully disconnected!' ] );
    }
}
add_action( 'wp_ajax_easygr_disconnect_apps', 'handle_easygr_disconnect_apps' );

/* Sync data */
function handle_easygr_sync_apps_data() {
    check_ajax_referer( 'easygr_nonce', 'nonce' );
    HandleRequest::syncAllData();   
    // Return a success message
    wp_send_json_success( [ 'message' => 'Sync Data Successfully!' ] );
    
}
add_action( 'wp_ajax_easygr_sync_apps_data', 'handle_easygr_sync_apps_data' );
