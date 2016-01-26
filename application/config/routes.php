<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// DEFAULT ROUTES
$route['default_controller'] = "dispatcher";

// DB MIGRATION TOOL
$route['migrate'] = "migrate/index";
$route['migrate/(:any)'] = "migrate/index/$1";

// ADMIN ROUTES
$route['auth/(:any)'] = 'admin/auth/$1'; // admin auth
$route['auth'] = 'admin/auth/login'; // admin auth
$route['admin/menu/item/(:any)'] = 'admin_controller/menu/item/$1'; // specific for the menu item section
$route['admin/profile/edit'] = "admin_controller/profile_edit";
$route['admin/(:any)'] = 'admin_controller/$1'; // admin generic sections
$route['admin'] = 'admin_controller'; // admin generic sections

// FRONTEND PAGES
$route['page'] = "page/index";
$route['page/(:num)'] = "page/index/$1";

$route['product/(:num)'] = "content_type/index/$1/product";

// CONTACT FORM
$route['sendemail/contact'] = 'sendemail/contact';

$route['gsearch'] = 'search/gsearch';

$route['sitemap\.xml'] = 'sitemap/index';

$route['image/preview/(:num)/(:num)/(:any)/(:any)'] = 'image/preview/$1/$2/$3/$4';

$route['theme/(:any)'] = 'theme/index/$1';

/*
* FRONTEND SLUGS
* IMPORTANT: don't move this item from this position! must be the last!
*/
$route['([a-z0-9-]*)/([a-z0-9-]*)'] = "dispatcher/index/$1/$2";
$route['([a-z0-9-]*)'] = "dispatcher/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */