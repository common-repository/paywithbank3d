<?php

//load translations
function pwb3d_load_textdomain(){
    load_plugin_textdomain('paywithbank3d', false, dirname(dirname(plugin_basename(__FILE__))) . '/lang/');
}
