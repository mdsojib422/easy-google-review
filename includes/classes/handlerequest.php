<?php
namespace EasyGR;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Handle Requests Class
 */
class HandleRequest {

    protected static $LIST_API_URL = 'https://phplaravel-1196969-4821714.cloudwaysapps.com/api/application/list';
    protected static $USER_API_URL = 'https://phplaravel-1196969-4821714.cloudwaysapps.com/api/user/details';
    protected static $APP_VIEW_URL = 'https://phplaravel-1196969-4821714.cloudwaysapps.com/review/show';

    /**
     * Store the token if provided in the GET request
     */
    public static function storedToken( $_get ) {
        if ( !empty( $_get['token'] ) ) {
            $token = esc_html( sanitize_text_field( $_get['token'] ) );
            delete_transient( "easygr_getapplication" );
            update_option( "easygr_token", $token );
        }
    }

    /**
     * Get application data from API or cache
     */
    public static function getApplicationData() {
        $token = self::getToken();
        if ( !$token ) return null; // Return early if no token

        $application_data = get_transient( "easygr_getapplication" );
        if ( $application_data ) return $application_data;

        return self::cacheData( $token, self::$LIST_API_URL, "easygr_getapplication" );
    }

    /**
     * Get user information from API or cache
     */
    public static function savedUserInformation() {
        $token = self::getToken();
        if ( !$token ) return null; // Return early if no token

        $userinfo_data = get_transient( "easygr_userinfo" );
        if ( $userinfo_data ) return $userinfo_data;

        return self::cacheData( $token, self::$USER_API_URL, "easygr_userinfo" );
    }

    /**
     * Sync all data and cache
     */
    public static function syncAllData() {
        $token = self::getToken();
        if ( !$token ) return; // Return early if no token

        self::cacheData( $token, self::$LIST_API_URL, "easygr_getapplication" );
        self::cacheData( $token, self::$USER_API_URL, "easygr_userinfo" );
    }

    /**
     * Helper: Fetch data from the API and cache it
     */
    protected static function cacheData( $token, $apiUrl, $cache_key ) {
        $data = self::retriveData( $token, $apiUrl );
        if ( $data ) {
            set_transient( $cache_key, $data, 12 * HOUR_IN_SECONDS );
        }
        return $data;
    }

    /**
     * Helper: Retrieve data from the API
     */
    protected static function retriveData( $token, $apiUrl ) {
        try {
            $api_url = add_query_arg( 'token', $token, $apiUrl );
            $response = wp_remote_get( $api_url );

            if ( wp_remote_retrieve_response_code( $response ) === 200 && !is_wp_error( $response ) ) {
                $body = wp_remote_retrieve_body( $response );
                return json_decode( $body );
            }
        } catch ( \Throwable $th ) {
            error_log( $th->getMessage() );
        }
        return null;
    }

    /**
     * Helper: Retrieve the stored token
     */
    protected static function getToken() {
        return get_option( "easygr_token" ) ?: null;
    }
}
