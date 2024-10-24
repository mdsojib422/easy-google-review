<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
print_r($easygr_applications->application);
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
                    <td>[easygr id='']</td>
                    <td>
                        <a href="#" class="preview">
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