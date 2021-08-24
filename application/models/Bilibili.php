<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Bilibili model.
 *
 */
class Bilibili extends CI_Model
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
     * Matching.
     *
     * @return array
     */
    public function get_bilibili_countries()
    {
        return $this->db->select( '*' )
                        ->where( 'is_supported', 1 )
                        ->get( 'bilibili_countries' )
                        ->result_array();
    }

    // --------------------------------------------------------------------

    /**
     * Matching.
     *
     * @return array
     */
    public function get_local_country( $code = '' )
    {
        return $this->db->select( '*' )
                        ->where( 'code', $code )
                        ->get( 'local_countries' )
                        ->row_array();
    }

    // --------------------------------------------------------------------

    /**
     * Matching.
     *
     * @return array
     */
    public function get_beneficiary_fields_by( $field = '', $val = '' )
    {
        return $this->db->select( '*' )
                        ->where( $field, $val )
                        ->get( 'beneficiary_fields' )
                        ->result_array();
    }

    // --------------------------------------------------------------------

    /**
     * Matching.
     *
     * @return array
     */
    public function get_beneficiary_fields()
    {
        return $this->db->select( '*' )
                        ->get( 'beneficiary_fields' )
                        ->result_array();
    }

    // --------------------------------------------------------------------

    /**
     * Updating.
     *
     * @return array
     */
    public function update_bilibili_countries( $item = [], $condition = [] )
    {
        return $this->db->update( 'bilibili_countries', $item, $condition ); 
    }

    // --------------------------------------------------------------------

    /**
     * Updating.
     *
     * @return array
     */
    public function update_beneficiary_fields( $item = [], $condition = [] )
    {
        return $this->db->update( 'beneficiary_fields', $item, $condition ); 
    }

    // --------------------------------------------------------------------

    /**
     * Adding.
     *
     * @return array
     */
    public function add_field_rule( $item = [] )
    {

        $res = $this->db->select( '*' )
                        ->where( 'path', $item[ 'path' ] )
                        ->where( 'type', $item[ 'type' ] )
                        ->where( 'rule', $item[ 'rule' ] )
                        ->get( 'field_rule' )
                        ->result_array();

        if ( ! empty( $res ) )
        {
            return NULL;
        }

        return $this->db->insert( 'field_rule', $item ); 
    }

    // --------------------------------------------------------------------

    /**
     * Matching.
     *
     * @return array
     */
    public function match_countries()
    {

    }

}
