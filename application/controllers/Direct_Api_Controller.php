<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Direct_Api_Controller extends Awx_Controller
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
    public function direct_api()
    {
        $this->vars[ 'client_id' ]  = $this->input->get( 'c', TRUE );
        $this->vars[ 'api_key' ]    = $this->input->get( 'k', TRUE );

        $this->load->view( 'direct_api_checkout', $this->vars );
    }


    // --------------------------------------------------------------------

    /**
     * Do checkout.
     */
    public function do_checkout_direct_api()
    {
        if ( ! $this->input->is_ajax_request() )
        {
            show_error(404);
        }

        // 1 - Validation
        $rules = [
            [
                'field' => 'number',
                'label' => 'Card Number',
                'rules' => 'trim|required|max_length[30]'
            ],
            [
                'field' => 'name',
                'label' => 'Name on Card',
                'rules' => 'trim|required|max_length[30]'
            ],
            [
                'field' => 'expiry',
                'label' => 'Expiry',
                'rules' => 'trim|required|max_length[10]'
            ],
            [
                'field' => 'cvc',
                'label' => 'CVC',
                'rules' => 'trim|required|max_length[5]'
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
                'number'   => form_error( 'number' ),
                'name'     => form_error( 'name' ),
                'expiry'   => form_error( 'expiry' ),
                'cvc'      => form_error( 'cvc' )
            ];
            $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
            return FALSE;
        }

        // 2 - Fetch an AWX Token
        $client_id  = $this->input->get( 'c', TRUE );
        $api_key    = $this->input->get( 'k', TRUE );

        $token = $this->get_api_token( $client_id, $api_key );

        if ( FALSE === $token )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'token' => 'Invalid Client ID or API Key'
            ] ] );
            return FALSE;
        }

        // 3 - Create a Payment Intent
        $order = [
            'request_id'        => random_string(),
            'amount'            => '80.05',
            'currency'          => 'USD',
            'merchant_order_id' => random_string(),
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
            ],
            'return_url' => 'http://dev.awx/direct-api-callback'
        ];

        $intent = $this->get_secret( $token, $order );

        if ( empty( $intent ) )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'token' => 'Invalid Client ID or API Key'
            ] ] );
            return FALSE;
        }

        // 4 - Confirm the Payment Intent
        $number     = preg_replace( '/\s+/', '', $this->input->post( 'number', TRUE ) );
        $expiry     = explode( ' / ', $this->input->post( 'expiry', TRUE ) );

        $expiry_month   = $expiry[ 0 ];
        $expiry_year    = $expiry[ 1 ];

        $cvc = $this->input->post( 'cvc', TRUE );
        $name = $this->input->post( 'name', TRUE );

        $payment_detail = [
            'request_id'        => random_string(),
            'payment_method' => [
                'type' => 'card',
                'card' => [
                    'number'        => $number,
                    'expiry_month'  => $expiry_month,
                    'expiry_year'   => '20' . $expiry_year,
                    'cvc'           => $cvc,
                    'name'          => $name
                ],
            ],
            'payment_method_options' => [
                'card' => [
                    'auto_capture' => true
                ]
            ]
        ];

        $confirm_result = $this->confirm_intent( $token, $intent[ 'id' ], $payment_detail );

        if ( empty( $confirm_result ) )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'token' => 'Invalid Client ID or API Key'
            ] ] );
            return FALSE;
        }

        $this->json_response( [ 'result' => 1, 'intent' => $confirm_result ] );

        return TRUE;
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
