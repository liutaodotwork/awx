<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Googlepay_Controller extends Awx_Controller
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
     * Checkout Page.
     */
    public function index()
    {
        $token = $this->get_api_token( $this->client_id, $this->api_key );

        if ( FALSE === $token )
        {
            show_404();
        }

        // Create a Payment Intent
        $order_hkd = [
            'request_id'        => random_string(),
            'amount'            => 100,
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'customer' => [
                'first_name' => 'Steve',
                'last_name' => 'Gates',
                'email' => 'steve.gates@mail.com',
                'merchant_customer_id' => random_string(),
            ],
            'order' => [
                'products' => [
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'Product 1',
                    'quantity' => 1,
                    'unit_price' => 90,
                    'type' => 'physical'
                    ],
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'Shipping',
                    'desc' => 'Ship to Hong Kong ',
                    'quantity' => 1,
                    'unit_price' => 10,
                    'type' => 'shipping'
                    ],
                ],
                'shipping' => [
                    'address' => [
                        'country_code' => "HK",
                        'state' => "Hong Kong Island",
                        'city' => "Hong Kong",
                        'street' => "Street No. 4",
                        'postcode' => ""
                    ]
                ]
            ],
            'payment_method_options' => [
                'card' => [
                    'three_ds_action' => 'FORCE_3DS'
                ]
            ],
            'return_url' => site_url( '' )
        ];

        $intent = $this->get_secret( $token, $order_hkd );

        $this->vars[ 'intent' ] = $intent;


        $this->load->view( 'googlepay/googlepay', $this->vars );
    }

}
