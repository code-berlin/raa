<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['migration_enabled'] = TRUE;
$config['migration_version'] = 91;
$config['migration_path'] = APPPATH . 'migrations/';
$CI =& get_instance();
$CI->load->config('migration_fork');
$config['admin_email'] = 'tech@code-b.com';
