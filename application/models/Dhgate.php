<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Dhgate model.
 *
 */
class Dhgate extends CI_Model
{
    /**
     * Constructor
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    // --------------------------------------------------------------------

    /**
     * Create mcp rate.
     *
     * @return array
     */
    public function create_mcp_rate( $payment_currency = '', $rate = '', $date = '' )
    {
        return $this->db->insert( 'dhgate_mcp_2usd_rates', [
            'payment_currency' => $payment_currency,
            'rate' => $rate,
            'date' => $date,
        ] ); 
    }

}
