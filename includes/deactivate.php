<?php

function pwb3d_deactivate_plugin(){
    wp_unschedule_hook('b3d_send_invoice');
    wp_unschedule_hook('b3d_send_receipts_owner');
    wp_unschedule_hook('b3d_send_receipts');
}
