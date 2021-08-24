<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Payout_Controller extends CI_Controller
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
    protected $awx_domain = 'https://api-demo.airwallex.com';

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
            'bilibili'
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

        $countries = $this->bilibili->get_bilibili_countries();

        $client_id  = $this->input->get( 'c', TRUE );
        $api_key    = $this->input->get( 'k', TRUE );

        $token = $this->get_api_token( $client_id, $api_key );

        foreach ( $countries as $c )
        {
            $res = $this->get_form_schema( $token, [ 
                'entity_type' => 'PERSONAL',
                'bank_country_code' => $c[ 'code' ],
                'account_currency' => $c[ 'currency' ],
                'payment_method' => $c[ 'is_local' ] ? 'LOCAL' : 'SWIFT'
            ] );


            if ( empty( $res ) )
            {
                echo "<pre>";
                var_dump( 'not supported' . $c[ 'code' ] );
            }
            else
            {

                foreach ( $res[ 'fields' ] as $r )
                {

                    // $item = [
                    //     'label'    => $r[ 'field' ][ 'label' ],
                    //     'type'          => $r[ 'field' ][ 'type' ],
                    //     'rule'          => isset( $r[ 'rule' ] ) ? json_encode( $r[ 'rule' ], JSON_FORCE_OBJECT ) : ''
                    // ];
                    // if ( TRUE == $r[ 'required' ] )
                    // {
                    //     $item[ 'is_required' ] = 1;
                    // }

                    // $res = $this->bilibili->update_beneficiary_fields( $item, [ 'path' => $r[ 'path' ] ] );

                    $item = [
                        'path'          => $r[ 'path' ],
                        'type'          => $r[ 'field' ][ 'type' ],
                        'rule'          => isset( $r[ 'rule' ] ) ? json_encode( $r[ 'rule' ], JSON_FORCE_OBJECT ) : ''
                    ];

                    echo "<pre>";
                    var_dump($this->bilibili->add_field_rule( $item ));
                }
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
     * Get form schemas.
     */
    protected function get_form_schema( $token = '', $body = [] )
    {
        $client     = new \GuzzleHttp\Client();

        try
        {
            $response = $client->request( 'POST', $this->awx_domain . '/api/v1/beneficiary_form_schemas/generate', [
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
