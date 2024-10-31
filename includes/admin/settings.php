<?php


function pwb3d_add_settings_page(){

    add_submenu_page('edit.php?post_type=paywithbank3d', 'Settings', 'Settings', 'edit_posts', basename(__FILE__), 'pwb3d_page_content');
}

function pwb3d_check($name, $value)
{
    if ($name == $value) {
        $result = "selected";
    } else {
        $result = "";
    }
    return $result;
}

function pwb3d_page_content(){
    $recipe_opts            = get_option( 'r_opts' );
?>


        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-10 col-md-8 col-lg-6">
                    <div class="card ">
                        <div class="card-body">

                        <form action="admin-post.php" method="post">
                            <h5 class="card-title text-center"><?php _e('PayWithBank3D Settings', 'recipe' ); ?></h5>
                            <?php
                            if( isset($_GET['status']) && $_GET['status'] == 1 ){
                                ?><div class="alert alert-success">Options updated successfully!</div><?php
                            }

                            ?>
                        <p class="card-text text-center">Get your API Keys <a href="https://www.bank3d.ng/" target="_blank">here</a></p>
                        <hr>
                            <input type="hidden" name="action" value="pwb3d_save_options">
                            <?php wp_nonce_field( 'pwb3d_options_verify' ); ?>
                        <div class="form-group">
                            <label><?php _e('Mode', 'paywithbank3d'); ?></label>
                            <select class="form-control" name="pwb3d_mode">
                                <option value="test" <?php echo pwb3d_check('test', esc_attr(get_option('pwb3d_mode'))) ?>>Test Mode</option>
                                <option value="live" <?php echo pwb3d_check('live', esc_attr(get_option('pwb3d_mode'))) ?>>Live Mode</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password"><?php _e('Merchant Test Key', 'paywithbank3d');  ?></label>
                            <input type="text" class="form-control password" name="pwb3d_mtk" value="<?php echo esc_attr(get_option('pwb3d_mtk')); ?>" />
                        </div>
                            <div class="form-group">
                                <label for="password"><?php _e('Merchant Test Secret Key', 'paywithbank3d');  ?></label>
                                <input type="text" class="form-control password" name="pwb3d_mtsi" value="<?php echo esc_attr(get_option('pwb3d_mtsi')); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password"><?php _e('Merchant Live Key', 'paywithbank3d');  ?></label>
                                <input type="text" class="form-control password" name="pwb3d_mlk" value="<?php echo esc_attr(get_option('pwb3d_mlk')); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="password"><?php _e('Merchant Live Secret Key', 'paywithbank3d');  ?></label>
                                <input type="text" class="form-control password" name="pwb3d_mlsi" value="<?php echo esc_attr(get_option('pwb3d_mlsi')); ?>" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-customized"><?php _e('Update Settings', 'paywithbank3d'); ?></button>
                            </div>


                    </form>
                        </div>
                        <div class="card-footer text-muted">
                            Secured By Bank3D
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php
}

function pwb3d_action_links($links)
{
    array_unshift( $links, '<a href="' . admin_url('edit.php?post_type=paywithbank3d&page=settings.php') . '">' . __('Settings', 'paywithbank3d') . '</a>' );

    return $links;
}



