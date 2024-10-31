<?php

function pwb3d_generate_form($atts){
    ob_start();
    global $current_user;
    $user_id = $current_user->ID;
    $email = $current_user->user_email;
    $fname = $current_user->user_firstname;
    $lname = $current_user->user_lastname;

    if ($fname == '' && $lname == '') {
        $fullname = '';
    } else {
        $fullname = $fname . ' ' . $lname;
    }
    $att =shortcode_atts(
        array(
            'id' => 0,
        ),
        $atts
    );
    $mk = pwb3d_getMerchantKey();
    if (!$mk) {
        $settingsLink = get_admin_url() . 'edit.php?post_type=paywithbank3d&page=settings.php';
        echo "<h5>You must set your PayWithBank3D API keys first <a href='" . $settingsLink . "'>settings</a></h5>";
    }elseif ($att['id'] != 0) {
        $obj = get_post($att['id']);
        if ($obj->post_type == 'paywithbank3d') {
            $amount = get_post_meta($att['id'], 'pwb3d_amount', true);
            //$thankyou = get_post_meta($att['id'], 'pwb3d_successmsg', true);
            $paybtn = get_post_meta($att['id'], 'pwb3d_paybtn', true);
            $loggedin = get_post_meta($att['id'], 'pwb3d_loggedin', true);
            $currency = get_post_meta($att['id'], 'pwb3d_currency', true);
            $useagreement = get_post_meta($att['id'], 'pwb3d_useagreement', true);
            $agreementlink = get_post_meta($att['id'], 'pwb3d_agreementlink', true);
            $minimum = get_post_meta($att['id'], 'pwb3d_minimum', true);
            $hidetitle = get_post_meta($att['id'], 'pwb3d_hidetitle', true);
            if ($minimum == "") {
                $minimum = 0;
            }
            if ((($user_id != 0) && ($loggedin == 'yes')) || $loggedin == 'no') {
                echo '<div id="pwb3dform">';

                echo '<form version="' . PWB3D_VERSION . '"  action="' . admin_url('admin-ajax.php') . '" url="' . admin_url() . '" method="post" id="pwb3d-form" class="park-form" novalidate>
				 <div class="park-row">';
                if ($hidetitle != 1) {
                    echo "<h1 id='b3d-form" . $att['id'] . "'>" . $obj->post_title . "</h1>";
                    echo "<hr class='style-seven'>";
                }
                echo '<input type="hidden" name="action" value="pwb3d_submit_action">';
                echo '<input type="hidden" name="pwb3d-id" value="' . $att['id'] . '" />';
                echo '<input type="hidden" name="pwb3d-user_id" value="' . $user_id . '" />';
                echo '<input type="hidden" name="pwb3d-currency" id="pwb3d-currency" value="' . $currency . '" />';
                echo '<div class="span12 unit">
				 <label class="label">Full Name <span>*</span></label>
				 <div class="input">
					 <input type="text" name="pwb3d-fname" placeholder="First & Last Name" value="' . $fullname . '"
					 ';
                echo ' required>
				 </div>
			     </div>';
                echo '<div class="span12 unit">
				 <label class="label">Email <span>*</span></label>
				 <div class="input">
					 <input type="email" name="pwb3d-email" placeholder="Enter Email Address"  id="pwb3d-email" value="' . $email . '"
					 ';
                if ($loggedin == 'yes') {
                    echo 'readonly ';
                }
                echo ' required>
				 </div>
                 </div>';
                echo '<div class="span12 unit">
				 <label class="label">Amount (' . $currency;
                if ($minimum == 0 && $amount != 0 ) {
                    echo ' ' . number_format($amount);
                }
                echo ') <span>*</span></label>
				 <div class="input">';
                if ($minimum == 1) {
                    echo '<small> Minimum payable amount <b style="font-size:87% !important;">' . $currency . '  ' . number_format($amount) . '</b></small>';
                    //make it available for javascript so we can test against the input value
                    echo '<input type="hidden" name="pwb3d-minimum-hidden" value="' . $amount . '" id="pwb3d-minimum-hidden">';

                    echo '<span id="pwb3d-min-val-warn" style="color: red; font-size: 13px;"></span> 
				</div>
			 </div>';

                }
                if ($amount == 0) {
                    echo '<div class="span12 unit">';
                    echo '<input type="text" name="pwb3d-amount" class="pwb3d-number" value="0" id="pwb3d-amount" required/>';
                    echo '</div>';
                } elseif ($amount != 0 && $minimum == 1) {
                    echo '<div class="span12 unit">';
                    echo '<input type="text" name="pwb3d-amount" value="' . $amount . '" id="pwb3d-amount" required/>';
                    echo '</div>';
                } else {
                    echo '<div class="span12 unit">';
                    echo '<input type="text" name="pwb3d-amount" value="' . $amount . '" id="pwb3d-amount" readonly required/>';
                    echo '</div>';
                }
                echo (do_shortcode($obj->post_content));

                if ($useagreement == 'yes') {
                    echo '<div class="span12 unit">
						<label class="checkbox ">
							<input type="checkbox" name="pwb3d_agreement" id="pwb3d-agreement" required value="yes">
							<i id="pwb3d-agreementicon" ></i>
							Accept terms <a target="_blank" href="' . $agreementlink . '">Link </a>
						</label>
					</div><br>';
                }

                echo '<div class="span12 unit">
						<small><span style="color: red;">*</span> are compulsory</small><br />
						<img src="' . plugins_url('../../assets/images/Secured-by-Bank3D@2x.png', __FILE__) . '" alt="cardlogos"  class="pwb3d-logos size-full wp-image-1096" />

							<button type="reset" class="secondary-btn">Reset</button>';


                    echo '<button type="submit" class="primary-btn">' . $paybtn . '</button>';

                echo '</div>';

                echo '</div>
            </form>';
                echo '</div>';
                

            }else {
                echo "<h5>You must be logged in to make payment</h5>";
            }
        }
    }

    //$generatorHtml = file_get_contents('generate_template.php', true);
    //return $generatorHtml;
    return ob_get_clean();
}


function pwb3d_text_shortcode($atts){
    $att =shortcode_atts(
        array(
            'name' => 'Title',
            'required' => '0',
        ),
        $atts
    );
    $code = '<div class="span12 unit">
		<label class="label">' . ucwords($att['name']);
    if ($att['required'] == 'required') {
        $code .= ' <span>*</span>';
    }
    $code .= '</label>
		<div class="input">
			<input type="text" name="' . $att['name'] . '" placeholder="Enter ' . $att['name'] . '"';
    if ($att['required'] == 'required') {
        $code .= ' required="required" ';
    }
    $code .= '" /></div></div>';
    return $code;
}

add_shortcode('pwb3d_text', 'pwb3d_text_shortcode');

function pwb3d_select_shortcode($atts)
{
   $att= shortcode_atts(
            array(
                'name' => 'Title',
                'options' => '',
                'required' => '0',
            ),
            $atts
    );

    $code = '<div class="span12 unit">
		<label class="label">' . ucwords($att['name']);
    if ($att['required'] == 'required') {
        $code .= ' <span>*</span>';
    }
    $code .= '</label>
		<div class="input">
			<select class="form-control"  name="' . $att['name'] . '"';
    if ($att['required'] == 'required') {
        $code .= ' required="required" ';
    }
    $code .= ">";

    $selectOptions = explode(',', $att['options']);
    if (count($selectOptions) > 0) {
        foreach ($selectOptions as $key => $option) {
            $code .= '<option  value="' . $option . '" >' . ucwords($option) . '</option>';
        }
    }
    $code .= '" </select><i></i></div></div>';
    return $code;
}
add_shortcode('pwb3d_select', 'pwb3d_select_shortcode');

function pwb3d_radio_shortcode($atts)
{
    $att =shortcode_atts(
            array(
                'name' => 'Title',
                'options' => '',
                'required' => '0',
            ),
            $atts
    );

    $code = '<div class="span12 unit">
		<label class="label">' . ucwords($att['name']);
    if ($att['required'] == 'required') {
        $code .= ' <span>*</span>';
    }
    $code .= '</label>
		<div class="inline-group">
		';
    $RadioOptions = explode(',', $att['options']);
    if (count($RadioOptions) > 0) {
        foreach ($RadioOptions as $key => $option) {
            // $code.= '<option  value="'.$option.'" >'.$option.'</option>';
            $code .= '<label class="radio">
				<input type="radio" name="' . $att['name'] . '" value="' . $option . '"';
            if ($key == 0) {
                $code .= ' checked';
                if ($att['required'] == 'required') {
                    $code .= ' required="required"';
                }
            }

            $code .= '/>
				<i></i>
				' . ucwords($option) . '
			</label>';
        }
    }
    $code .= '</div></div>';
    return $code;
}
add_shortcode('pwb3d_radio', 'pwb3d_radio_shortcode');

function pwb3d_checkbox_shortcode($atts)
{
    $att =shortcode_atts(
            array(
                'name' => 'Title',
                'options' => '',
                'required' => '0',
            ),
            $atts
    );

    $code = '<div class="span12 unit">
		<label class="label">' . $att['name'];
    if ($att['required'] == 'required') {
        $code .= ' <span>*</span>';
    }
    $code .= '</label>
		<div class="inline-group">
		';
    $checkboxOptions = explode(',', $att['options']);
    if (count($checkboxOptions) > 0) {
        foreach ($checkboxOptions as $key => $option) {
            // $code.= '<option  value="'.$option.'" >'.$option.'</option>';
            $code .= '<label class="checkbox">
				<input type="checkbox" name="' . $att['name'] . '[]" value="' . $option . '"';
            if ($key == 0) {
                $code .= ' checked';
                if ($att['required'] == 'required') {
                    $code .= ' required="required"';
                }
            }

            $code .= '/>
				<i></i>
				' . $option . '
			</label>';
        }
    }
    $code .= '</div></div>';
    return $code;
}
add_shortcode('pwb3d_checkbox', 'pwb3d_checkbox_shortcode');

function pwb3d_textarea_shortcode($atts)
{
    $att =shortcode_atts(
            array(
                'name' => 'Title',
                'required' => '0',
            ),
            $atts
    );
    $code = '<div class="span12 unit">
		<label class="label">' . ucwords($att['name']);
    if ($att['required'] == 'required') {
        $code .= ' <span>*</span>';
    }
    $code .= '</label>
		<div class="input">
			<textarea type="text" name="' . $att['name'] . '" rows="3" placeholder="Enter ' . $att['name'] . '"';
    if ($att['required'] == 'required') {
        $code .= ' required="required" ';
    }
    $code .= '" ></textarea></div></div>';
    return $code;
}
add_shortcode('pwb3d_textarea', 'pwb3d_textarea_shortcode');

function pwb3d_generate_new_code($length = 10)
{
    $characters = '06EFGHI9KL' . time() . 'MNOPJRSUVW01YZ923234' . time() . 'ABCD5678QXT';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return time() . "_" . $randomString;
}

function pwb3d_check_code($code)
{
    global $wpdb;
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    $code_exist = $wpdb->get_results("SELECT * FROM $table WHERE txn_code = '" . $code . "'");

    if (count($code_exist) > 0) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function pwb3d_generate_code()
{
    $code = 0;
    $check = true;
    while ($check) {
        $code = pwb3d_generate_new_code();
        $check = pwb3d_check_code($code);
    }

    return $code;
}

function pwb3d_get_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

