<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Bilibili model.
 *
 */
class Bilibili extends CI_Model
{
    /**
     * Matching.
     *
     * @return array
     */
    public function get_countries()
    {
        $this->load->database();
        return $this->db->select( '*' )
                        ->where( 'is_supported', 1 )
                        ->get( 'bilibili_countries' )
                        ->result_array();
    }

    /**
     * Matching.
     *
     * @return array
     */
    public function get_local_country( $code = '' )
    {
        $this->load->database();
        return $this->db->select( '*' )
                        ->where( 'code', $code )
                        ->get( 'local_countries' )
                        ->row_array();
    }

    /**
     * Matching.
     *
     * @return array
     */
    public function match_countries()
    {
        $this->load->database();
        $b_countries = $this->db->select( '*' )
                                        ->where( 'is_supported', 1 )
                                       ->get( 'bilibili_countries' )
                                       ->result_array();
        foreach ( $b_countries as $c )
        {
            $currency = 'USD'; 
            if ( $c[ 'is_local' ] == 1 )
            {

                $cou = $this->db->select( '*' )
                                ->where( 'code', $c[ 'code' ] )
                                ->get( 'local_countries' )
                                ->row_array();
                $currency = $cou[ 'currency' ]; 
            }

            $this->db->where( 'id', $c[ 'id' ] );
            $this->db->update( 'bilibili_countries', [
                'currency' => $currency 
            ] ); 
        }
        return FALSE;

        /*
        foreach ( $b_countries as $c )
        {
            $country = $this->db->select( '*' )
                                ->where( 'country_zh', $c[ 'country_zh' ] )
                                ->get( 'swift_countries' )
                                ->row_array();

            // unsupported countries
            if ( empty( $country ) )
            {
                $this->db->where( 'id', $c[ 'id' ] );
                $this->db->update( 'bilibili_countries', [
                    'is_supported' => 0
                ] ); 
            }
            else
            {
                $this->db->where( 'id', $c[ 'id' ] );
                $this->db->update( 'bilibili_countries', [
                    'is_supported' => 1,
                    'code'         => $country[ 'code' ],
                    'country'      => $country[ 'country' ]
                ] ); 
            }

            // local countries
            $local_country = $this->db->select( '*' )
                                      ->where( 'code', $c[ 'code' ] )
                                      ->get( 'local_countries' )
                                      ->row_array();

            if ( ! empty( $local_country ) )
            {
                $this->db->where( 'id', $c[ 'id' ] );
                $this->db->update( 'bilibili_countries', [
                    'is_local' => 1
                ] ); 
            }

        }
         */

        /*
        // update local countries
        $l_countries = $this->db->select( '*' )
                                       ->get( 'local_countries' )
                                       ->result_array();
        foreach ( $l_countries as $c )
        {
            $country = $this->db->select( '*' )
                                ->where( 'code', $c[ 'code' ] )
                                ->get( 'swift_countries' )
                                ->row_array();

            // unsupported countries
            $this->db->where( 'id', $c[ 'id' ] );
            $this->db->update( 'local_countries', [
                'code'         => $country[ 'code' ],
                'country'      => $country[ 'country' ],
                'country_zh'      => $country[ 'country_zh' ],
                'is_sepa'      => $country[ 'is_sepa' ],
                'is_eea'      => $country[ 'is_eea' ],
            ] ); 
        }
         */


    }

}
