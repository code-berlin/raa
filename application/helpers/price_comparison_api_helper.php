<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function get_drug_info($pzn) {

	// http://cis3.docjones.de/customer_information/pzn/4/1/1/09461151
	$base = 'http://cis3.docjones.de/customer_information/pzn/';
	$ad_type = 4;
	$ad_subtype = 1;
	$portal_id = 1;


	$ch =  curl_init($base . $ad_type . '/' . $ad_subtype . '/' . $portal_id . '/' . $pzn);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $result = curl_exec($ch);

    return $result;

}