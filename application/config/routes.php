<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['testing']['get']   = 'Test_Controller/index';


$route['embedded-fields-for-card-payments'] = 'Embedded_Fields_Controller/embedded_fields';
$route['embedded-fields-checkout']['post'] = 'Embedded_Fields_Controller/do_checkout_embedded_fields';

$route['direct-api-for-card-payments'] = 'Direct_Api_Controller/direct_api';
$route['direct-api-checkout']['post'] = 'Direct_Api_Controller/do_checkout_direct_api';
$route['direct-api-3ds-device']['get'] = 'Direct_Api_Controller/three_ds_device';
$route['direct-api-callback/(:any)']['post'] = 'Direct_Api_Controller/three_ds_callback/$1';
$route['direct-api-3ds-result/(:num)']['get'] = 'Direct_Api_Controller/three_ds_result/$1';

$route['nc-direct-api-for-card-payments'] = 'Nc_Direct_Api_Controller/direct_api';
$route['nc-direct-api-checkout']['post'] = 'Nc_Direct_Api_Controller/do_checkout_direct_api';
$route['nc-direct-api-3ds-device']['get'] = 'Nc_Direct_Api_Controller/three_ds_device';
$route['nc-direct-api-callback/(:any)']['post'] = 'Nc_Direct_Api_Controller/three_ds_callback/$1';
$route['nc-direct-api-3ds-result/(:num)']['get'] = 'Nc_Direct_Api_Controller/three_ds_result/$1';

$route['payout']['get'] = 'Payout_Controller/index';

$route['success']['get']   = 'Awx_Controller/success';
$route['failure']['get']   = 'Awx_Controller/failure';


// Stripe Payments
$route['s-payment'] = 'Stripe_Controller/embedded_fields';
$route['s-checkout']['post'] = 'Stripe_Controller/do_checkout';


$route['default_controller'] = 'Awx_Controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
