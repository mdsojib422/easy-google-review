<?php

use EasyGR\HandleRequest;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$userInfo = HandleRequest::savedUserInformation();
?>
<div id="easygr-connect" class="easygr-tab-content">
    <div class='main__header'>
        <h2>Connect With Easy Google Review</h2>
        <div class="easygr-connect-with">
            <?php echo empty($userInfo) ? '<button id="easygr-connect-btn" class="easygr-btn">Connect With Apps</button>' : '<a id="easygr-sync" href="#">Sync Data</a><button id="easygr-discount" class="easygr-btn">Discount Apps</button>';  ?>
        </div>
    </div>
    <div class='main__content'>
        <?php 
            if(!empty($userInfo)):        
        ?>
        <div class="easygr-card">           
            <div class="easygr-user-details">
                <div class="user-details">
                    <div class="easygr-userid-label"><h4>#<?php echo esc_html($userInfo->id); ?></h4></div>
                    <div class="user-info">
                        <img src="<?php echo esc_attr(EASYGR_URL . '/assets/img/person.png'); ?>" alt="User Avatar" class="avatar">
                        <div class="info">
                            <h2><?php echo esc_html($userInfo->name); ?></h2>
                            <p><?php echo esc_html($userInfo->email); ?></p>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="easygr-subscription-details">
                <div class="subscription-details">
                    <h3>Subscription Details</h3>
                    <p class="plan-name"><?php echo esc_html($userInfo->payment[0]->plan_name); ?> Plan</p>
                    <span class="status active">Active</span>
                    <?php if($userInfo->payment[0]->paid_till): ?>
                    <p>Next Billing: <?php echo esc_html($userInfo->payment[0]->paid_till);  ?></p>
                    <?php else: ?>
                    <p></p>
                    <?php endif; ?>

                    <a href="<?php echo esc_url('https://phplaravel-1196969-4821714.cloudwaysapps.com/login'); ?>" target="_blank" class="manage-btn">Manage Subscription</a>
                </div>
            </div>
        </div>
        
        <?php else: ?>
            <div class="easygr-warning"><p>Connect your application to retrieve the user and plan information.</p></div>
        <?php endif; ?>
    </div>
</div>