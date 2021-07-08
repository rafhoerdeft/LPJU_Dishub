<?php

include_once(APPPATH.'libraries/REST_Controller.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Type extends MX_Controller {

	function __construct() {

		parent::__construct();

        $this->load->model('MasterData');

	}

    public function read_type()
    {
        $type = $this->db->query("SELECT * FROM typesurat")->result();
        echo json_encode($type);
    }



}

