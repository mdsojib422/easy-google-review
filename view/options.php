<?php

use EasyGR\HandleRequest;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$easygr_applications = HandleRequest::getApplicationData();
?>
<div class="easygr-options-panel">
    <header class="easygr-options-panel-header">
        <h1><?php esc_html_e( "Easy Google Review", 'easy-google-review' );?></h1>
    </header>
    <div class='container'>
        <div class='sidepanel'>
            <div class='easygr-tab-item easygr-active-tab'>
                <i class='fa fa-bar-chart'></i>
                Connect
            </div>
            <div class='easygr-tab-item '>
                <i class='fa fa-bar-chart'></i>
                Applications
            </div>
        </div>
        <div class='main'>
            <?php include_once 'tabs/connects.php' ?>
            <?php include_once 'tabs/applications.php' ?>            
        </div>
    </div>

</div>