<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Apm_Native_Api_Controller extends Awx_Controller
{
    /**
     * Constructor
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Alipay Checkout Page.
     */
    public function alipay()
    {
        $this->vars[ 'consent_id' ]     = $this->input->get( 'consent', TRUE );
        $this->vars[ 'customer_id' ]    = $this->input->get( 'customer', TRUE );

        $this->load->view( 'apms/alipay', $this->vars );
    }
// --------------------------------------------------------------------
    /**
     * Alipay Checkout Page.
     */
    public function alipay_pay()
    {
        $token = $this->get_api_token( $this->client_id, $this->api_key );

        $f = $this->input->get( 'flow', TRUE );

        // Create a Payment Intent
        $order = [
            'request_id'        => random_string(),
            'amount'            => 190.00,
            'currency'          => 'HKD',
            'customer'          => [
                'additional_info' => [
                    'registration_date' => '2022-04-05',
                ],
                'merchant_customer_id' => random_string( 'alnum', 8 ),
            ],
            'return_url'        => '', 
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'order' => [
                'products' => [
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'Premium Coin',
                    'desc' => '',
                    'quantity' => 1000,
                    'unit_price' => 0.19,
                    'type' => 'virtual'
                    ],
                ],
            ],
        ];

        $intent = $this->get_secret( $token, $order );


        $flow       = 'mobile_web';
        $os_type    = 'ios'; // ios or android

        if ( $f === 'pc' )
        {
            $flow = 'qrcode';
        }

        // Confirm this intent with consent id
        $res = $this->confirm_intent( $token, $intent[ 'id' ], [
            'request_id'        => random_string(),
            'payment_method'    => [
                'type' => 'alipaycn',
                'alipaycn' => [ 'flow' => $flow, 'os_type' => $os_type ]
            ],
        ] );

        $resp = [ 'result' => 1, ];

        if ( $f == 'pc' )
        {
            $resp[ 'qrcode' ] = $res[ 'next_action' ][ 'qrcode' ];
        }
        else
        {
            $resp[ 'url' ] = $res[ 'next_action' ][ 'url' ];
        }

        $this->json_response( $resp );

        return TRUE;

    }

    // --------------------------------------------------------------------

    /**
     * AlipayHK Checkout Page.
     */
    public function alipayhk()
    {
        $this->load->view( 'apms/alipayhk', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * AlipayHK Auth.
     */
    public function alipayhk_auth()
    {
        $token = $this->get_api_token( $this->client_id, $this->api_key );

        // Reuse an existing customer
        // $customer = $this->get_customer( $token, 123 );

        // or create a new customer
        $customer_detail = [
            'request_id'        => random_string(),
            'merchant_customer_id' => random_string(),
            'first_name' => 'Steve',
            'last_name' => 'Gates',
            'email' => 'steve.gates@example.com',
            'phone_number' => '',
            'address' => [
                'country_code' => 'CN'
            ],
            'additional_info' => [
                'registered_via_social_media' => TRUE
            ]

        ];

        $customer = $this->create_customer( $token, $customer_detail );

        // Create a payment consent
        $consent_detail = [
            'request_id'        => random_string(),
            'customer_id' => $customer[ 'id' ],
            'next_triggered_by' => 'merchant',
            'merchant_trigger_reason' => 'scheduled'
        ];
        $consent = $this->create_consent( $token, $consent_detail );

        // Verify a consent
        $payment_method = [
            'request_id'        => random_string(),
            'return_url'        => site_url( 'payments/apms/pay-with-alipay?consent=' . $consent[ 'id' ] . '&customer=' . $customer[ 'id' ] ),
            'payment_method'    => [
                'type' => 'alipayhk', //alipaycn
                'alipayhk' => [ // should be the same as the type 
                    'flow' => 'qrcode', // one of qrcode, mobile_web, mobile_app
                    'os_type' => 'ios' // One of ios, android. os_type must be set when flow is mobile_web, mobile_app.
                ]
            ],
        ];

        $res = $this->verify_consent( $token, $consent[ 'id' ], $payment_method );

        $this->json_response( [ 'result' => 1, 'msg' => $res[ 'next_action' ][ 'url' ] ] );

        return TRUE;
    }

}
