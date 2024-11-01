<?php
/*
Plugin Name: Techlineinfo Social Count and Share
Plugin URI: http://www.techlineinfo.com/mashable-inspired-social-count-and-share-plugin-for-wordpress
Description: A plugin to display social share icons and a counter which displays the total number of social shares as seen in the popular website Mashable
Author: Sujith Kumar
Version: 1.0.4
Author URI: http://www.techlineinfo.com
License: GPL2
*/
/*-------------------------------------------------*/
include_once('msssh-admin.php');
include_once('msssh-calling.php');
// Get URL of first image in a post
function catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
// no image found display default image instead
//pinterest Default image/
if(empty($first_img)){
$options = get_option('msssh_options');
$pin = $options['pinterest_default_img'];
$first_img = $pin;
if(empty($first_img))
{
$first_img=plugins_url('images/pinterest_default.jpg',__FILE__);
}
}
return $first_img;
}
// Default Values//
function msssh_defaults(){
	    $default = array(
		'enable'   => 1,
		'msssh_embed'   => 'auto_embed',
		'show_single'  => 1,
		'show_page'    => 0,
		'above_below_page'    => 1,
'sticky'   => 1,
'sticky_bar_offset'    => 400,
'twitter_handle'    => 'techlineinfo',
'twitter_button_text'    => 'Tweet on Twitter',
'fb_button_text'    => 'Share on Facebook',
'twitter_handle'    => 'techlineinfo',
		'above_below_post'    => 1,
		'pinterest_default_img'=>plugins_url('images/pinterest_default.jpg',__FILE__),
'sticky_bar_logo'=>plugins_url('images/default_logo.png',__FILE__)
		    ); 
	return $default;
}

	
//add style and script in head section
add_action('admin_init','msssh_backend_script');
add_action('wp_enqueue_scripts','msssh_frontend_script');
// backend script
function msssh_backend_script()
{
	if(is_admin())
	{
		wp_enqueue_script('jquery');
		wp_enqueue_style('msssh_backend_script',plugins_url('css/msssh-admin.css',__FILE__));
	}
}
function msssh_frontend_script()
{
	if(!is_admin())
	{	
wp_enqueue_script('jquery');
wp_enqueue_script('msssh-minscript', plugins_url('js/msssh.js', __FILE__ ) );
wp_enqueue_style('prefix-font-awesome', plugins_url('css/mssh.css',__FILE__));	
	}
}
function msssh_custom_js() {
?>
   <script>
var $ = jQuery.noConflict();
jQuery(document).ready(function($){
				jQuery(".csbuttons").cSButtons({total:"#total,#total2","url":"<?php echo get_permalink();?>",});
			});
  (function($) {          
    $(document).ready(function(){ 
 jQuery("#main_header").hide();                   
        $(window).scroll(function(){                          
            if ($(this).scrollTop() > <?php $options = get_option('msssh_options'); echo $options['sticky_bar_offset'] ?>) {
                $("#main_header").fadeIn(300);
            } else {
                $("#main_header").fadeOut(300);
            }
        });
    });
})(jQuery);
</script>

<?php 
}
add_action('wp_head', 'msssh_custom_js');
// 'ADMIN_MENU'//
add_action('admin_menu', 'msssh_plugin_admin_menu');
function msssh_plugin_admin_menu() {
    add_menu_page('Techlineinfo Social Share and Counter', 'Techline Social','administrator', 'msssh_share', 'msssh_backend_menu',plugins_url('images/techline.png',__FILE__));
}

// RUNS WHEN PLUGIN IS ACTIVATED AND ADD OPTION IN wp_option TABLE -
//------------------------------------------------------------------
register_activation_hook(__FILE__,'msssh_plugin_install');
function msssh_plugin_install() {
    add_option('msssh_options', msssh_defaults());
}	
//admin links//
add_filter('plugin_action_links', 'myplugin_plugin_action_links', 10, 2);

function myplugin_plugin_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=msssh_share">Settings</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}
// get version
function msssh_plugin_version(){
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
?>
