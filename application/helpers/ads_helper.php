<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * method to replace second or first (in case of no second) h2 with h2 and mobile advertisement
 * @param $text the content
 * @param $keyword keyword for choosing right ad
 * @return mixed the new content
 */
function add_ad_tag_to_text($text, $keyword = false) {
	
	$CI = & get_instance();

	$regx = '/<h2.*?>(\s|\S)+?<\/h2>/i';
	preg_match_all($regx, $text, $matches);
	if (isset($matches[0])) {
		// empty <p></p> tag is for design border, see #DOC-413
		if (isset($matches[0][1])) {
			$text = str_replace($matches[0][1], $matches[0][1] . '<p></p><div class="cis2">' . $CI->load->view('/component/ads', array('ad_id'=>2, 'ad_tag'=> get_ad_tag(2), 'ad_name' => get_ad_name(2), 'ad_map' => get_ad_map(2), 'keyword' => $keyword), true) . '</div>', $text);
		} else if (isset($matches[0][0])) {
			$text = str_replace($matches[0][0], $matches[0][0] . '<p></p><div class="cis2">' . $CI->load->view('/component/ads', array('ad_id'=>2, 'ad_tag'=> get_ad_tag(2), 'ad_name' => get_ad_name(2), 'ad_map' => get_ad_map(2), 'keyword' => $keyword), true) . '</div>', $text);
		}
	}

	return $text;

}

/**
 * return ad tag by ad id
 * @param int $ad_id - the id of the ad
 * @return string ad tag - the ad tag from config
 */
function get_ad_tag($ad_id) {

	$CI = & get_instance();
	$CI->config->load('ads');

	$ad_config = $CI->config->item('ad');

	if (isset($ad_config[$ad_id]['tag'])) {
		return $ad_config[$ad_id]['tag'];
	} else {
		return '';
	}

}

/**
 * return ad name by ad id
 * @param int $ad_id - the id of the ad
 * @return string ad name - the ad name from config
 */
function get_ad_name($ad_id) {

	$CI = & get_instance();
	$CI->config->load('ads');

	$ad_config = $CI->config->item('ad');

	if (isset($ad_config[$ad_id]['name'])) {
		return $ad_config[$ad_id]['name'];
	} else {
		return '';
	}

}

/**
 * return ad map (the sizes) by ad id
 * @param int $ad_id - the id of the ad
 * @return string ad map - the ad map from config 
 */
function get_ad_map($ad_id) {

	$CI = & get_instance();
	$CI->config->load('ads');

	$ad_config = $CI->config->item('ad');

	if (isset($ad_config[$ad_id]['map'])) {
		return $ad_config[$ad_id]['map'];
	} else {
		return '';
	}

}
