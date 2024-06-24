<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists( 'Awx_Controller', FALSE ) )
{
    require_once( APPPATH . 'controllers/Awx_Controller.php' );
}

class Applepay_Controller extends Awx_Controller
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
        $token = $this->get_api_token( $this->client_id, $this->api_key );

        if ( FALSE === $token )
        {
            show_404();
        }

        $customer_id = 'cus_hkdmvdxhrgwt2lzi0mz';

        $customer = $this->generate_customer_client_secret( $token, $customer_id );

        $customer[ 'id' ] = $customer_id; 

        $this->vars[ 'customer' ] = $customer;

        $this->load->view( 'applepay/applepay', $this->vars );
    }

}
