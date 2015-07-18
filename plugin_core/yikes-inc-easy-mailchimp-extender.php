<?php/** * The plugin bootstrap file * * This file is read by WordPress to generate the plugin information in the plugin * admin area. This file also includes all of the dependencies used by the plugin, * registers the activation and deactivation functions, and defines a function * that starts the plugin. * * @link              http://www.yikesinc.com/ * @since             6.0.0-rc3 * @package           Yikes_Inc_Easy_Mailchimp_Extender * * @wordpress-plugin * Plugin Name:       Easy MailChimp Forms by YIKES Inc. * Plugin URI:        http://www.yikesinc.com/services/yikes-inc-easy-mailchimp-extender/ * Description:       This plugin connects your site to MailChimp and allows you to generate and display mailing list opt-in forms anywhere on your site. * Version:           6.0.0-rc3 * Author:            YIKES Inc. * Author URI:        http://www.yikesinc.com/ * License:           GPL-2.0+ * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt * Text Domain:       yikes-inc-easy-mailchimp-extender * Domain Path:       /languages**/ // If this file is called directly, abort.if ( ! defined( 'WPINC' ) ) {	die;}/** * Define constant path to our plugin. * * @since 3.0.0 (if available) * @var type $var Description. */if ( ! defined( 'YIKES_MC_PATH' ) ) {	define( 'YIKES_MC_PATH' , plugin_dir_path( __FILE__ ) );}/** * Define constant url to our plugin. * * @since 3.0.0 (if available) * @var type $var Description. */if ( ! defined( 'YIKES_MC_URL' ) ) {	define( 'YIKES_MC_URL' , plugin_dir_url( __FILE__ ) );}/** * Fire off during plugin activation. * * This action is documented in includes/class-yikes-inc-easy-mailchimp-extender-activator.php * and carries out some important tasks such as creating our custom database table if it doesn't * already exist. * * @since 6.0.0 */register_activation_hook( __FILE__, 'activate_yikes_inc_easy_mailchimp_extender' );function activate_yikes_inc_easy_mailchimp_extender( $network_wide ) {	require_once YIKES_MC_PATH . 'includes/class-yikes-inc-easy-mailchimp-extender-activator.php';    add_option( 'yikes_mailchimp_activation_redirect', true );	Yikes_Inc_Easy_Mailchimp_Extender_Activator::activate( $network_wide );}/** * The code that runs during plugin uninstall. * * This action is documented in includes/class-yikes-inc-easy-mailchimp-extender-uninstall.php * * @since 6.0.0 */register_uninstall_hook( __FILE__, 'uninstall_yikes_inc_easy_mailchimp_extender' ); function uninstall_yikes_inc_easy_mailchimp_extender() {	require_once YIKES_MC_PATH . 'includes/class-yikes-inc-easy-mailchimp-extender-uninstall.php';	Yikes_Inc_Easy_Mailchimp_Extender_Uninstaller::uninstall();}/** * Multisite blog creation * *	If a new blog is created on the mutli-site network *	we should run our activation hook to create the necessary form table *  * @since 6.0.0 */ add_action( 'wpmu_new_blog', 'yikes_easy_mailchimp_new_network_site', 10, 6);  function yikes_easy_mailchimp_new_network_site($blog_id, $user_id, $domain, $path, $site_id, $meta ) {    global $wpdb;	global $switched;    if ( is_plugin_active_for_network( 'yikes-inc-easy-mailchimp-extender/yikes-inc-easy-mailchimp-extender.php' ) ) {		require_once YIKES_MC_PATH . 'includes/class-yikes-inc-easy-mailchimp-extender-activator.php';        $old_blog = $wpdb->blogid;        switch_to_blog($blog_id);        Yikes_Inc_Easy_Mailchimp_Extender_Activator::activate( $networkwide=null );        switch_to_blog($old_blog);    }}/** * The core plugin class * admin-specific hooks, filters and functionality */require plugin_dir_path( __FILE__ ) . 'includes/class-yikes-inc-easy-mailchimp-extender.php';/** * Begins execution of the plugin. * * Since everything within the plugin is registered via hooks, * then kicking off the plugin from this point in the file does * not affect the page life cycle. * * @since    6.0.0 */function run_yikes_inc_easy_mailchimp_extender() {	$plugin = new Yikes_Inc_Easy_Mailchimp_Extender();	$plugin->run();}run_yikes_inc_easy_mailchimp_extender();