<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['migration_enabled'] = true;
$config['migration_version'] = 105;
$config['migration_path'] = APPPATH . 'migrations/';
$CI = &get_instance();
$CI->load->config('migration_fork');
$config['admin_email'] = 'tech@code-b.com';
