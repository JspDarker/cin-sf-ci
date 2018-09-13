<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'backend/account/login';

//$route['admin/login'] = 'backend/authenticate/login';
$route['authenticated'] = 'backend/admin_home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
