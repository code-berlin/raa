<?php

/*
 * 
 * DEVELOPER: USE THIS DIRECT URL TO ADD THE FACEBOOK TAB APP TO YOUR FACEBOOK PROFILE
 * https://www.facebook.com/dialog/pagetab?app_id=YOUR_APP_ID&display=popup&next=CANVAS_PAGE
 * 
 * */

/* Facebook general settings */
$config['fb_config'] = array(
		'appId' => '',
		'secret' =>  '',
		'cookie' => true
		);

$config['fb_application_namespace'] = '';

$config['use_fangate']	= true; // enable or disable the "like-button" process
$config['develop_inside_fb'] = true; // enable or disable the facebook dipencencies (to run the app also outside fb)

		
/* 
 * Facebook wall post settings 
 * 
 */
$config['fb_application_auth_redirect'] = '';
$config['fb_application_tab_url'] = '';
$config['fb_application_picture'] = '';
$config['fb_application_message'] = '';
$config['fb_application_caption'] = '';

/* Facebook action post settings */
$config['fb_application_opengraph_page'] = ''; 
$config['fb_application_opengraph_object'] = '';
$config['fb_application_opengraph_action'] = '';

/* Facebook invite friends settings */
$config['fb_application_invite_friends_message'] = 'hat dich eingeladen zum Spiel ';
$config['fb_application_invited_friends_message'] = 'Thanks for sharing!';

/* Error messages */
$config['fb_signed_request_error_message'] = 'Could not authenticate the signed request';
$config['fb_api_connection_error_message'] = 'Could not connect to the Facebook API';

/* Application general error messages */
$config['db_connection_error_message'] = 'Could not connect to the database';
$config['page_not_found_error_message'] = 'The page does not exist';

/* Application condition terms text */

$config['application_condition_message'] = '';