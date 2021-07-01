<?php defined('BASEPATH') OR exit('No direct script access allowed');


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
            'url'
        ] );

        $this->vars[ 'asset_path' ] = '/assets';
        $this->vars[ 'is_mobile' ] = $this->agent->is_mobile();

        $this->secret_key = 'sk_test_92d9ea33-3fe3-4b66-bdd8-3dee0b1f6b19';
    }

    // --------------------------------------------------------------------

    /**
     * Checkout Page.
     */
    public function checkout()
    {
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
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[225]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|max_length[225]'
            ],
            [
                'field' => 'cko-token',
                'label' => 'Token',
                'rules' => 'trim|required'
            ]
        ];
        $config = [
            'error_prefix' => '',
            'error_suffix' => '',
        ];
        $this->load->library( 'form_validation', $config );
        $this->form_validation->set_rules( $rules );

        $error_text = 'Invalid mobile number';
        if ( $this->form_validation->run() === FALSE )
        {
            $error_msg = [
                'name'      => form_error( 'name' ),
                'email'     => form_error( 'email' ),
                'cko-token' => form_error( 'cko-token' ),
            ];
            $this->json_response( [ 'result' => 0, 'msg' => $error_msg ] );
            return FALSE;
        }

        
        $checkout           = new CheckoutApi( $this->secret_key );

        // Payment details
        $cko_token  = $this->input->post( 'cko-token', TRUE );
        $amount     = $this->input->post( 'amount', TRUE );

        $method             = new TokenSource( $cko_token );
        $payment            = new Payment( $method, 'GBP' );
        $payment->amount    = $amount * 100;
        $payment->reference = 'ord_' . time();
        $payment->threeDs   = new ThreeDs( TRUE );
        $payment->risk      = new Risk( TRUE );
        $payment->setIdempotencyKey( 'ord_' . time() );

        // User details
        $name   = $this->input->post( 'name', TRUE );
        $email  = $this->input->post( 'email', TRUE );

        $customer           = new Customer();
        $customer->email    = $email;
        $customer->name     = $name;
        $payment->customer  = $customer;

        try
        {
            $response       = $checkout->payments()->request( $payment );
            $redirection    = $response->getRedirection();

            $this->json_response( [ 'result' => 1, 'redirection' => $redirection ] );
            return TRUE;
        }
        catch ( CheckoutModelException $ex )
        {
            return $ex->getErrors();
        }
        catch ( CheckoutHttpException $ex )
        {
            return $ex->getErrors();
        }

        $this->json_response( [ 'result' => 1 ] );
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Success Result.
     */
    public function success()
    {
        $cko_session_id = $this->input->get( 'cko-session-id', TRUE );
        if ( ! empty( $cko_session_id ) )
        {
            $checkout = new CheckoutApi( $this->secret_key );

            try
            {
                $details = $checkout->payments()->details( $cko_session_id );

                $this->vars[ 'cko_source_id' ]  = $details->source[ 'id' ];
                $this->vars[ 'order_number' ]   = $details->reference;
                $this->vars[ 'name' ]           = $details->customer[ 'name' ];
                $this->vars[ 'email' ]          = $details->customer[ 'email' ];
            }
            catch(CheckoutHttpException $ex)
            {
                return $ex->getErrors();
            }
        }

        $this->load->view( 'success', $this->vars );
    }

    // --------------------------------------------------------------------

    /**
     * Failure Result.
     */
    public function failure()
    {
        $cko_session_id = $this->input->get( 'cko-session-id', TRUE );
        if ( ! empty( $cko_session_id ) )
        {
            $checkout = new CheckoutApi( $this->secret_key );

            try
            {
                $details = $checkout->payments()->details( $cko_session_id );

                $this->vars[ 'order_number' ]   = $details->reference;
                $this->vars[ 'name' ]           = $details->customer[ 'name' ];
                $this->vars[ 'email' ]          = $details->customer[ 'email' ];
            }
            catch(CheckoutHttpException $ex)
            {
                return $ex->getErrors();
            }
        }

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
