<?php
/**
* Plugin Name: Kieker Side menu
* Plugin URI: http://kiekerweb.co.za
* Description: This plugin adds a side menu that is toggled by a icon on the main menu.
* Version: 1.0.0
* Author: John-henry Ross
* Author URI: http://kiekerweb.co.za
* License: GPL2
*/

defined( 'ABSPATH' ) or die( 'No scripts please!' );

if (is_admin())
{
include('mysettings.php');}
function kiekersidemenu_enqueue_styles() 
{
    wp_enqueue_style( 'kiekersidemenu-style', get_site_url() .'/wp-content/plugins/kiekersidemenu/style.css' );
    wp_enqueue_style('fontAwesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); // adds icon support for font awesome
    wp_enqueue_script( 'kiekersidemenu-scripts', get_site_url() . '/wp-content/plugins/kiekersidemenu/js/sidemenu.js',array('jquery'));
    

}
add_action( 'wp_enqueue_scripts', 'kiekersidemenu_enqueue_styles' );

/**
 * Proper way to enqueue scripts and styles
 */


add_filter( 'wp_nav_menu_items', 'add_mainMenu_custom_icon', 10, 2 );
function add_mainMenu_custom_icon ( $items, $args ) {
    if (get_parent_class('.navbar-toggle') != '#popout') {
        $items .= '<li class="navbar-toggle"> <i class="fa fa-bars"></i> Menu</li>';
    }
    return $items;
}

function kiekersidemenu_menu(){
	$option = get_option( 'my_option_name', false );
?>
<div id='popout' style="background-color:<?php echo $option['bg-color'];?>" data-menu-title="<?php echo $option['title'];?>">
	<div class="border"></div>
	<div class='navbar-close' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
		<i class='fa fa-times'><!--Close Icon--></i> Close
	</div>
<?php
	$file = dirname(__FILE__) . '/kiekersidemenu.php';
$plugin_url = plugin_dir_url($file);
// Output something like: http://example.com/wp-content/plugins/your-plugin/
$plugin_path = plugin_dir_path($file);
// Output something like: /home/mysite/www/wp-content/plugins/your-plugin/
	 include($plugin_path .'helpers/CSS_Menu_Walker.php');
	 wp_nav_menu( array( 'menu' => 'primary', 'container_id' => 'cssmenu', 'walker' => new CSS_Menu_Walker())); ?>
	 <div class="socialicons">
		 <?php if (isset($option['facebook']) && $option['facebook'] != null){?>
		 <a href="<?php echo $option['facebook'];?>" target="_blank"><i class="fa fa-facebook"><!-- Facebook icon --></i></a><?php } ?>
			<?php if (isset($option['twitter'] )&& $option['twitter'] != null){?>
		  <a href="<?php echo $option['twitter'];?>" target="_blank"><i class="fa fa-twitter"><!-- Twitter icon --></i></a><?php } ?>
		  <?php if (isset($option['linkedin'] )&& $option['linkedin'] != null){?>
		  <a href="<?php echo $option['linkedin'];?>" target="_blank"><i class="fa fa-linkedin"><!-- Linkedin icon --></i></a><?php } ?>
		  <?php if (isset($option['youtube'] )&& $option['youtube'] != null){?>
		  <a href="<?php echo $option['youtube'];?>" target="_blank"><i class="fa fa-youtube"><!-- youtube icon --></i></a><?php } ?>
	 </div>
</div>    

<?php
}
add_action( 'wp_footer', 'kiekersidemenu_menu');
/*function pw_load_scripts($hook) {
 
	if( $hook == 'options-general.php' ) 
		return;
 
	wp_enqueue_script( 'iris',$plugin_url.'/helpers/Automattic-Iris/js/iris.min.js' );
 wp_enqueue_script( 'iris-init','/wp-content/plugins/kiekersidemenu/js/iris-init.js' );
}
add_action('admin_enqueue_scripts', 'pw_load_scripts');*/

add_action( 'admin_enqueue_scripts', 'my_color_picker' );
function my_color_picker() {

	wp_enqueue_script( 'iris',$plugin_url.'/helpers/Automattic-Iris/js/iris.min.js' );
 wp_enqueue_script( 'iris-init','/wp-content/plugins/kiekersidemenu/js/iris-init.js' );

}
?>