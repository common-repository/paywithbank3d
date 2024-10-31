<?php

function pwb3d_disable_wyswyg($default){
    global $post_type, $_wp_theme_features;
    if ($post_type == 'paywithbank3d') {
        echo "<style>#edit-slug-box,#message p > a{display:none;}</style>";
        remove_action('media_buttons', 'media_buttons');
        remove_meta_box('postimagediv', 'post', 'side');
        add_filter('user_can_richedit', '__return_false', 50);
        add_filter('quicktags_settings', 'pwb3d_remove_fullscreen');
        add_action('wp_dashboard_setup', 'pwb3d_remove_dashboard_widgets');
        add_action("admin_print_footer_scripts", "pwb3d_shortcode_button_script");

        //add_filter( 'preview_post_link', 'pwb3d_posttype_admin_css' );

    }
    return $default;
}

function pwb3d_posttype_admin_css($arg){
    var_dump($arg);
    die();
}

function pwb3d_remove_fullscreen($qtInit){
    $qtInit['buttons'] = 'fullscreen';
    return $qtInit;
}


function pwb3d_remove_dashboard_widgets(){
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
    // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}
//70763

function pwb3d_shortcode_button_script()
{
    if (wp_script_is("quicktags")) {
        ?>
        <script type="text/javascript">
            //this function is used to retrieve the selected text from the text editor
            function getSel() {
                var txtarea = document.getElementById("content");
                var start = txtarea.selectionStart;
                var finish = txtarea.selectionEnd;
                return txtarea.value.substring(start, finish);
            }

            QTags.addButton(
                "ta_shortcode",
                "Insert Text",
                insertText
            );

            function insertText() {
                QTags.insertContent('[pwb3d_text name="Text Title"]');
            }
            QTags.addButton(
                "tab_shortcode",
                "Insert Textarea",
                insertTextarea
            );

            function insertTextarea() {
                QTags.insertContent('[pwb3d_textarea name="Text Title"]');
            }
            QTags.addButton(
                "sc_shortcode",
                "Insert Select Dropdown",
                insertSelectb
            );

            function insertSelectb() {
                QTags.insertContent('[pwb3d_select name="Text Title" options="option 1,option 2,option 3"]');
            }
            QTags.addButton(
                "rd_shortcode",
                "Insert Radio Options",
                insertRadiob
            );

            function insertRadiob() {
                QTags.insertContent('[pwb3d_radio name="Text Title" options="option 1,option 2,option 3"]');
            }
            QTags.addButton(
                "cbe_shortcode",
                "Insert Checkbox Options",
                insertCheckboxb
            );

            function insertCheckboxb() {
                QTags.insertContent('[pwb3d_checkbox name="Text Title" options="option 1,option 2,option 3"]');
            }
            QTags.addButton(
                "ngsh_shortcode",
                "Insert Nigerian States",
                insertSelectStates
            );

            function insertSelectStates() {
                QTags.insertContent('[pwb3d_select name="State" options="Abia,Adamawa,Akwa Ibom,Anambra,Bauchi,Bayelsa,Benue,Borno,Cross River,Delta,Ebonyi,Edo,Ekiti,Enugu,FCT,Gombe,Imo,Jigawa,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara"]');
            }
            QTags.addButton(
                "ctysi_shortcode",
                "Insert All Countries",
                insertSelectCountries
            );

            function insertSelectCountries() {
                QTags.insertContent('[pwb3d_select  name="country" options="Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, Antarctica, Antigua and Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, Bhutan, Bolivia, Bosnia and Herzegovina, Botswana, Bouvet Island, Brazil, British Indian Ocean Territory, Brunei Darussalam, Bulgaria, Burkina Faso, Burundi, Cambodia, Cameroon, Canada, Cape Verde, Cayman Islands, Central African Republic, Chad, Chile, China, Christmas Island, Cocos (Keeling) Islands, Colombia, Comoros, Congo, Congo, The Democratic Republic of The, Cook Islands, Costa Rica, Cote D’ivoire, Croatia, Cuba, Cyprus, Czech Republic, Denmark, Djibouti, Dominica, Dominican Republic, Ecuador, Egypt, El Salvador, Equatorial Guinea, Eritrea, Estonia, Ethiopia, Falkland Islands (Malvinas), Faroe Islands, Fiji, Finland, France, French Guiana, French Polynesia, French Southern Territories, Gabon, Gambia, Georgia, Germany, Ghana, Gibraltar, Greece, Greenland, Grenada, Guadeloupe, Guam, Guatemala, Guinea, Guinea-bissau, Guyana, Haiti, Heard Island and Mcdonald Islands, Holy See (Vatican City State), Honduras, Hong Kong, Hungary, Iceland, India, Indonesia, Iran, Islamic Republic of, Iraq, Ireland, Israel, Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, Korea, Democratic People’s Republic of, Korea, Republic of, Kuwait, Kyrgyzstan, Lao People’s Democratic Republic, Latvia, Lebanon, Lesotho, Liberia, Libyan Arab Jamahiriya, Liechtenstein, Lithuania, Luxembourg, Macao, Macedonia, The Former Yugoslav Republic of, Madagascar, Malawi, Malaysia, Maldives, Mali, Malta, Marshall Islands, Martinique, Mauritania, Mauritius, Mayotte, Mexico, Micronesia, Federated States of, Moldova, Republic of, Monaco, Mongolia, Montserrat, Morocco, Mozambique, Myanmar, Namibia, Nauru, Nepal, Netherlands, Netherlands Antilles, New Caledonia, New Zealand, Nicaragua, Niger, Nigeria, Niue, Norfolk Island, Northern Mariana Islands, Norway, Oman, Pakistan, Palau, Palestinian Territory, Occupied, Panama, Papua New Guinea, Paraguay, Peru, Philippines, Pitcairn, Poland, Portugal, Puerto Rico, Qatar, Reunion, Romania, Russian Federation, Rwanda, Saint Helena, Saint Kitts and Nevis, Saint Lucia, Saint Pierre and Miquelon, Saint Vincent and The Grenadines, Samoa, San Marino, Sao Tome and Principe, Saudi Arabia, Senegal, Serbia and Montenegro, Seychelles, Sierra Leone, Singapore, Slovakia, Slovenia, Solomon Islands, Somalia, South Africa, South Georgia and The South Sandwich Islands, Spain, Sri Lanka, Sudan, Suriname, Svalbard and Jan Mayen, Swaziland, Sweden, Switzerland, Syrian Arab Republic, Taiwan, Province of China, Tajikistan, Tanzania, United Republic of, Thailand, Timor-leste, Togo, Tokelau, Tonga, Trinidad and Tobago, Tunisia, Turkey, Turkmenistan, Turks and Caicos Islands, Tuvalu, Uganda, Ukraine, United Arab Emirates, United Kingdom, United States, United States Minor Outlying Islands, Uruguay, Uzbekistan, Vanuatu, Venezuela, Viet Nam, Virgin Islands, British, Virgin Islands, U.S., Wallis and Futuna, Western Sahara, Yemen, Zambia, Zimbabwe"] ');
            }

            //
        </script>
        <?php
    }
}