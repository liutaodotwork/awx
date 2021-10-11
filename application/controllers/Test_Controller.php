<?php defined('BASEPATH') OR exit('No direct script access allowed');

require VENDORPATH . '/autoload.php';

class Test_Controller extends CI_Controller
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
     * Index Page.
     */
    public function index()
    {
        $this->load->database();
        $this->load->dbutil();

        $dbs = $this->dbutil->list_databases();
        foreach ($dbs as $db)
        {
            echo $db;
        }

        if ( ! $this->dbutil->database_exists( 'database_name' ) )
        {
            echo 'does not exit';
        }
    }

}
