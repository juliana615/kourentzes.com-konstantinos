<?php
/*
Plugin Name: kko Google Login
Description: Add Google login functionality to your WordPress site.
*/

// Add your Google login code here
function kko_google_login_init() {
    require_once ABSPATH . WPINC . '/pluggable.php';

    $client_id     = get_option('kko_google_login_client_id');
    $client_secret = get_option('kko_google_login_client_secret');
    $redirect_uri  = wp_login_url();

   // $client_id     = 'YOUR_CLIENT_ID';
   // $client_secret = 'YOUR_CLIENT_SECRET';
   // $redirect_uri  = 'https://kourentzes.com/konstantinos/wp-login.php';

    // Check if the user is already logged in
    if (is_user_logged_in()) {
        return;
    }

    // Check if a user with the same Google ID exists
    if (isset($_GET['code'])) {
        $auth_code = $_GET['code'];

        // Rest of the code to obtain access_token, user_info, and check if the Google ID exists

        if (!isset($token->error)) {
            $access_token = $token->access_token;

            $user_info_url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $access_token;
            $user_info = json_decode(file_get_contents($user_info_url));

            // Check if the user with the same Google ID exists in the WordPress database
            $existing_user = get_users(array('meta_key' => 'google_id', 'meta_value' => $user_info->id));

            if ($existing_user) {
                // User with the same Google ID exists, log them in
                $user = $existing_user[0];
                wp_set_auth_cookie($user->ID);
                wp_redirect(home_url());
                exit;
            } else {
                // User with this Google ID doesn't exist, create a new user
                $userdata = array(
                    'user_login' => $user_info->id,
                    'user_email' => $user_info->email,
                    'user_pass'  => wp_generate_password(),
                );

                $user_id = wp_insert_user($userdata);

                if (!is_wp_error($user_id)) {
                    // User created successfully, save Google ID as user meta
                    update_user_meta($user_id, 'google_id', $user_info->id);

                    // Log in the newly created user
                    wp_set_auth_cookie($user_id);
                    wp_redirect(home_url());
                    exit;
                }
                else {
                    error_log('User integration failed: ' . print_r($user_id, true));
                }
            }
        }
        else {
            // Log the response for debugging
            error_log('OAuth Token Response: ' . print_r($token, true));
            error_log('User Info Response: ' . print_r($user_info, true));
        }
    }

    // Generate Google login URL
    $google_login_url = 'https://accounts.google.com/o/oauth2/auth?' .
        'client_id=' . $client_id .
        '&redirect_uri=' . $redirect_uri .
        '&response_type=code&scope=openid%20email%20profile';

   // echo '<a href="' . esc_url($google_login_url) . '">Login with Google</a>';
   
   echo '<a href="javascript:void(0);" onclick="openGoogleLoginPopup();">Login with Google</a>';
   
?>
<script>
function openGoogleLoginPopup() {
    
    var googleLoginUrl = 'https://accounts.google.com/o/oauth2/auth?' +
        'client_id=<?php echo esc_attr(get_option('kko_google_login_client_id')); ?>' +
        '&redirect_uri=' + encodeURIComponent('<?php echo wp_login_url(); ?>') +
        '&response_type=code&scope=openid%20email%20profile';

    
    var popup = window.open(googleLoginUrl, 'google-login-popup', 'width=600,height=400');
    popup.focus();

    // Check for popup window's status
    var checkPopupStatus = setInterval(function() {
        if (popup.closed) {
            clearInterval(checkPopupStatus); // Stop checking

            window.location.href = '<?php echo wp_login_url(); ?>';
        }
    }, 1000); // Check every 1 second
}
</script>

<?php

   
}

add_action('login_form', 'kko_google_login_init');


// Add a settings page to the admin menu
function kko_google_login_settings_menu() {
    add_options_page('kko Google Login Settings', 'Google Login Settings', 'manage_options', 'kko-google-login-settings', 'kko_google_login_settings_page');
}

add_action('admin_menu', 'kko_google_login_settings_menu');


// Callback function to display the settings page
function kko_google_login_settings_page() {
    ?>
    <div class="wrap">
        <h2>kko Google Login Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('kko-google-login-settings-group'); ?>
            <?php do_settings_sections('kko-google-login-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Google Client ID</th>
                    <td><input type="text" name="kko_google_login_client_id" value="<?php echo esc_attr(get_option('kko_google_login_client_id')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Google Client Secret</th>
                    <td><input type="text" name="kko_google_login_client_secret" value="<?php echo esc_attr(get_option('kko_google_login_client_secret')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


// Register and define the settings
function kko_google_login_register_settings() {
    register_setting('kko-google-login-settings-group', 'kko_google_login_client_id');
    register_setting('kko-google-login-settings-group', 'kko_google_login_client_secret');
}

add_action('admin_init', 'kko_google_login_register_settings');



