<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Hpp_Controller extends Awx_Controller
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
                    'desc' => 'Ship to Taiwan',
                    'quantity' => 1,
                    'unit_price' => 10,
                    'type' => 'shipping'
                    ],
                ],
                'shipping' => [
                    'address' => [
                        'country_code' => "TW",
                        'state' => "Taipei City",
                        'city' => "Taipei",
                        'street' => "Street No. 10",
                        'postcode' => "103247"
                    ]
                ]
            ],
            'return_url' => site_url( '' )
        ];

        $intent_twd = $this->get_secret( $token, $order_twd );

        $this->vars[ 'intent_twd' ] = $intent_twd;

        $this->load->view( 'hpp', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Do checkout.
     */
    public function do_checkout_embedded_fields()
    {
        if ( ! $this->input->is_ajax_request() )
        {
            show_error(404);
        }

        $rules = [
            [
                'field' => 'client-id',
                'label' => 'Client ID',
                'rules' => 'trim|required|max_length[225]'
            ],
            [
                'field' => 'api-key',
                'label' => 'API Key',
                'rules' => 'trim|required|max_length[225]'
            ]
        ];
        $config = [
            'error_prefix' => '',
            'error_suffix' => '',
        ];
        $this->load->library( 'form_validation', $config );
        $this->form_validation->set_rules( $rules );

        if ( $this->form_validation->run() === FALSE )
        {
            $error_msg = [
                'client_id'   => form_error( 'client-id' ),
                'api_key'     => form_error( 'api-key' )
            ];
            $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
            return FALSE;
        }

        $client_id = $this->input->post( 'client-id', TRUE );
        $api_key = $this->input->post( 'api-key', TRUE );

        $token = $this->get_api_token( $client_id, $api_key );

        if ( FALSE === $token )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'token' => 'Invalid Client ID or API Key'
            ] ] );
            return FALSE;
        }

        $order = [
            'request_id'        => random_string(),
            'amount'            => '80.05',
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'order' => [
                'products' => [
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'iPhone XR',
                    'desc' => '64 GB White',
                    'quantity' => 1,
                    'unit_price' => 850,
                    'type' => 'physical'
                    ],
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'Shipping',
                    'desc' => 'Ship to the US',
                    'quantity' => 1,
                    'unit_price' => 10,
                    'type' => 'shipping'
                    ],
                ],
                'shipping' => [
                    'first_name' => 'Steve',
                    'last_name'  => 'Gates',
                    'phone_number' => '+187631283',
                    'shipping_method' => 'DEFINED by YOUR WEBSITE',
                    'address' => [
                        'country_code' => "US",
                        'state' => "AK",
                        'city' => "Akhiok",
                        'street' => "Street No. 4",
                        'postcode' => "99654"
                    ]
                ]
            ]
        ];

        if ( TRUE )
        {
            $customer = $this->create_customer( $token, [
                'request_id' => random_string(),
                'merchant_customer_id' => random_string(),
                'first_name' => 'Steve',
                'last_name' => 'Gates',
            ] );

            $order[ 'customer_id' ] = $customer[ 'id' ];
        }

        $intent = $this->get_secret( $token, $order );
    
        $this->json_response( [ 'result' => 1, 'intent' => $intent, 'customer' => $customer  ] );
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Checkout Page.
     */
    public function direct_api()
    {
        $this->vars[ 'client_id' ]  = $this->input->get( 'c', TRUE );
        $this->vars[ 'api_key' ]    = $this->input->get( 'k', TRUE );

        $this->load->view( 'direct_api_checkout', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Success Result.
     */
    public function success()
    {
        $client_id = $this->input->get( 'c', TRUE );
        $api_key = $this->input->get( 'k', TRUE );
        $intent_id = $this->input->get( 'id', TRUE );
        if ( empty( $intent_id ) OR  empty( $client_id ) OR empty( $api_key )  )
        {
            show_404();
        }

        $token = $this->get_api_token( $client_id, $api_key );

        if ( FALSE === $token )
        {
            show_404();
        }

        $intent = $this->get_payment_intent( $token, $intent_id );

        if ( FALSE === $intent )
        {
            show_404();
        }

        $this->vars[ 'intent' ] = $intent;
        $this->vars[ 'back_url' ] = '/embedded-fields-for-card-payments?c=' . $client_id . '&k=' . $api_key;

        $this->load->view( 'success', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Failure Result.
     */
    public function failure()
    {
        $this->load->view( 'failure', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * 3DS Result.
     */
    public function three_ds_result( $res = 1 )
    {
        $res =  ! in_array( $res, [ 1, 0 ] ) ? 1 : $res;

        $result_uri = ( $res == 1 ) ? 'success' : 'failure';

        $cko_session_id = $this->input->get( 'cko-session-id', TRUE );
        if ( ! empty( $cko_session_id ) )
        {
            $result_uri .= '?cko-session-id=' . $cko_session_id;
        }

        $this->vars[ 'result_page' ] = site_url( $result_uri );

        $this->load->view( 'three_ds_result', $this->vars );
    }
}
