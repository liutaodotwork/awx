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
                'label' => 'Full Name',
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
            ],
            'return_url' => site_url( 'direct-api-callback' )
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

        // 1. billing address
        // 2. update the notification return url
        $payment_detail = [
            'request_id'        => random_string(),
            'payment_method' => [
                'type' => 'card',
                'card' => [
                    'number'        => $number,
                    'expiry_month'  => $expiry_month,
                    'expiry_year'   => '20' . $expiry_year,
                    'cvc'           => $cvc,
                    'name'          => $name,
                    'billing'       => [
                        'first_name'    => 'Steve',
                        'last_name'     => 'Gates',
                        'phone_number'  => '+187631283',
                        'address'   => [
                            'country_code' => "US",
                            'state' => "AK",
                            'city' => "Akhiok",
                            'street' => "Street No. 4",
                            'postcode' => "99654"
                        ]

                    ]
                ],
            ],
            'payment_method_options' => [
                'card' => [
                    'auto_capture'  => true,
                    'three_ds'      => [
                        'return_url' => site_url( 'direct-api-callback/' . $intent[ 'id' ] ) . '?c=' . $client_id . '&k=' . $api_key
                    ]
                ]
            ]
        ];

        $confirm_result = $this->confirm_intent( $token, $intent[ 'id' ], $payment_detail );

        if ( empty( $confirm_result ) OR ! isset( $confirm_result[ 'status' ] ) )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'id'        => $intent[ 'id' ],
                'code'      => isset( $confirm_result[ 'provider_original_response_code' ] ) ?  $confirm_result[ 'provider_original_response_code' ] : 0
            ] ] );
            return FALSE;
        }

        // Optional 5 - 3DS
        if ( 'REQUIRES_CUSTOMER_ACTION' == $confirm_result[ 'status' ] )
        {
            $this->json_response( [ 'result' => 1, 'fingerprint' => 1, 'intent' => $confirm_result ] );
            return TRUE;
        }

        $this->json_response( [ 'result' => 1, 'intent' => $confirm_result ] );
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * 3DS Device Page.
     */
    public function three_ds_device()
    {
        $this->vars[ 'url' ] = $this->input->get( 'url', TRUE );
        $this->vars[ 'bin' ] = $this->input->get( 'bin', TRUE );
        $this->vars[ 'jwt' ] = $this->input->get( 'jwt', TRUE );

        $this->load->view( 'device_3ds', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * 3DS Callback.
     */
    public function three_ds_callback( $intent_id = '' )
    {
        $client_id  = $this->input->get( 'c', TRUE );
        $api_key    = $this->input->get( 'k', TRUE );

        $token = $this->get_api_token( $client_id, $api_key );

        if ( FALSE === $token )
        {
            return FALSE;
        }

        $tran_id = $this->input->post( 'TransactionId', TRUE );

        if ( empty( $tran_id ) )
        {
            // For stepup
            $device_data = $this->input->post( 'Response', TRUE );

            $confirm_res = $this->confirm_continue_intent( $token, $intent_id, [
                'request_id'    => random_string(),
                'type'          => '3dsCheckEnrollment',
                'three_ds'      => [
                    'device_data_collection_res' => $device_data
                ]
            ] );

            if ( FALSE === $confirm_res )
            {
                return FALSE;
            }

            $this->vars[ 'url' ] = $confirm_res[ 'next_action' ][ 'url' ];
            $this->vars[ 'jwt' ] = $confirm_res[ 'next_action' ][ 'data' ][ 'jwt' ];

            $this->load->view( 'stepup_3ds', $this->vars );

            return TRUE;
        }

        // The last comfirmation
        $res = $this->confirm_continue_intent( $token, $intent_id, [
            'request_id'    => random_string(),
            'type'          => '3dsValidate',
            'three_ds'      => [
                'ds_transaction_id' => $tran_id
            ]
        ] );

        if ( isset( $res[ 'status' ] ) AND ( 'SUCCEEDED' == $res[ 'status' ] ) )
        {
            redirect( site_url( 'direct-api-3ds-result/1' . '?id=' . $intent_id . '&c=' . $client_id . '&k=' . $api_key ) );

            return TRUE;
        }

        if ( FALSE !== $res )
        {
            redirect( site_url( 'direct-api-3ds-result/0' . '?id=' . $intent_id . '&c=' . $client_id . '&k=' . $api_key . ( isset( $res[ 'provider_original_response_code' ] ) ? '&code=' . $res[ 'provider_original_response_code' ] : '' ) ) );
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * 3DS Result.
     */
    public function three_ds_result( $res = 1 )
    {
        $res =  ! in_array( $res, [ 1, 0 ] ) ? 1 : $res;

        $result_uri = ( $res == 1 ) ? 'success' : 'failure';

        $id = $this->input->get( 'id', TRUE );
        $c = $this->input->get( 'c', TRUE );
        $k = $this->input->get( 'k', TRUE );
        $code = $this->input->get( 'code', TRUE );
        if ( ! empty( $id ) )
        {
            $result_uri .= '?id=' . $id . '&c=' . $c . '&k=' . $k . '&m=direct-api';
        }

        $this->vars[ 'result_page' ]    = site_url( $result_uri );
        $this->vars[ 'code' ]           = $code;

        $this->load->view( 'three_ds_success_redirection', $this->vars );
    }
}
