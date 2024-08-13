<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Card_Embedded_Elements_Controller extends Awx_Controller
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
        // Checkout flow
        $flow = $this->input->get( 'flow', TRUE );

        if ( ! in_array( $flow, [ '1', '2', '3', '4', '5' ] ) )
        {
            $flow = '1';
        }

        $this->vars[ 'flow' ] = $flow;


        $this->load->view( 'embedded_fields_checkout', $this->vars );
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
     * Do checkout.
     */
    public function do_checkout_embedded_fields()
    {
        if ( ! $this->input->is_ajax_request() )
        {
            show_error(404);
        }

        $client_id  = $this->client_id;
        $api_key    = $this->api_key;

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
        ];


        $intent = $this->get_secret( $token, $order );
    
        $this->json_response( [ 'result' => 1, 'intent' => $intent  ] );

        return TRUE;
    }

}
