<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['embedded-fields-for-card-payments'] = 'Awx_Controller/embedded_fields';
$route['embedded-fields-checkout']['post'] = 'Awx_Controller/do_checkout_embedded_fields';

$route['direct-api-for-card-payments'] = 'Awx_Controller/direct_api';
$route['direct-api-checkout']['post'] = 'Awx_Controller/do_checkout_direct_api';


$route['success']['get']   = 'Awx_Controller/success';
$route['failure']['get']   = 'Awx_Controller/failure';

$route['default_controller'] = 'Awx_Controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
