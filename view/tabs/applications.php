<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="applications" class="easygr-tab-content">
    <div class='main__header'>
        <h2>Your Applications</h2>
    </div>

    <div class="easygr-table-wrapper">
        <?php if(!empty($easygr_applications)): ?>
        <table class="app-table">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Application Name</th>
                    <th>Shortcode</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (is_array( $easygr_applications->application ) ) {
                        $i = 1;
                        foreach ( $easygr_applications->application as $app ) {
                ?>
                <tr>
                    <td><?php echo esc_html($i); ?></td>
                    <td><h3><?php echo $app->widget_name; ?></h3></td>
                    <td><span class='shortcode copiable_wrap'>
                    <input type='text' onfocus='this.select();' readonly='readonly' value='[easygr id="<?php echo esc_html($app->id); ?>"]' class='copiable_input' >
                    <span class='tooltip'>Click To Copy</span></td>
                    <td>
                        <a href="https://phplaravel-1196969-4821714.cloudwaysapps.com/review/show/<?php echo esc_html($app->id); ?>" class="preview" target="_blank">
                            <img height="40" src="<?php echo EASYGR_URL . '/assets/img/preview.png'; ?>" alt="">
                        </a>
                    </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
        <?php else:  ?>
            <div class="easygr-warning"><p>Connect your application to retrieve the application widget.</p></div>
        <?php endif; ?>
    </div>

</div>