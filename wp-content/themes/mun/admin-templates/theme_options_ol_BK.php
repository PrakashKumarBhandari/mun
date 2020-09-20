<?php
//register settings
function theme_options_add(){
    register_setting( 'theme_settings', 'theme_settings' );
}
 
//add settings page to menu
function add_options() {
add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'settings', 'theme_options_page');
}
//add actions
add_action( 'admin_init', 'theme_options_add' );
add_action( 'admin_menu', 'add_options' );
 
//start settings page
function theme_options_page() {
 
if ( ! isset( $_REQUEST['updated'] ) )
$_REQUEST['updated'] = false;
 
//get variables outside scope
global $color_scheme;
?>
<div>
    <form method="post" action="options.php">
        <h2>Theme Options</h2>
        <?php settings_fields( 'theme_settings' ); ?>
        <?php $options = get_option( 'theme_settings' ); ?>
        <table>
            <tr valign="top">
                <th scope="row" width="30%"><?php _e( 'Footer About us' ); ?></th>
                <td  width="70%">                    
                    <textarea id="theme_settings[contactus]" name="theme_settings[contactus]" rows="5"
                        cols="36"><?php esc_attr_e( $options['contactus'] ); ?></textarea>
                    </td>
            </tr>
            <!-- <tr valign="top">
                <th scope="row"><?php _e( 'Tracking Code' ); ?></th>
                <td>
                    <textarea id="theme_settings[tracking]" name="theme_settings[tracking]" rows="5"
                        cols="36"><?php esc_attr_e( $options['tracking'] ); ?></textarea></td>
            </tr> -->
            <tr valign="top">
                <th scope="row"><?php _e( 'Open Hours' ); ?></th>
                <td>
                    <textarea id="theme_settings[openhour]" name="theme_settings[openhour]" rows="5"
                        cols="36"><?php esc_attr_e( $options['openhour'] ); ?></textarea></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e( 'Custom Logo' ); ?></th>
                <td><input id="theme_settings[custom_logo]" type="text" size="36" name="theme_settings[custom_logo]"
                        value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
                    <label for="theme_settings[custom_logo]"><?php _e( 'Enter the URL to your custom logo' ); ?></label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Facebook URL' ); ?></th>
                <td><input id="theme_settings[facebookurl]" type="text" size="36" name="theme_settings[facebookurl]"
                        value="<?php esc_attr_e ($options['facebookurl'] ); ?>" />
                    <label for="theme_settings[facebookurl]"><?php _e( 'Enter Facebook URL' ); ?></label> </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Twitter URL' ); ?></th>
                <td><input id="theme_settings[twitterurl]" type="text" size="36" name="theme_settings[twitterurl]"
                        value="<?php esc_attr_e ($options['twitterurl'] ); ?>" />
                    <label for="theme_settings[twitterurl]"><?php _e( 'Enter Twitter URL' ); ?></label> </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Instagram URL' ); ?></th>
                <td><input id="theme_settings[instaurl]" type="text" size="36" name="theme_settings[instaurl]"
                        value="<?php esc_attr_e ($options['instaurl'] ); ?>" />
                    <label for="theme_settings[instaurl]"><?php _e( 'Enter Instagram  URL' ); ?></label> </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Youtube URL' ); ?></th>
                <td><input id="theme_settings[youtubeurl]" type="text" size="36" name="theme_settings[youtubeurl]"
                        value="<?php esc_attr_e ($options['youtubeurl'] ); ?>" />
                    <label for="theme_settings[youtubeurl]"><?php _e( 'Enter Youtube  URL' ); ?></label> </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e( 'Tripadvisor URL' ); ?></th>
                <td><input id="theme_settings[tripadvisor]" type="text" size="36" name="theme_settings[tripadvisor]"
                        value="<?php esc_attr_e ($options['tripadvisor'] ); ?>" />
                    <label for="theme_settings[tripadvisor]"><?php _e( 'Enter Tripadvisor  URL' ); ?></label> </td>
            </tr>


            <tr valign="top">
                <th scope="row"><?php _e( 'Contact Number' ); ?></th>
                <td>
                        <textarea id="theme_settings[contact_number]" name="theme_settings[contact_number]" rows="5"
                        cols="36"><?php esc_attr_e( $options['contact_number'] ); ?></textarea>
                    <label for="theme_settings[contact_number]"><?php _e( 'Enter Contact Number' ); ?></label> </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e( 'Contact Email' ); ?></th>
                <td> <textarea id="theme_settings[contact_email]" name="theme_settings[contact_email]" rows="5"
                        cols="36"><?php esc_attr_e( $options['contact_email'] ); ?></textarea>
                    <label for="theme_settings[contact_email]"><?php _e( 'Enter Contact Email' ); ?></label> </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e( 'Contact Address' ); ?></th>
                <td><textarea id="theme_settings[contact_address]" name="theme_settings[contact_address]" rows="5"
                        cols="36"><?php esc_attr_e( $options['contact_address'] ); ?></textarea>
                    <label for="theme_settings[contact_address]"><?php _e( 'Enter Contact Address' ); ?></label> </td>
            </tr>
            

        </table>
        <p><input name="submit" id="submit" value="Save Changes" type="submit"></p>
    </form>

</div><!-- END wrap -->

<?php
}
?>