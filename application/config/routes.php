<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// DEFAULT ROUTES
$route['default_controller'] = "index";
$route['404_override'] = '';

// DB MIGRATION TOOL
$route['migrate'] = "migrate/index";

// ADMIN ROUTES

$route['admin/menu/item/(:any)'] = 'admin/menu/item/$1'; // specific for the menu item section
$route['admin/(:any)'] = 'admin/index/$1'; // admin generic sections
$route['admin'] = 'admin/index'; // admin dashboard

// FRONTEND PAGES
$route['page'] = "page/index";
$route['page/(:any)'] = "page/index/$1";

/*
 * FRONTEND SLUGS
 * IMPORTANT: don't move this item from this position! must be the last!
 */
$route['([a-z0-9-]*)'] = "dispatcher/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */