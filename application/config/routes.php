<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Default routes
$route['default_controller'] = "index";
$route['404_override'] = '';

// Pages
$route['page'] = "page/index";
$route['page/(:any)'] = "page/index/$1";

// Migration
$route['migrate'] = "migrate/index";

// Admin
$route['admin'] = 'admin/index';
$route['admin/menu/item/(:any)'] = 'admin/menu/item/$1';
$route['admin/(:any)'] = 'admin/index/$1';

// Slugs
// Don't move this item from this position! must be the last!
$route['([a-z0-9-]*)'] = "dispatcher/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */