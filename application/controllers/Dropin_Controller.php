<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Dropin_Controller extends Awx_Controller
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
        $order = [
            'request_id'        => random_string(),
            'amount'            => 100,
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'customer_id'       => 'cus_hkdm2sswsh02hmsh3fj',
            // 'customer' => [
            //     'first_name' => 'Steve',
            //     'last_name' => 'Gates',
            //     'email' => 'steve.gates@mail.com',
            //     'merchant_customer_id' => random_string(),
            // ],
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

            'return_url' => site_url( 'payments/drop-in' )
        ];

        $intent = $this->get_secret( $token, $order );

        $this->vars[ 'intent' ] = $intent;

        $this->load->view( 'dropin/index', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Checkout Page.
     */
    public function hpp()
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

        $intent_hkd = $this->get_secret( $token, $order_hkd );

        $this->vars[ 'intent_hkd' ] = $intent_hkd;


        $order_twd = [
            'request_id'        => random_string(),
            'amount'            => 100,
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'customer' => [
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
                    'desc' => 'Ship to Taiwan',
                    'quantity' => 1,
                    'unit_price' => 10,
                    'type' => 'shipping'
                    ],
                ],
                'shipping' => [
                    'first_name' => 'Steve',
                    'last_name' => 'Gates',
                    'address' => [
                        'country_code' => "TW",
                        'state' => "台北市",
                        'city' => "Taipei",
                        'street' => "Street No. 10",
                        'postcode' => "103247"
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

        $intent_twd = $this->get_secret( $token, $order_twd );

        $this->vars[ 'intent_twd' ] = $intent_twd;

        $this->load->view( 'hpp', $this->vars );
    }

}
