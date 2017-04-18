<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * method to replace second or first (in case of no second) h2 with h2 and mobile advertisement
 * @param $text the content
 * @param $ad_id id for choosing right ad
 * @param $ad_place array for replacement
 * @return mixed the new content
 */
function add_ad_tag_to_text($text, $ad_id, $ad_place = array(1,0)) {

    $regx = '/<h2.*?>(\s|\S)+?<\/h2>/i';
	preg_match_all($regx, $text, $matches);

    if (isset($matches[0])) {
		if (isset($matches[0][$ad_place[0]])) {
			$text = str_replace($matches[0][$ad_place[0]], get_cis_box_html($ad_id) . $matches[0][$ad_place[0]], $text);
		} else if (isset($matches[0][$ad_place[1]])) {
			$text = str_replace($matches[0][$ad_place[1]], get_cis_box_html($ad_id) . $matches[0][$ad_place[1]], $text);
		}
	}
	return $text;

}

function get_cis_box_html($ad_id) {
	$CI = & get_instance();
	return '<div class="cis' . $ad_id . '">' . $CI->load->view('/component/ads', array('ad_id' => $ad_id, 'ad_tag'=> get_ad_tag($ad_id), 'ad_name' => get_ad_name($ad_id), 'ad_map' => get_ad_map($ad_id)), true) . '</div>';
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
