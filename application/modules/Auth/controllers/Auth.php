<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
    }

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('index');
	}

	public function cek_login() {
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$pass = md5($password);
		// $where = array(
		// 			'username' => $username,
		// 			'password' => md5($password)
		// 		);
		$where = "username = '$username' AND password = '$pass'";
		$hasil = $this->MasterData->getWhereDataAll('tbl_user',$where);
		// var_dump($hasil);
		if ($hasil->num_rows() == 1) {
			$id_role = $hasil->row()->id_role;

			$where = "id_role = $id_role";
			$dataRole = $this->MasterData->getWhereDataAll('tbl_role',$where)->row();
			$role = $dataRole->role;
			
			$sess_data['id_user'] = $hasil->row()->id_user;
			$sess_data['nama_user'] = $hasil->row()->nama_user;
			$sess_data['username'] = $hasil->row()->username;
			$sess_data['role'] = $role;
			$this->session->set_userdata($sess_data);
			
			$datas = ['success' => true, 'role' => $role];
		}
		else {
			$datas = ['success' => false];
		}

		echo json_encode($datas);
	}

	public function logout(){
		// Hapus semua data pada session
		$this->session->sess_destroy();

		// redirect ke halaman login	
		redirect('Auth/index');
	}

}
