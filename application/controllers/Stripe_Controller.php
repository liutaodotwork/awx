<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Stripe_Controller extends CI_Controller
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
    public function embedded_fields()
    {
        $this->vars[ 'publishable_key' ]    = $this->input->get( 'p', TRUE );
        $this->vars[ 'secret_key' ]         = $this->input->get( 's', TRUE );

        $this->load->view( 'stripe/payment', $this->vars );
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
                'field' => 'publishable-key',
                'label' => 'Publishable Key',
                'rules' => 'trim|required|max_length[225]'
            ],
            [
                'field' => 'secret-key',
                'label' => 'Secret Key',
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
                'publishable_key'       => form_error( 'publishable-key' ),
                'secret_key'            => form_error( 'secret-key' )
            ];
            $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
            return FALSE;
        }

        $this->vars[ 'publishable_key' ]    = $this->input->post( 'publishable-key', TRUE );
        $this->vars[ 'secret_key' ]         = $this->input->post( 'secret-key', TRUE );

        $stripe = new \Stripe\StripeClient( [
            'api_key' => $this->vars[ 'secret_key' ],
            'stripe_version' => '2020-08-27',
        ] );

        try {
            $this->vars[ 'intent' ] = $stripe->paymentIntents->create( [
                'payment_method_types' => ['card'],
                'amount' => 1999,
                'currency' => 'usd',
            ] );

        } catch (\Stripe\Exception\ApiErrorException $e) {
            http_response_code(400);
            error_log($e->getError()->message);
            return;
        } catch (Exception $e) {
            error_log($e);
            http_response_code(500);
            return;
        }

        $this->json_response( [ 'result' => 1, 'intent' => $this->vars[ 'intent' ], 'publishable_key' =>  $this->vars[ 'publishable_key' ] ] );

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Success Result.
     */
    public function success()
    {
        $client_id  = $this->input->get( 'p', TRUE );
        $api_key    = $this->input->get( 's', TRUE );
        $intent_id  = $this->input->get( 'id', TRUE );
        if ( empty( $intent_id ) OR  empty( $client_id ) OR empty( $api_key )  )
        {
            show_404();
        }

        $stripe = new \Stripe\StripeClient( $api_key );

        $intent = $stripe->paymentIntents->retrieve( $intent_id );

        if ( FALSE === $intent )
        {
            show_404();
        }

        $this->vars[ 'intent' ] = $intent;

        $this->vars[ 'back_url' ] = '/s-payment?p=' . $client_id . '&s=' . $api_key;

        $this->load->view( 'success', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Failure Result.
     */
    public function failure()
    {
        $client_id = $this->input->get( 'c', TRUE );
        $api_key = $this->input->get( 'k', TRUE );
        $mode       = $this->input->get( 'm', TRUE );
        $intent_id = $this->input->get( 'id', TRUE );
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
        if ( 'nc-direct-api' == $mode )
        {
            $this->vars[ 'back_url' ]   = '/nc-direct-api-for-card-payments?c=' . $client_id . '&k=' . $api_key;
        }
        elseif ( 'direct-api' == $mode )
        {
            $this->vars[ 'back_url' ]   = '/direct-api-for-card-payments?c=' . $client_id . '&k=' . $api_key;
        }
        else
        {
            $this->vars[ 'back_url' ] = '/embedded-fields-for-card-payments?c=' . $client_id . '&k=' . $api_key;
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
