<?php
/*
 * Plugin Name:      Certficate Verification 
* Plugin URI:        https://github.com/shakib6472/
* Description:       Verify Tutor LMS Certificate
* Version:           1.1.0
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Shakib Shown
* Author URI:        https://github.com/shakib6472/
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       cvs
* Domain Path:       /languages
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Cvs')) {
    class Cvs
    {
        public function __construct()
        {
            add_action('init', array($this, 'cvs_init'));
            add_action('wp_enqueue_scripts', array($this, 'cvs_enqueue_scripts'));
            add_shortcode('cvs', array($this, 'cvs_shortcode'));
            add_action('admin_menu', array($this, 'cvs_admin_menu'));
        }

        public function cvs_init()
        {
            load_plugin_textdomain('cvs', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }
        public function cvs_enqueue_scripts()
        {
            wp_enqueue_style('cvs-style', plugin_dir_url(__FILE__) . 'assets/style.css', array(), '1.0.0', 'all');
            // jquery is already included in WordPress, so we don't need to include it again.
            // wp_enqueue_script('jquery');
            wp_enqueue_script('cvs-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), '1.0.0', true);
            wp_localize_script('cvs-script', 'cvs_ajax', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'home_url' => home_url('/'),
            ));
        }
        public function cvs_shortcode($atts)
        {
            ob_start();
            include(plugin_dir_path(__FILE__) . 'cvs-form.php');
            return ob_get_clean();
        }

        public function cvs_admin_menu()
        {
            add_menu_page(
                'All Certificates', // Page title
                'All Certificates', // Menu title
                'manage_options',   // Capability
                'cvs-all-certificates', // Menu slug
                'cvs_all_certificates_page', // Callback function
                'dashicons-awards', // Icon
                6                   // Position
            );
        }
    }
}
new Cvs();

require_once plugin_dir_path(__FILE__) . 'admin/all-certificates.php';

function verify_certificate (){
    global $wpdb;
    $certID = $_POST['certId'];
    //get from comments table whre comment_content is equal to certID
    $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}comments WHERE comment_content = %s", $certID));
    $student_id = $result->comment_author;
    $issue_date = $result->comment_date;
    $student_name = $wpdb->get_var($wpdb->prepare("SELECT display_name FROM {$wpdb->prefix}users WHERE ID = %d", $student_id));
    $certificate_id = $result->comment_content; 
    $certificate_date = date('F j, Y', strtotime($issue_date));
    // Create an array JS response
    $response = array(
        'student_name' => $student_name,
        'certificate_id' => $certificate_id,
        'certificate_date' => $certificate_date,
    );
    if ($result) {
        // Certificate ID is valid
        wp_send_json_success($response);
    } else {
        // Certificate ID is invalid
        wp_send_json_error('Certificate ID is invalid!');
    }

}
add_action('wp_ajax_verify_certificate', 'verify_certificate');
add_action('wp_ajax_nopriv_verify_certificate', 'verify_certificate');