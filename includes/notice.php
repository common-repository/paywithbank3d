<?php

function pwb3d_admin_notice(){
    $mode =  esc_attr(get_option('pwb3d_mode'));
    if($mode === 'test') {
        ?>
        <div class="notice notice-warning is-dismissible" id="pwb3d_recipe_pending_notice">
            <p> <?php _e('Your PayWithBank3D Form Is Currently On Test Mode, <a href="'.admin_url().'edit.php?post_type=paywithbank3d&page=settings.php">Click Here to Switch To Live Mode</a>', 'paywithbank3d'); ?></p>
        </div>
        <?php
    }
}
