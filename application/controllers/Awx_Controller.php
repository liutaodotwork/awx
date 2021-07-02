<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Awx_Controller extends CI_Controller
{
    /**
     * Constructor
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library( [
            'user_agent'
        ] );

        $this->load->helper( [
            'url',
            'string'
        ] );

        $this->vars[ 'asset_path' ] = ( ENVIRONMENT == 'production' ) ? '/assets' : '/assets';
        $this->vars[ 'is_mobile' ] = $this->agent->is_mobile();
        $this->awx_domain = 'https://pci-api-demo.airwallex.com';
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
    public function checkout()
    {
        $this->vars[ 'client_id' ]  = $this->input->get( 'c', TRUE );
        $this->vars[ 'api_key' ]    = $this->input->get( 'k', TRUE );

        $this->load->view( 'checkout', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Do checkout.
     */
    public function do_checkout()
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
            'amount'            => '860',
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
            ]
        ];

        $intent = $this->get_secret( $token, $order );
    
        $this->json_response( [ 'result' => 1, 'intent' => $intent ] );
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

    // --------------------------------------------------------------------

    /**
     * Get API Access token.
     */
    private function get_api_token( $client_id = '', $api_key = '' )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
             $response = $client->request( 'POST', $this->awx_domain . '/api/v1/authentication/login', [
                'headers' => [
                    'x-api-key'     => $api_key,
                    'x-client-id'   => $client_id
                ]
            ] );

            if ( '201' != $response->getStatusCode() )
            {
                return FALSE;
            }

            $token = json_decode( $response->getBody(), TRUE );
            return $token[ 'token' ];
        } 
        catch (\Throwable $th)
        {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get intent id and client secret.
     */
    private function get_secret( $token = '', $body = [] )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/payment_intents/create', [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode( $body ) 
            ] );

            if ( '201' != $response->getStatusCode() )
            {
                return FALSE;
            }

            return json_decode( $response->getBody(), TRUE );
        } 
        catch (\Throwable $th)
        {
            return FALSE;
        }
    }


    // --------------------------------------------------------------------

    /**
     * Get intent.
     */
    private function get_payment_intent( $token = '', $intent_id = '' )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'GET', $this->awx_domain . '/api/v1/pa/payment_intents/' . $intent_id, [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ]
            ] );

            if ( '200' != $response->getStatusCode() )
            {
                return FALSE;
            }

            return json_decode( $response->getBody(), TRUE );
        } 
        catch (\Throwable $th)
        {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Json response
     *
     * @access protected
     */
    protected function json_response( $json_arr = [], $is_html = FALSE )
    {
        if ( ENVIRONMENT !== 'testing' AND $is_html === FALSE )
        {
            header('Content-Type: application/json; charset=UTF-8');
            header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
            header("Pragma: no-cache"); // HTTP 1.0.
            header("Expires: 0"); // Proxies.
        }

        echo json_encode( $json_arr );
    }

}
