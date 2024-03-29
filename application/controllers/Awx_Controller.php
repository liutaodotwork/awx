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
        $this->vars[ 'is_mobile' ]  = $this->agent->is_mobile();
        $this->vars[ 'is_demo' ]    = ( ENVIRONMENT == 'production' ) ? FALSE : TRUE ;

        $this->awx_domain   = ( ENVIRONMENT == 'production' ) ?  'https://api.airwallex.com' : 'https://api-demo.airwallex.com';
        $this->file_domain  = ( ENVIRONMENT == 'production' ) ?  'https://files.airwallex.com' : 'https://files-demo.airwallex.com';


        // Get client id and api secret from DB
        $this->load->database();

        $this->db->select( 'name, value' );
        $this->db->from( 'en_settings' );
        $this->db->where_in( 'name', [ 'api_key', 'client_id' ] );

        $query  = $this->db->get();
        $result = $query->result_array();

        foreach ( $result as $row )
        {
            if ($row[ 'name' ] == 'api_key')
            {
                $this->api_key = $row[ 'value' ];
            }
            elseif ($row[ 'name' ] == 'client_id')
            {
                $this->client_id = $row[ 'value' ];
            }
        }

    }

    // --------------------------------------------------------------------

    /**
     * Checkout Page.
     */
    public function index()
    {
        $this->load->view( 'index', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Success Result.
     */
    public function success()
    {
        $client_id  = $this->client_id;
        $api_key    = $this->api_key;

        $intent_id  = $this->input->get( 'id', TRUE );
        $mode       = $this->input->get( 'm', TRUE );

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
        $this->vars[ 'mode' ]   = $mode;

        if ( 'nc-native-api' == $mode )
        {
            $this->vars[ 'back_url' ] = site_url( 'payments/cards/nc-native-api-for-card-payments' );
        }
        elseif ( 'native-api' == $mode )
        {
            $this->vars[ 'back_url' ] = site_url( 'payments/cards/native-api' );
        }
        else
        {
            $this->vars[ 'back_url' ] = '/embedded-fields-for-card-payments';
        }

        $this->load->view( 'success', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Failure Result.
     */
    public function failure()
    {
        $client_id  = $this->client_id;
        $api_key    = $this->api_key;

        $mode       = $this->input->get( 'm', TRUE );
        $intent_id  = $this->input->get( 'id', TRUE );
        $code = $this->input->get( 'code', TRUE );

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

        $this->vars[ 'intent' ]     = $intent;
        $this->vars[ 'code' ]       = $code;
        $this->vars[ 'mode' ]       = $mode;
        if ( 'nc-native-api' == $mode )
        {
            $this->vars[ 'back_url' ]   = '/nc-native-api-for-card-payments';
        }
        elseif ( 'native-api' == $mode )
        {
            $this->vars[ 'back_url' ] = site_url( 'payments/cards/native-api' );
        }
        else
        {
            $this->vars[ 'back_url' ] = '/embedded-fields-for-card-payments';
        }

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
        catch ( \GuzzleHttp\Exception\RequestException $e)
        {
            if ( $e->hasResponse() )
            {
                if ( $e->getResponse()->getStatusCode() == '400' )
                {
                    return json_decode( $e->getResponse()->getBody(), TRUE );
                }
            }

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
     * Get consent.
     */
    protected function get_consent( $token = '', $customer_id = '' )
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
     * Charge fees.
     */
    protected function charge_fees( $token = '', $intent = [], $consent = [] )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $int = $this->get_secret( $token, $intent );

            if ( ! empty( $int ) )
            {
                return $this->confirm_intent( $token, $int[ 'id' ], $consent );
            }
        } 
        catch (\Throwable $th)
        {
            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Generate customer client secret.
     */
    protected function generate_customer_client_secret( $token = '', $customer_id = '' )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'GET', $this->awx_domain . '/api/v1/pa/customers/' . $customer_id . '/generate_client_secret', [
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
     * Confirm to continue with a payment intent.
     */
    protected function confirm_continue_intent( $token = '', $intent_id = '', $body = [] )
    {
        $client     = new \GuzzleHttp\Client();

        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/payment_intents/' . $intent_id . '/confirm_continue', [
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
        catch ( \GuzzleHttp\Exception\RequestException $e)
        {
            if ( $e->hasResponse() )
            {
                if ( $e->getResponse()->getStatusCode() == '400' )
                {
                    return json_decode( $e->getResponse()->getBody(), TRUE );
                }
            }

            return FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Create sutomer
     */
    protected function create_customer( $token = '', $body = [] )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/customers/create', [
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
     * Create consent
     */
    protected function create_consent( $token = '', $body = [] )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/payment_consents/create', [
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
     * Verify consent
     */
    protected function verify_consent( $token = '', $consent_id = '', $body = [] )
    {
        $client = new \GuzzleHttp\Client();
        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/pa/payment_consents/' . $consent_id . '/verify', [
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
