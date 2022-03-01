<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Fx_Controller extends CI_Controller
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
    // protected $awx_domain = 'https://api-demo.airwallex.com';
    protected $awx_domain = 'https://api.airwallex.com';

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

        $this->load->model( [
            'dhgate'
        ] );

        $this->vars[ 'asset_path' ] = ( ENVIRONMENT == 'production' ) ? '/dist' : '/dist';
        $this->vars[ 'is_mobile' ] = $this->agent->is_mobile();
    }

    // --------------------------------------------------------------------

    /**
     * Index page.
     */
    public function index()
    {
        $currencies = [ 
'AED',
'ALL',
'ANG',
'ARS',
'BGN',
'BHD',
'BOB',
'BRL',
'BWP',
'CLP',
'COP',
'CRC',
'CZK',
'DOP',
'GHS',
'HRK',
'HUF',
'IDR',
'ILS',
'INR',
'KES',
'KHR',
'KRW',
'KWD',
'LBP',
'LKR',
'MAD',
'MVR',
'MXN',
'MYR',
'NGN',
'OMR',
'PEN',
'PHP',
'PKR',
'PLN',
'PYG',
'QAR',
'RON',
'RSD',
'RUB',
'SAR',
'THB',
'TRY',
'UAH',
'UGX',
'UYU',
'ZAR',
        ];
        

        $client_id  = $this->input->get( 'c', TRUE );
        $api_key    = $this->input->get( 'k', TRUE );

        $token = $this->get_api_token( $client_id, $api_key );

        foreach ( $currencies as $c )
        {
            $res = $this->get_mcp_rates( $token, $c, 'USD' );

            echo "<pre>";
            var_dump( $c );

            foreach ( $res[ 'items' ] as $r )
            {
                $this->dhgate->create_mcp_rate( $c, ( (float)$r[ 'client_rate' ] * 1.005 ), substr( $r[ 'valid_to' ], 0, 10 )  );
            }
        }
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
     * Get mcp rates.
     */
    protected function get_mcp_rates( $token = '', $pc = '', $sc = '' )
    {
        $client     = new \GuzzleHttp\Client();

        $params = '?page_size=100&page_num=0&payment_currency=' . $pc . '&settlement_currency=' . $sc;
        try
        {
            $response = $client->request( 'GET', $this->awx_domain . '/api/v1/pa/quotes' . $params, [
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
        catch ( \GuzzleHttp\Exception\RequestException $e)
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
