<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function get_drug_info($pzn) {

    $CI = & get_instance();
    $CI->config->load('price_comparison');

    $api_config = $CI->config->item('price_comparison');

	// http://cis3.docjones.de/customer_information/pzn/4/0/1/00172333
	$base = $api_config['base'];
	$ad_type = $api_config['ad_type'];
	$ad_subtype = $api_config['ad_subtype'];
	$portal_id = $api_config['portal_id'];


	$ch =  curl_init($base . $ad_type . '/' . $ad_subtype . '/' . $portal_id . '/' . $pzn);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $result = curl_exec($ch);

    return $result;

}