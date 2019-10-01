<?php
if (!defined('ABSPATH')) die('-1');
class ILC_VC_Youtube_Player extends ILC_Shortcode {
	public static $script_loaded = false;
	public function get_attachment_url($attachment_id) {
		$attachment_url = wp_get_attachment_image_src($attachment_id, 'full');
		if($attachment_url){
			$attachment_url = $attachment_url[0];
		}
		return $attachment_url;
	}
	public function get_video_id_form_url($url) {
		$parts = parse_url($url);
		if(isset($parts['query'])){
			parse_str($parts['query'], $qs);
			if(isset($qs['v'])){
				return $qs['v'];
			}else if(isset($qs['vi'])){
				return $qs['vi'];
			}
		}
		if(isset($parts['path'])){
			$path = explode('/', trim($parts['path'], '/'));
			return $path[count($path)-1];
		}
		return false;
	}
	public function load_scripts(){
		if(!self::$script_loaded){
			self::$script_loaded = true;
			wp_enqueue_script('ilc-youtube-player-scripts', get_stylesheet_directory_uri() . '/assets/js/youtube-player.js', array('jquery'), null, true);
		}
	}
}
