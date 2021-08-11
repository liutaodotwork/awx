<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Awx_Controller extends CI_Controller
{
    /**
     * Variables for front pages
     *
     * @access public
     */
    protected $vars = [];

    // --------------------------------------------------------------------

    /**
     * AWX Doamin
     *
     * @access public
     */
    protected $awx_domain = 'https://pci-api-demo.airwallex.com';

    // --------------------------------------------------------------------

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

        $this->vars[ 'asset_path' ] = ( ENVIRONMENT == 'production' ) ? '/dist' : '/dist';
        $this->vars[ 'is_mobile' ] = $this->agent->is_mobile();
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
     * Get API Access token.
     */
    protected function get_api_token( $client_id = '', $api_key = '' )
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
    protected function get_secret( $token = '', $body = [] )
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
     * Confirm a payment intent.
     */
    protected function confirm_intent( $token = '', $intent_id = '', $body = [] )
    {
        $client = new \GuzzleHttp\Client();

        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/payment_intents/' . $intent_id . '/confirm', [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'body' => json_encode( $body ) 
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
     * Get intent.
     */
    protected function get_payment_intent( $token = '', $intent_id = '' )
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
     * Get customer.
     */
    protected function get_customer( $token = '', $customer_id = '' )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'GET', $this->awx_domain . '/api/v1/pa/customers/' . $customer_id, [
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
