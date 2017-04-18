<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/hellomohsinkhan
 * @since      1.0.0
 *
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/public
 * @author     Mohsin Khan <hellomohsinkhan@gmail.com>
 */
class Insert_post_from_front_end_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Insert_post_from_front_end_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Insert_post_from_front_end_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/insert_post_from_front_end-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Insert_post_from_front_end_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Insert_post_from_front_end_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/insert_post_from_front_end-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    function Insert_post_from_frontEnd($atts) {

        if (isset($_POST['title'])) {
            if (!isset($_POST['verify_insert_post']) || !wp_verify_nonce($_POST['verify_insert_post'], 'inser_post_from_front')) {
                print 'Sorry, your nonce did not verify.';
                exit;
            }
            if (!empty($atts)) {
                $posttype = $atts['post_type'];
                $poststatus = $atts['status'];
            } else {
                $posttype = "post";
                $posttype = "draft";
            }
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            $wp_upload_directory = wp_upload_dir();
            $wp_upload_dir = $wp_upload_directory['path'];
            $upload_overrides = array('test_form' => false);
            $new_post = array(
                'post_title' => wp_strip_all_tags($_POST['title']),
                'post_status' => 'publish',
                'post_type' => $posttype,
                'post_content' => $_POST['mycustomeditor'],
            );
            $files = $_FILES['file'];
            //save the new post
            $pid = wp_insert_post($new_post);
            if ($files['name']) {
                $uploadedfile = array(
                    'name' => $files['name'],
                    'type' => $files['type'],
                    'tmp_name' => $files['tmp_name'],
                    'error' => $files['error'],
                    'size' => $files['size']
                );
            }
            $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
            if ($movefile && !isset($movefile['error'])) {
                $attachment = array(
                    'guid' => $movefile['url'],
                    'post_mime_type' => $movefile['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($wp_upload_dir . '/' . $files['name'])),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $wp_upload_dir . '/' . $files['name'], $pid);
                $attach_data = wp_generate_attachment_metadata($attach_id, $wp_upload_dir . '/' . $files['name']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                set_post_thumbnail($pid, $attach_id);
            } else {
                echo '<div class="alert alert-danger">
  <strong>Error!</strong> Try again error occured.
</div>';
            }
            echo '<div class="alert alert-success">
  <strong>Success!</strong>
</div>';
        }
        include "partials/insert_post_from_front_end-public-display.php";
    }

}
