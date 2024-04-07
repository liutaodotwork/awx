<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Embedded_Elements_Controller extends Awx_Controller
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
     * Google Pay Checkout Page.
     */
    public function googlepay()
    {
        $token = $this->get_api_token( $this->client_id, $this->api_key );

        // Create a Payment Intent with the customer id
        $order = [
            'request_id'        => random_string(),
            'amount'            => 245.00,
            'currency'          => 'CNY',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'order' => [
                'products' => [
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'Premium Membership - 1 Year',
                    'desc' => ' Yearly Premium Membership subscription',
                    'quantity' => 1,
                    'unit_price' => 245,
                    'type' => 'virtual'
                    ],
                ],
            ],
            'return_url' => ''
        ];

        $this->vars[ 'intent' ] = $this->get_secret( $token, $order );


        $this->load->view( 'apms/googlepay', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Save cards Page.
     */
    public function embedded_fields_save_cards()
    {
        $this->vars[ 'client_id' ]      = $this->input->get( 'c', TRUE );
        $this->vars[ 'api_key' ]        = $this->input->get( 'k', TRUE );
        $this->vars[ 'customer_id' ]    = $this->input->get( 'cu', TRUE );


        $this->load->view( 'embedded_fields_save_cards', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Do checkout.
     */
    public function do_save_cards_embedded_fields()
    {
        // 1. Back-end validation
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
            ],
            [
                'field' => 'customer-id',
                'label' => 'Customer ID',
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
                'api_key'     => form_error( 'api-key' ),
                'customer_id' => form_error( 'customer-id' )
            ];
            $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
            return FALSE;
        }


        // 2. Get an access token
        $client_id  = $this->input->post( 'client-id', TRUE );
        $api_key    = $this->input->post( 'api-key', TRUE );

        $token      = $this->get_api_token( $client_id, $api_key );

        if ( FALSE === $token )
        {
            $this->json_response( [ 'result' => 0, 'msg' => [
                'token' => 'Invalid Client ID or API Key'
            ] ] );
            return FALSE;
        }


        // 3. Fetch current Customer
        $customer_id = $this->input->post( 'customer-id', TRUE );

        if ( ! empty( $customer_id ) )
        {
            $customer = $this->get_customer( $token, $customer_id );

            if ( empty( $customer ) )
            {
                $error_msg = [
                    'client_id'   => 'Invalid client Id',
                ];
                $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
                return FALSE;
            }

            $client_secret = $this->generate_customer_client_secret( $token, $customer_id );

            if ( empty( $client_secret ) )
            {
                $error_msg = [
                    'client_id'   => 'Invalid client Id',
                ];
                $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
                return FALSE;
            }

            $customer[ 'client_secret' ] = $client_secret[ 'client_secret' ]; 

            $this->json_response( [ 'result' => 1, 'customer' => $customer  ] );
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Do charge fees.
     */
    public function do_charge_fees()
    {
        // 1. Get an access token
        $client_id  = $this->input->post( 'client-id', TRUE );
        $api_key    = $this->input->post( 'api-key', TRUE );

        $token      = $this->get_api_token( $client_id, $api_key );

        $customer_id    = $this->input->post( 'customer-id', TRUE );
        $consent_id     = $this->input->post( 'consent-id', TRUE );

        $intent = [
            'request_id'        => random_string(),
            'amount'            => '29',
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
            'customer_id'       => $customer_id,
            'order' => [
                'products' => [
                    [
                    'code' => random_string(),
                    'sku'  => random_string(),
                    'name' => 'xx Platform Subscription Fee',
                    'desc' => 'A virtual product',
                    'quantity' => 1,
                    'unit_price' => 29,
                    'type' => 'virtual_goods'
                    ],
                ],
                'type' => 'virtual_goods'
            ]
        ];

        $consent = [
            'request_id'        => random_string(),
            'customer_id'       => $customer_id,
            'payment_consent_reference' => [
                'id' => $consent_id
            ],
        ];

        $res = $this->charge_fees( $token, $intent, $consent );

        $this->json_response( [ 'result' => $res  ] );

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Checkout Page.
     */
    public function embedded_fields()
    {
        $this->vars[ 'client_id' ]      = $this->input->get( 'c', TRUE );
        $this->vars[ 'api_key' ]        = $this->input->get( 'k', TRUE );
        $this->vars[ 'customer_id' ]    = $this->input->get( 'cu', TRUE );


        $this->load->view( 'embedded_fields_checkout', $this->vars );
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
            'amount'            => '18',
            'currency'          => 'USD',
            'merchant_order_id' => random_string( 'alnum', 32 ),
        ];


        $intent = $this->get_secret( $token, $order );
    
        $this->json_response( [ 'result' => 1, 'intent' => $intent  ] );

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


    // --------------------------------------------------------------------
    //
    public function demo()
    {
        $this->load->view( 'demo', $this->vars );
    }

}
