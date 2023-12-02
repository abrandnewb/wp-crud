<?php 
/*
* Plugin name: WP CRUD
* Author: Biniyam AH
* Description: CRUD oprations plugin
*/

if( ! defined('ABSPATH') ) {
    exit;
}

if( is_admin()) {
    /* global $wpdb;
    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users", OBJECT);
    echo '<pre>';
    print_r($result);
    echo '</pre>'; */
}

//add_action('admin_notices', function(){ echo '<div class="notice notice-success is-dismissible"><p>crud_plugin_table table created</p></div>';});

/* ************************************** */

function activate_crud() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-crud-activator.php';
    Crud_Activator::activate();
}

//plugin activated
register_activation_hook( __FILE__, 'activate_crud' );

/* ************************************** */

function uninstall_crud() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-crud-uninstaller.php';
    Crud_Uninstaller::uninstall();
}
//plugin uninstalled
register_uninstall_hook(__FILE__, 'uninstall_crud');

/* ************************************** */



/* function fix_title($title) {
    return '<span style="color:red;">'.$title.'</span>';
}
add_filter('the_title','fix_title');
 */

//add plugin menu

function register_crud_menu_page() {
    add_menu_page('CRUD plugin page', 'CRUD PLGN', 'add_users', 'crudplugin', '_crud_admin_page_content', null, 6); 
}
add_action('admin_menu', 'register_crud_menu_page');

function _crud_admin_page_content(){
    require_once plugin_dir_path(__FILE__) . 'includes/class-crud.php';
    Crud::create();
    Crud::read();
    Crud::delete();
    
    /* $posts = get_posts();
    foreach($posts as $post) {
        echo $post->post_title;
       // var_dump($post);
    } */
}

add_shortcode('crudplgn', 'crudplgn');

function crudplgn($atts = [], $content = null) {
    require_once plugin_dir_path(__FILE__) . 'includes/class-crud.php';
    ob_start();
    $content = Crud::read();
    $content = ob_get_clean();
    return $content;
}


//echo shortcode_exists('crudplgn') ? "short code exists" : "No shortcode registered";
