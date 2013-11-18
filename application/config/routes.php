<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// DEFAULT ROUTES
$route['default_controller'] = "index";
$route['404_override'] = '';

// DB MIGRATION TOOL
$route['migrate'] = "migrate/index";
$route['migrate/(:any)'] = "migrate/index/$1";

// ADMIN ROUTES
$route['auth/(:any)'] = 'admin/auth/$1'; // admin auth
$route['auth'] = 'admin/auth/login'; // admin auth
$route['admin/menu/item/(:any)'] = 'admin/menu/item/$1'; // specific for the menu item section
$route['admin/(:any)'] = 'admin/index/$1'; // admin generic sections
$route['admin'] = 'admin/index'; // admin dashboard

// FRONTEND PAGES
$route['page'] = "page/index";
$route['page/(:num)'] = "page/index/$1";

$route['product/(:num)'] = "content_type/index/$1/product";

/*
 * FRONTEND SLUGS
 * IMPORTANT: don't move this item from this position! must be the last!
 */
$route['([a-z0-9-]*)'] = "dispatcher/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */