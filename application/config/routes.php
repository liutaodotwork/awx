<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['embedded-fields-for-card-payments'] = 'Embedded_Fields_Controller/embedded_fields';
$route['embedded-fields-checkout']['post'] = 'Embedded_Fields_Controller/do_checkout_embedded_fields';

$route['direct-api-for-card-payments'] = 'Direct_Api_Controller/direct_api';
$route['direct-api-checkout']['post'] = 'Direct_Api_Controller/do_checkout_direct_api';
$route['direct-api-3ds-device']['get'] = 'Direct_Api_Controller/three_ds_device';

$route['success']['get']   = 'Awx_Controller/success';
$route['failure']['get']   = 'Awx_Controller/failure';

$route['default_controller'] = 'Awx_Controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
