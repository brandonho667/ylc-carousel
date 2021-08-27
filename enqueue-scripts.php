<?php

defined( 'ABSPATH' ) or die(':)');


function video_popup_include_css_js() {
	wp_enqueue_style( 'video_popup_close_icon', plugins_url( '/css/vp-close-icon/close-button-icon.css', __FILE__ ), array(), time(), "all");
	wp_enqueue_style( 'oba_youtubepopup_css', plugins_url( '/css/YouTubePopUp.css', __FILE__ ), array(), time(), "all");
	wp_enqueue_script( 'oba_youtubepopup_plugin', plugins_url( '/js/YouTubePopUp.jquery.js', __FILE__ ), array('jquery'), time(), false);
	wp_enqueue_script( 'oba_youtubepopup_activate', plugins_url( '/js/YouTubePopUp.js', __FILE__ ), array('jquery'), time(), false);
}
add_action( 'wp_enqueue_scripts', 'video_popup_include_css_js' );

function carousel_include_css_js() {
    wp_register_script('carousel-js', plugin_dir_url(__FILE__) . 'js/carousel.js', array('jquery'), '1.0', true);
    wp_enqueue_script('carousel-js');
    wp_register_style('carousel-css', plugin_dir_url(__FILE__) . 'css/carousel.css', array(), rand(111,9999), 'all');
    wp_enqueue_style('carousel-css', plugin_dir_url(__FILE__) . 'css/carousel.css');
}

add_action('wp_enqueue_scripts', 'carousel_include_css_js');


function video_popup_unprm_vars_script(){
	
    $r_border = true;
	
	?>
		<script type='text/javascript'>
			var video_popup_unprm_general_settings = {
    			'unprm_r_border': '<?php echo $r_border; ?>'
			};
		</script>
	<?php
}
add_action('wp_head', 'video_popup_unprm_vars_script');