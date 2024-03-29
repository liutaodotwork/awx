<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['testing']['get']   = 'Test_Controller/index';
$route['test-webhook']['get']   = 'Test_Controller/test_webhook';

// Native API
$route['payments/cards/native-api']                             = 'Native_Api_Controller/native_api';
$route['payments/cards/native-api-checkout']['post']            = 'Native_Api_Controller/do_checkout_native_api';
$route['payments/cards/native-api-callback']['post']            = 'Native_Api_Controller/three_ds_callback';
$route['payments/cards/native-api-3ds-result/(:num)']['get']    = 'Native_Api_Controller/three_ds_result/$1';

// Hosted Payment Page
$route['payments/hpp'] = 'Hpp_Controller/hpp';



// APM Native API Payment Page
$route['payments/apms/alipay']['get']              = 'Apm_Native_Api_Controller/alipay';
$route['payments/apms/alipay-auth']['post']    = 'Apm_Native_Api_Controller/alipay_auth';
$route['payments/apms/pay-with-alipay']    = 'Apm_Native_Api_Controller/pay_with_alipay';


$route['demo']['get']   = 'Embedded_Fields_Controller/demo';
$route['embedded-fields-for-card-payments'] = 'Embedded_Fields_Controller/embedded_fields';
$route['embedded-fields-checkout']['post'] = 'Embedded_Fields_Controller/do_checkout_embedded_fields';

// Save cards
$route['embedded-fields-for-saving-cards'] = 'Embedded_Fields_Controller/embedded_fields_save_cards';
$route['embedded-fields-save-cards']['post'] = 'Embedded_Fields_Controller/do_save_cards_embedded_fields';

// MIT
$route['embedded-fields-charge-fees']['post'] = 'Embedded_Fields_Controller/do_charge_fees';




$route['nc-native-api-for-card-payments'] = 'Nc_native_Api_Controller/native_api';
$route['nc-native-api-checkout']['post'] = 'Nc_native_Api_Controller/do_checkout_native_api';
$route['nc-native-api-callback/(:any)']['post'] = 'Nc_native_Api_Controller/three_ds_callback/$1';
$route['nc-native-api-3ds-result/(:num)']['get'] = 'Nc_native_Api_Controller/three_ds_result/$1';


$route['payout']['get'] = 'Payout_Controller/index';
$route['fx']['get'] = 'Fx_Controller/index';

$route['success']['get']   = 'Awx_Controller/success';
$route['failure']['get']   = 'Awx_Controller/failure';


// Stripe Payments
$route['s-payment'] = 'Stripe_Controller/embedded_fields';
$route['s-checkout']['post'] = 'Stripe_Controller/do_checkout';
$route['s-success']['get']   = 'Stripe_Controller/success';
$route['s-failure']['get']   = 'Stripe_Controller/failure';


$route['default_controller'] = 'Awx_Controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
