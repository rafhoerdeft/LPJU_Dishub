<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		$this->load->helper('alert');
		$this->load->helper('encrypt');
		$this->sms = $this->load->database('sms', TRUE);

		if ($this->session->userdata('role') != '') {
			redirect('Auth');
		}

		$this->head = array(
			"assets/assets/plugins/bootstrap/css/bootstrap.min.css",
		    // "assets/assets/plugins/morrisjs/morris.css",
		    "assets/assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css",
		    "assets/main/css/style.css",
		    "assets/main/css/colors/blue.css",
		);


		$this->foot = array(
			"assets/assets/plugins/jquery/jquery.min.js",
		    "assets/assets/plugins/bootstrap/js/popper.min.js",
		    "assets/assets/plugins/bootstrap/js/bootstrap.min.js",
		    "assets/main/js/jquery.slimscroll.js",
		    "assets/main/js/waves.js",
		    "assets/main/js/sidebarmenu.js",
		    "assets/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js",
		    "assets/main/js/custom.min.js",
		    "assets/main/js/validation.js",
		    // "assets/assets/plugins/sparkline/jquery.sparkline.min.js",
		    // "assets/assets/plugins/raphael/raphael-min.js",
		    // "assets/assets/plugins/morrisjs/morris.min.js",
		    "assets/assets/plugins/styleswitcher/jQuery.style.switcher.js"
		);
    }

    function info(){
    	echo phpinfo();
    }

	public function index_old($sess=''){
		if ($sess == '') {
			$this->session->unset_userdata('alert');
		}
		

		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();

		$jmlPj = 0;
		$pj_baik = 0;
		$pj_rusak = 0;
		foreach ($jenisPj as $jenis) {
			// if ($jenis->nama_jenis != 'Alat penerangan jalan') {
				$tbl_pj = $this->MasterData->getData($jenis->nama_tbl);
				$jmlPj += $tbl_pj->num_rows();
			// }

				foreach ($tbl_pj->result() as $pj) {
					if ($pj->kondisi_pj == 'Baik') {
						$pj_baik++;
					} else {
						$pj_rusak++;
					}
				}
		}

		$jmlPJU = $this->MasterData->getData('tbl_pj_lampu_jalan')->num_rows();

		$this->foot[] = "assets/main/js/dashboard1.js";

		$head['head'] = $this->head;
		$foot['foot'] = $this->foot;
		$nav['menu'] = 'dashboard';

		$data = array(
			'jml_pj' => $jmlPj,
			'jml_pju' => $jmlPJU,
			'jml_pj_baik' => $pj_baik,
			'jml_pj_rusak' => $pj_rusak
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/dashboard',$data);
		$this->load->view('foot',$foot);
	}

	// =====================================================

	public function index($id='1'){

		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();
		$statusJl = $this->MasterData->getData('tbl_status_jalan')->result();

		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'js_link' => $js_link
		);

		$nav['menu'] = 'map';

		$data = array(
			'jenisPj' => $jenisPj,
			'statusJl' => $statusJl
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/map',$data);
		$this->load->view('foot',$foot);
	}

	public function test(){
		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();
		$statusJl = $this->MasterData->getData('tbl_status_jalan')->result();

		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'js_link' => $js_link
		);

		$nav['menu'] = 'map';

		$data = array(
			'jenisPj' => $jenisPj,
			'statusJl' => $statusJl
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/test',$data);
		$this->load->view('foot',$foot);
	}

	public function getLocation($val=''){
		$id = $this->input->POST('id');
		$jln = $this->input->POST('jln');

		if ($jln=='all') {
			$id_status_jalan = '%';
		} else {
			$id_status_jalan = $jln;
		}

		$table = 'tbl_jenis_pj';
		$where = "id_jenis = '$id'";
		$pj = $this->MasterData->getDataWhere($table,$where);
		$getTbl = $pj->row()->nama_tbl;
		$icon = $pj->row()->icon_jenis;

		$table = "$getTbl";
		$totalPJ = $this->MasterData->getData($table)->num_rows();	

		$table = "$getTbl";
		$where = "kondisi_pj = 'Baik'";
		$totalPJBaik = $this->MasterData->getDataWhere($table,$where)->num_rows();	
		$where = "kondisi_pj = 'Rusak'";
		$totalPJRusak = $this->MasterData->getDataWhere($table,$where)->num_rows();	

		$table = array(
			$getTbl,
			'tbl_jalan',
			'tbl_status_jalan'
		);
		$where = "
			$getTbl.id_jalan=tbl_jalan.id_jalan and 
			tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and 
			tbl_status_jalan.id_status_jalan like '%$id_status_jalan%'
		";
		$data = $this->MasterData->getDataWhere($table,$where);
		$dataLoc = $data->result();
		$totalFilter = $data->num_rows();

		$where = "
			$getTbl.id_jalan=tbl_jalan.id_jalan and 
			tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and 
			tbl_status_jalan.id_status_jalan like '%$id_status_jalan%' and
			kondisi_pj = 'Baik'
		";
		$totalFilterBaik = $this->MasterData->getDataWhere($table,$where)->num_rows();

		$where = "
			$getTbl.id_jalan=tbl_jalan.id_jalan and 
			tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and 
			tbl_status_jalan.id_status_jalan like '%$id_status_jalan%' and
			kondisi_pj = 'Rusak'
		";
		$totalFilterRusak = $this->MasterData->getDataWhere($table,$where)->num_rows();

        if ($dataLoc) {
        	$locArr = array();
	        foreach ($dataLoc as $loc) {
	        	if ($icon == 'rambu') {
	        		$id_icon = $loc->id_jenis_rambu;
	        		$table = 'tbl_jenis_rambu';
	        		$where = "id_jenis_rambu = '$id_icon'";
	        		$icons = $this->MasterData->getDataWhere($table,$where)->row()->icon_rambu;
	        		$icons = 'rambu/'.$icons;
		        } else {
		        	$icons = $icon;
		        }

	            $locArr[] = array(
	            	'nama_pj' => $loc->nama_pj,
	            	'kondisi_pj' => $loc->kondisi_pj,
	                'lat' => $loc->latitude,
	                'lng' => $loc->longitude,
	                'icon' => $icons,
	                'pic' => $loc->foto_pj
	            );
	        }

        	$result = array(
				'response' => true,
				'data' => $locArr,
				'icon' => $icon,
				'totalFilter' => $totalFilter,
				'totalFilterBaik' => $totalFilterBaik,
				'totalFilterRusak' => $totalFilterRusak,
				'totalPJ' => $totalPJ,
				'totalPJBaik' => $totalPJBaik,
				'totalPJRusak' => $totalPJRusak
			);
        } else {
        	$result = array(
				'response' => false,
				'totalPJ' => $totalPJ,
				'totalPJBaik' => $totalPJBaik,
				'totalPJRusak' => $totalPJRusak
			);
        }      

        echo json_encode($result);

	}

	// =====================================================

	public function ruasJalan($value=''){

		$dataStatusJln = $this->MasterData->getData('tbl_status_jalan')->result();	

		$select = array(
			'jln.*',
			'sts.status_jalan'
		);
		$table = array(
			'tbl_jalan jln',
			'tbl_status_jalan sts'
		);
		$where = "jln.id_status_jalan = sts.id_status_jalan";
		$order = 'DESC';
		$by = 'jln.id_jalan';
		$dataRuasJln = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();	

		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";

		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";

		$script = array(
			"$('#myTable').DataTable();"
		);

		$head['head'] = $this->head;
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script
		);

		$nav['menu'] = 'jalan';

		$data = array(
			'status_jalan' => $dataStatusJln,
			'ruas_jalan' => $dataRuasJln
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/ruas_jalan',$data);
		$this->load->view('foot',$foot);
	}

	public function getLines($value=''){
		
		$select = array(
			'sts.warna_jalan',
			'jln.*'
		);
		$table = array(
			'tbl_status_jalan sts',
			'tbl_jalan jln'
		);
		$where = "sts.id_status_jalan = jln.id_status_jalan";
		$dataLines = $this->MasterData->getWhereData($select,$table,$where)->result();

		if ($dataLines) {
			$linesArr = array();
			foreach ($dataLines as $lines) {
				$linesArr[] = array(
					'warna_jln' => $lines->warna_jalan,
					'koordinat' => $lines->koordinat,
					'nama_jln' => $lines->nama_jalan,
					'pjg_jln' => $lines->panjang_jalan
				);
			}

			$result = array(
				'response' => true,
				'data' => $linesArr
			);
		} else {
			$result = array(
				'response' => false
			);
		}

		echo json_encode($result);
	}

	public function simpanRuasJalan($value='') {
		$input = $this->input->POST();
		// $sess['show_alert'] = 1;

		if ($input) {
			$data = array(
				'nama_jalan' => $input['nama_jln'],
				'koordinat' => $input['koordinat'],
				'id_status_jalan' => $input['id_status_jalan'],
				'panjang_jalan' => $input['pjg_jln']
			);
			$table = 'tbl_jalan';
			$inputData = $this->MasterData->inputData($data,$table);

			if ($inputData) {
				$sess['alert'] = alert_success('Data ruas jalan berhasil disimpan.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/ruasJalan');
			} else {
				$sess['alert'] = alert_failed('Data ruas jalan gagal disimpan.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/ruasJalan');
			}
		} else {
			$sess['alert'] = alert_failed('Data ruas jalan gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/ruasJalan');
		}

		// var_dump($input);
	}

	public function updateRuasJalan($value='') {
		$input = $this->input->POST();
		// $sess['show_alert'] = 1;

		if ($input) {
			$data = array(
				'nama_jalan' => $input['nama_jln'],
				// 'koordinat' => $input['koordinat'],
				'id_status_jalan' => $input['id_status_jalan'],
				'panjang_jalan' => $input['pjg_jln']
			);
			$table = 'tbl_jalan';
			$where = "id_jalan = $input[id_jalan]";
			$updateData = $this->MasterData->editData($where,$data,$table);

			if ($updateData) {
				$sess['alert'] = alert_success('Data ruas jalan berhasil diupdate.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/ruasJalan');
			} else {
				$sess['alert'] = alert_failed('Data ruas jalan gagal diupdate.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/ruasJalan');
			}
		} else {
			$sess['alert'] = alert_failed('Data ruas jalan gagal diupdate.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/ruasJalan');
		}

		// var_dump($input);
	}

	public function deleteRuasJalan($value='') {
		$id = $this->input->POST('id');

		$table = 'tbl_jenis_pj';
		$pj = $this->MasterData->getData($table)->result();

		foreach ($pj as $key) {
			$nama_tbl = $key->nama_tbl;
			$id_jenis_pj = $key->id_jenis;
			$where = "id_jenis_pj = '$id_jenis_pj' AND id_pj IN (SELECT id_pj FROM $nama_tbl WHERE id_jalan = '$id')";
			$delRiwayatInput = $this->MasterData->deleteData($where,'tbl_riwayat_input_pj');
			$delRiwayatPerbaikan = $this->MasterData->deleteData($where,'tbl_riwayat_perbaikan');
		}

		if ($delRiwayatPerbaikan && $delRiwayatInput) {

			$where = "id_jalan = '$id'";
			$table = 'tbl_jalan';
			$delete = $this->MasterData->deleteData($where,$table);

			if ($delete) {
				echo "Success";
				$sess['alert'] = alert_success('Data ruas jalan berhasil dihapus.');
				$this->session->set_flashdata($sess);
				// redirect(base_url().'Admin/ruasJalan');
			} else {
				echo "Failed";
				$sess['alert'] = alert_failed('Data ruas jalan gagal dihapus.');
				$this->session->set_flashdata($sess);
				// redirect(base_url().'Admin/ruasJalan');
			}
		} else {
			echo "Failed";
			$sess['alert'] = alert_failed('Data ruas jalan gagal dihapus.');
			$this->session->set_flashdata($sess);
			// redirect(base_url().'Admin/ruasJalan');
		}
	}

	// =====================================================

	public function jenisRuasJalan(){

    	// $this->head[] = "assets/assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css";
    	$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		// $this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";

		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js";
		$this->foot[] = "assets/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		

		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
	        // "$('.selectpicker').selectpicker();"
	        "$('.colorpicker').asColorPicker();",
		);

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			'js_link' => $js_link
		);

		$nav['menu'] = 'jenisruas';

		$by = 'id_status_jalan';
		$order = 'DESC';
		$dataJenisJln = $this->MasterData->getSelectDataOrder('*','tbl_status_jalan',$by,$order)->result();

		$data = array(

			'jenis_jalan' => $dataJenisJln
			
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/jenis_ruas_jalan',$data);
		$this->load->view('foot',$foot);

	}

	function saveStatusJalan(){
		$data = $_POST;

		$save = $this->MasterData->inputData($data,'tbl_status_jalan');
		if ($save) {
			$sess['alert'] = alert_success('Data status jalan berhasil disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data status jalan gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		}
	}

	function getDataJenisJalan(){
		$id = $this->input->post('id');
		$where = "id_status_jalan = $id";
		$data = $this->MasterData->getDataWhere('tbl_status_jalan',$where)->result();
		echo json_encode($data);
	}

	function updateStatusJalan(){
		$data = $_POST;
		
		$id = $data['id_status_jalan'];

		unset($data['id_status_jalan']);

		$where = "id_status_jalan = ".$id;

		$update = $this->MasterData->editData($where,$data,'tbl_status_jalan');

		if ($update) {
			$sess['alert'] = alert_success('Data status jalan berhasil disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data status jalan gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		}
	}

	function deleteStatusJalan($id){
		$id = decode($id);
		$where = "id_status_jalan = $id";
		$delete = $this->MasterData->deleteData($where,'tbl_status_jalan');
		if ($delete) {
			$sess['alert'] = alert_success('Data status jalan berhasil dihapus.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data status jalan gagal dihapus.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisRuasJalan');
		}
	}

	// =====================================================

	public function jenisLampu(){

    	$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		// $this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";

		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		// $this->foot[] = "assets/assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js";
		// $this->foot[] = "assets/assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		

		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
	        // "$('.selectpicker').selectpicker();"
	        // "$('.colorpicker').asColorPicker();",
		);

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			'js_link' => $js_link
		);

		$nav['menu'] = 'jenislampu';

		$by = 'id_jenis_lampu';
		$order = 'DESC';
		$dataJenis = $this->MasterData->getSelectDataOrder('*','tbl_jenis_lampu',$by,$order)->result();

		$data = array(

			'jenis_lampu' => $dataJenis,
			
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/jenis_lampu',$data);
		$this->load->view('foot',$foot);

	}

	function saveJenisLampu(){
		$data = $_POST;

		$save = $this->MasterData->inputData($data,'tbl_jenis_lampu');
		if ($save) {
			$sess['alert'] = alert_success('Data jenis lampu berhasil disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data jenis lampu gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		}
	}

	function getDataJenisLampu(){
		$id = decode($this->input->post('id'));
		$where = "id_jenis_lampu = $id";
		$data = $this->MasterData->getDataWhere('tbl_jenis_lampu',$where)->result();
		echo json_encode($data);
	}

	function updateJenisLampu(){
		$data = $_POST;

		$id = decode($data['id_jenis_lampu']);

		unset($data['id_jenis_lampu']);

		$where = "id_jenis_lampu = $id";

		$update = $this->MasterData->editData($where,$data,'tbl_jenis_lampu');
		if ($update) {
			$sess['alert'] = alert_success('Data jenis lampu berhasil disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data jenis lampu gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		}
	}

	function deleteJenisLampu($id){
		$id = decode($id);
		$where = "id_jenis_lampu = $id";
		$delete = $this->MasterData->deleteData($where,'tbl_jenis_lampu');
		if ($delete) {
			$sess['alert'] = alert_success('Data jenis lampu berhasil dihapus.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		} else {
			$sess['alert'] = alert_failed('Terjadi kesalahan. Data jenis lampu gagal dihapus.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/jenisLampu');
		}
	}

	// =====================================================

	public function perlengkapanJalan($id='',$listrik=''){
		if ($id == '') {
			$id_jenis_pj = '1';
		} else {
			$id_jenis_pj = decode($id);
		}

		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();	
		$dataKec = $this->MasterData->getData('tbl_kecamatan')->result();	
		$dataRuasJln = $this->MasterData->getData('tbl_jalan')->result();	
		$jenisLampu = $this->MasterData->getData('tbl_jenis_lampu')->result();	
		$jenisRambu = $this->MasterData->getData('tbl_jenis_rambu')->result();	

		$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";
		$this->head[] = "assets/assets/plugins/dropify/dist/css/dropify.min.css";

		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		$this->foot[] = "assets/assets/plugins/dropify/dist/js/dropify.min.js";

		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
			"$('.dropify').dropify({
				 messages: {
	                default: '<center>Upload foto/gambar disini.</center>',
	                error: '<center>Maksimal ukuran file 500 KB.</center>',
	            }
			});"
	        // "$('.selectpicker').selectpicker();"
		);

		// ====================================================
		$table = 'tbl_jenis_pj';
		$where = "id_jenis = '$id_jenis_pj'";
		$pj = $this->MasterData->getDataWhere($table,$where);
		$getTbl = $pj->row()->nama_tbl;
		$icon = $pj->row()->icon_jenis;

		if ($getTbl == 'tbl_pj_lampu_jalan') {
			
			if ($listrik !='') {
				$id_listrik = decode($listrik);
				if ($id_listrik == 'all') {
					$id_listrik = '%';
				}
			} else {
				$id_listrik = '%';
			}

			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_lampu FROM tbl_jenis_lampu jns WHERE jns.id_jenis_lampu = pj.id_jenis_lampu) jenis_lampu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$where = "id_listrik like '%$id_listrik%'";
			$by = 'pj.id_pj';
			$order = 'DESC';
			$dataLoc = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
			// var_dump($dataLoc);exit();
			// $dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
		} else if ($getTbl == 'tbl_pj_rambu') {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_rambu FROM tbl_jenis_rambu jns WHERE jns.id_jenis_rambu = pj.id_jenis_rambu) jenis_rambu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$by = 'pj.id_pj';
			$order = 'DESC';
			$dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
		} else {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$by = 'pj.id_pj';
			$order = 'DESC';
			$dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();	
		}

        if ($dataLoc) {
        	$locArr = array();
	        foreach ($dataLoc as $loc) {
	        	if ($icon == 'rambu') {
	        		$id_icon = $loc->id_jenis_rambu;
	        		$table = 'tbl_jenis_rambu';
	        		$where = "id_jenis_rambu = '$id_icon'";
	        		$icons = $this->MasterData->getDataWhere($table,$where)->row()->icon_rambu;
	        		$icons = 'rambu/'.$icons;
		        } else {
		        	$icons = $icon;
		        }

	            $locArr[] = array(
	            	'nama_pj' => $loc->nama_pj,
	                'lat' => $loc->latitude,
	                'lng' => $loc->longitude,
	                'icon' => $icons,
	                'pic' => $loc->foto_pj,
	                'kondisi_pj' => $loc->kondisi_pj
	            );
	        }

        	$dataCoord = json_encode($locArr);
        } else {
        	$dataCoord = 'null';
        }
        // ===========================================

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			'js_link' => $js_link
		);

		$nav['menu'] = 'perlengkapan';

		$data = array(
			'jenisPj' => $jenisPj,
			'dataCoord' => $dataCoord,
			'idSelectPj' => $id_jenis_pj,
			'dataPj' => $dataLoc,
			'dataKec' => $dataKec,
			'dataRuasJln' => $dataRuasJln,
			'jenis_lampu' => $jenisLampu,
			'jenis_rambu' => $jenisRambu
		);

		if ($id_jenis_pj=='1') {
			$table = [
				'tbl_pj_pln',
				'tbl_jalan'
			];
			$where = "tbl_pj_pln.id_jalan = tbl_jalan.id_jalan";
			$data['listrik'] = $this->MasterData->getDataWhere($table,$where)->result();

		}

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/perlengkapan',$data);
		$this->load->view('foot',$foot);
	}

	public function getDataEditPj($value='') {
		$id_jenis_pj = $this->input->POST('id_jenis_pj');
		$id_pj = $this->input->POST('id_pj');

		$table = 'tbl_jenis_pj';
    	$where = "id_jenis = $id_jenis_pj";
    	$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

    	$table = $getTbl;
    	$where = "id_pj = $id_pj";
		$dataPj = $this->MasterData->getDataWhere($table,$where)->result();

		if ($dataPj) {
			$result = array(
				'response' => true,
				'data' => $dataPj
			);
		} else {
			$result = array(
				'response' => false
			);
		}

		echo json_encode($result);
	}

	public function updatePj(){
		$data = $this->input->POST();

		if ($data) { 
			$id_jenis_pj = $this->input->POST('id_jenis_pj');
			$where = "id_jenis='$id_jenis_pj'";
			$table = $this->MasterData->getDataWhere('tbl_jenis_pj',$where)->row()->nama_tbl;

			$where = "id_pj=".$data['id_pj'];
			$data_pic = $this->MasterData->getDataWhere($table,$where)->row()->foto_pj;
			$data_pic = explode(';', $data_pic);

			$new_photo = array();

			$pic_old = $this->input->POST('file_pic_old');
			if (isset($pic_old)) {
				foreach ($data_pic as $row) {
					$cek = 0;
					foreach ($pic_old as $key) {
						if($row==$key){
							$cek++;
						} 
					}

					if ($cek == 0) {
						unlink(APPPATH.'../assets/path_foto/'.$row);
					} else {
						array_push($new_photo, $row);
					}
				}
			} else {
				foreach ($data_pic as $row) {
					unlink(APPPATH.'../assets/path_foto/'.$row);
				}
			}

			$fp = date('YmdHis');

			$config['upload_path']          = './assets/path_foto';
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['overwrite']			= false;
		    $config['file_name']			= $fp;
		    $this->load->library('upload', $config);

		    if (isset($_FILES['file_pic_new'])){
		    	$fileupload = $_FILES['file_pic_new'];
				foreach ($fileupload['name'] as $key => $val) {
					$_FILES['file_pic_new']['name']= $fileupload['name'][$key];
			        $_FILES['file_pic_new']['type']= $fileupload['type'][$key];
			        $_FILES['file_pic_new']['tmp_name']= $fileupload['tmp_name'][$key];
			        $_FILES['file_pic_new']['error']= $fileupload['error'][$key];
			        $_FILES['file_pic_new']['size']= $fileupload['size'][$key];

					if ($this->upload->do_upload('file_pic_new')) {
		                $data_file = $this->upload->data();
						array_push($new_photo, $data_file['file_name']);
		            }
				}
			}

			$new_photo = json_encode($new_photo); 
			$new_photo = str_replace('"', '', $new_photo);
			$new_photo = str_replace('[', '', $new_photo);
			$new_photo = str_replace(']', '', $new_photo);
			$new_photo = str_replace(',', ';', $new_photo);

			$dataUpdate = array();
	    	foreach ($data as $key => $val) {
	    		if ($key!='file_pic_new') {
	    			if ($key!='file_pic_old') {
	    				if ($key!='id_jenis_pj') {
	    					if ($key!='id_pj') {
	    						$dataUpdate[$key] = $val;
		    					$dataUpdate['foto_pj'] = $new_photo;
	    					}
	    				}
	    			}
	    		}
	    	}

	    	$where = 'id_pj = '.$data['id_pj'];
	    	$updateData = $this->MasterData->editData($where,$dataUpdate,$table);

	    	if ($updateData) {
				$sess['alert'] = alert_success('Data perlengkapan jalan berhasil disimpan.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/perlengkapanJalan/'.encode($data['id_jenis_pj']));
			} else {
				$sess['alert'] = alert_failed('Data perlengkapan jalan gagal disimpan.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/perlengkapanJalan/'.encode($data['id_jenis_pj']));
			}
		} else {
			$sess['alert'] = alert_failed('Data perlengkapan jalan gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/perlengkapanJalan/'.encode($data['id_jenis_pj']));
		}
	}

	public function deletePj(){
		$id_jenis_pj = $this->input->POST('id_jenis_pj');
		$id_pj = $this->input->POST('id_pj');

		$where = "id_jenis=".$id_jenis_pj;
		$table = $this->MasterData->getDataWhere('tbl_jenis_pj',$where)->row()->nama_tbl;

		$where = "id_pj=".$id_pj;
		$data_pic = $this->MasterData->getDataWhere($table,$where)->row()->foto_pj;
		$data_pic = explode(';', $data_pic);

		foreach ($data_pic as $key) {
			if (file_exists(APPPATH.'../assets/path_foto/'.$key)) {
				unlink(APPPATH.'../assets/path_foto/'.$key);
			}
		}

		$delete = $this->MasterData->deleteData($where,$table);
		if ($delete) {

			$where = "id_pj = '$id_pj' AND id_jenis_pj = '$id_jenis_pj'";
			$deleteRiwayatInput = $this->MasterData->deleteData($where,'tbl_riwayat_input_pj');

			if ($deleteRiwayatInput) {
				$deleteRiwayatPj = $this->MasterData->deleteData($where,'tbl_riwayat_perbaikan');

				if ($deleteRiwayatPj) {
					$url = base_url('Admin/perlengkapanJalan/'.encode($id_jenis_pj));
					echo $url;
					$sess['alert'] = alert_success('Data perlengkapan jalan berhasil dihapus.');
					$this->session->set_flashdata($sess);
				} else {
					$url = base_url('Admin/perlengkapanJalan/'.encode($id_jenis_pj));
					echo $url;
					$sess['alert'] = alert_failed('Data perlengkapan jalan gagal dihapus.');
					$this->session->set_flashdata($sess);
				}

			} else {
				$url = base_url('Admin/perlengkapanJalan/'.encode($id_jenis_pj));
				echo $url;
				$sess['alert'] = alert_failed('Data perlengkapan jalan gagal dihapus.');
				$this->session->set_flashdata($sess);
			}
			
		} else {
			$url = base_url('Admin/perlengkapanJalan/'.encode($id_jenis_pj));
			echo $url;
			$sess['alert'] = alert_failed('Data perlengkapan jalan gagal dihapus.');
			$this->session->set_flashdata($sess);
		}
	}

	public function tambah_data_pj($id=''){
		if ($id == '') {
			$id_jenis_pj = '1';
		} else {
			$id_jenis_pj = decode($id);
		}

		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();	
		$dataKec = $this->MasterData->getData('tbl_kecamatan')->result();	
			$where = "tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan";
		$dataRuasJln = $this->MasterData->getDataWhere(array('tbl_jalan','tbl_status_jalan'),$where)->result();	
		$jenisLampu = $this->MasterData->getData('tbl_jenis_lampu')->result();	
		$jenisRambu = $this->MasterData->getData('tbl_jenis_rambu')->result();	
		$jenisSumber = $this->MasterData->getData('tbl_sumber_dana')->result();	
		$jenisAset = $this->MasterData->getData('tbl_aset')->result();	
		$jenisTiang = $this->MasterData->getData('tbl_jenis_tiang')->result();

		$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";
		$this->head[] = "assets/assets/plugins/dropify/dist/css/dropify.min.css";

		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		$this->foot[] = "assets/assets/plugins/dropify/dist/js/dropify.min.js";

		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
			"$('.dropify').dropify({
				 messages: {
	                default: '<center>Upload foto/gambar disini.</center>',
	                error: '<center>Maksimal ukuran file 500 KB.</center>',
	            }
			});"
		);

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			'js_link' => $js_link
		);

		$nav['menu'] = 'perlengkapan';

		$data = array(
			'jenisPj' => $jenisPj,
			'idSelectPj' => $id_jenis_pj,
			'dataKec' => $dataKec,
			'dataRuasJln' => $dataRuasJln,
			'jenis_lampu' => $jenisLampu,
			'jenis_rambu' => $jenisRambu,
			'jenis_sumber_dana' => $jenisSumber,
			'jenis_aset' => $jenisAset,
			'jenis_tiang' => $jenisTiang,
		);

		if ($id_jenis_pj=='1') {
			$table = [
				'tbl_pj_pln',
				'tbl_jalan'
			];
			$where = "tbl_pj_pln.id_jalan = tbl_jalan.id_jalan";
			$data['listrik'] = $this->MasterData->getDataWhere($table,$where)->result();
		}

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/tambah_pju',$data);
		$this->load->view('foot',$foot);
	}

	public function addPJ(){
		$data = $_POST;

		$id_jenis = decode($data['id_jenis']);
		unset($data['id_jenis']);

		$table = 'tbl_jenis_pj';
		$where = "id_jenis = '$id_jenis'";
		$pj = $this->MasterData->getDataWhere($table,$where);
		$getTbl = $pj->row()->nama_tbl;

		$fp = date('YmdHis');
		$config['upload_path']          = './assets/path_foto';
	    $config['allowed_types']        = 'gif|jpg|png';
	    $config['overwrite']			= false;
	    $config['file_name']			= $fp;
	    $this->load->library('upload', $config);

	    $new_photo = array();

	    if (isset($_FILES['file_pic_new'])){
	    	$fileupload = $_FILES['file_pic_new'];
			foreach ($fileupload['name'] as $key => $val) {
				$_FILES['file_pic_new']['name']= $fileupload['name'][$key];
		        $_FILES['file_pic_new']['type']= $fileupload['type'][$key];
		        $_FILES['file_pic_new']['tmp_name']= $fileupload['tmp_name'][$key];
		        $_FILES['file_pic_new']['error']= $fileupload['error'][$key];
		        $_FILES['file_pic_new']['size']= $fileupload['size'][$key];

				if ($this->upload->do_upload('file_pic_new')) {
	                $data_file = $this->upload->data();
					array_push($new_photo, $data_file['file_name']);
	            }
			}
		}

		$new_photo = json_encode($new_photo); 
		$new_photo = str_replace('"', '', $new_photo);
		$new_photo = str_replace('[', '', $new_photo);
		$new_photo = str_replace(']', '', $new_photo);
		$new_photo = str_replace(',', ';', $new_photo);

		unset($data['file_pic_new']);

		$data['foto_pj'] = $new_photo;

		$insert = $this->MasterData->inputData($data,$getTbl);

		if ($insert) {			
			$sess['alert'] = alert_success('Data perlengkapan jalan berhasil diinput.');
			$this->session->set_flashdata($sess);
		} else {
			$sess['alert'] = alert_failed('Data perlengkapan jalan gagal diinput.');
			$this->session->set_flashdata($sess);
		}

		redirect(base_url('Admin/tambah_data_pj/'.encode($id_jenis)));

	}

	public function riwayatPj($id_pj='',$id_jenis_pj=''){
		$id_jenis_pj = decode($id_jenis_pj);
		$id_pj = decode($id_pj);

		$where = 'id_jenis='.$id_jenis_pj;
		$nama_jenis = $this->MasterData->getDataWhere('tbl_jenis_pj',$where)->row()->nama_jenis;
		$nama_tbl = $this->MasterData->getDataWhere('tbl_jenis_pj',$where)->row()->nama_tbl;

		$select = array(
			'id_riwayat',
			'tgl_riwayat', 
			'ket_riwayat',
			'nama_pj',
			'id_user',
			'nama_user'
		);
		$where = "
			tbl_riwayat_perbaikan.id_jenis_pj='$id_jenis_pj' and 
			tbl_riwayat_perbaikan.id_pj='$id_pj' and
			tbl_riwayat_perbaikan.id_pj=$nama_tbl.id_pj and
			tbl_riwayat_perbaikan.id_user=tbl_user.id_user
			order by tgl_riwayat DESC
		";
		$table = array(
			'tbl_riwayat_perbaikan',
			$nama_tbl,
			'tbl_user'
		);
		$dataRiwayat = $this->MasterData->getWhereData('*',$table,$where);

		$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";
		$this->head[] = "assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css";
		$this->head[] = "assets/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css";
		$this->head[] = "assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css";

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js";

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
			"$('.mydatepicker').datepicker({ format: 'dd-mm-yyyy', autoclose:true });"
		);

		$head = array (
			'head' => $this->head,
			// 'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			// 'js_link' => $js_link
		);

		$nav['menu'] = 'perlengkapan';

		$data = array(
			'id_jenis_pj' => $id_jenis_pj,
			'id_pj' => $id_pj,
			'breadcrumb' => $nama_jenis,
			'dataRiwayat' => $dataRiwayat
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/riwayat',$data);
		$this->load->view('foot',$foot);
	}

	public function simpanRiwayat(){
		$data = $_POST;
		$tgl_riwayat = date('Y-m-d',strtotime($data['tgl_riwayat']));
		unset($data['tgl_riwayat']);
		$data['tgl_riwayat'] = $tgl_riwayat;
		$data['id_user'] = $this->session->userdata('id_user');
		$save = $this->MasterData->inputData($data,'tbl_riwayat_perbaikan');
		if ($save) {
			$sess['alert'] = alert_success('Data riwayat perlengkapan jalan berhasil disimpan.');
			$this->session->set_flashdata($sess);
			redirect('Admin/riwayatPj/'.encode($data['id_pj']).'/'.encode($data['id_jenis_pj']));
		} else {
			$sess['alert'] = alert_failed('Data riwayat perlengkapan jalan gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect('Admin/riwayatPj/'.encode($data['id_pj']).'/'.encode($data['id_jenis_pj']));
		}
	}

	public function deleteRiwayat(){
		$data = $_POST;

		$where = "id_riwayat=".$data['id_riwayat'];
		$delete = $this->MasterData->deleteData($where,'tbl_riwayat_perbaikan');

		if ($delete) {
			$url = base_url('Admin/riwayatPj/'.encode($data['id_pj']).'/'.encode($data['id_jenis_pj']));
			echo $url;
			$sess['alert'] = alert_success('Data riwayat perlengkapan jalan berhasil dihapus.');
			$this->session->set_flashdata($sess);
		} else {
			$url = base_url('Admin/riwayatPj/'.encode($data['id_pj']).'/'.encode($data['id_jenis_pj']));
			echo $url;
			$sess['alert'] = alert_failed('Data riwayat perlengkapan jalan gagal dihapus.');
			$this->session->set_flashdata($sess);
		}
	}

	public function getDataRiwayat(){
		$id = $this->input->post('id_riwayat');

		$where = 'id_riwayat='.$id;
		
		$result = $this->MasterData->getDataWhere('tbl_riwayat_perbaikan',$where)->row();

		$a = $result->tgl_riwayat;

		$date = date('d-m-Y', strtotime($a));

		$result->tanggal = $date;
		
		echo json_encode($result);
	}

	// =====================================================

	public function laporan($id='',$tahun='',$kec='',$ruas='',$kondisi='',$jenis='all') {
		if ($id == '') {
			$id_jenis_pj = '1';
		} else {
			$id_jenis_pj = decode($id);
		}

		if (decode($tahun)!='all') {
			$select_thn_pj = decode($tahun);
		} else {
			$select_thn_pj = '%';
		}

		if (decode($kec)!='all') {
			$select_kode_kecamatan = decode($kec);
		} else {
			$select_kode_kecamatan = '%';
		}

		if (decode($ruas)!='all') {
			$select_id_jalan = decode($ruas);
		} else {
			$select_id_jalan = '%';
		}

		if (decode($kondisi)!='all') {
			$select_kondisi_pj = decode($kondisi);
		} else {
			$select_kondisi_pj = '%';
		}

		if (decode($jenis)!='all') {
			$select_jenis = decode($jenis);
		} else {
			$select_jenis = '%';
		}
			
		$jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();	
		$dataKec = $this->MasterData->getData('tbl_kecamatan')->result();	
		$dataRuasJln = $this->MasterData->getData('tbl_jalan')->result();	
		$jenisLampu = $this->MasterData->getData('tbl_jenis_lampu')->result();	
		$jenisRambu = $this->MasterData->getData('tbl_jenis_rambu')->result();			

		$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";
		$this->head[] = "assets/assets/plugins/dropify/dist/css/dropify.min.css";

		$css_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css"
		);

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		$this->foot[] = "assets/assets/plugins/dropify/dist/js/dropify.min.js";

		$js_link = array(
			"https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"
		);

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2({dropdownCssClass : 'bigdrop'});",
			"$('.dropify').dropify({
				 messages: {
	                default: '<center>Upload foto/gambar disini.</center>',
	                error: '<center>Maksimal ukuran file 500 KB.</center>',
	            }
			});"
	        // "$('.selectpicker').selectpicker();"
		);

		// ====================================================
		$table = 'tbl_jenis_pj';
		$where = "id_jenis = '$id_jenis_pj'";
		$pj = $this->MasterData->getDataWhere($table,$where);
		$getTbl = $pj->row()->nama_tbl;
		$icon = $pj->row()->icon_jenis;

		$where = "
				pj.thn_pj like '%$select_thn_pj%' and
				pj.kode_kecamatan like '%$select_kode_kecamatan%' and 
				pj.id_jalan like '%$select_id_jalan%' and
				pj.kondisi_pj like '%$select_kondisi_pj%'
			";

		if ($getTbl == 'tbl_pj_lampu_jalan') {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_lampu FROM tbl_jenis_lampu jns WHERE jns.id_jenis_lampu = pj.id_jenis_lampu) jenis_lampu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan',
				"(SELECT pln.nama_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) meteran_listrik"
			);
			$table = "$getTbl pj";
			$where .= " and pj.id_jenis_lampu like '%$select_jenis%'";
			$by = 'pj.id_pj';
			$order = 'DESC';
			// $dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
			$dataLoc = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		} else if ($getTbl == 'tbl_pj_rambu') {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_rambu FROM tbl_jenis_rambu jns WHERE jns.id_jenis_rambu = pj.id_jenis_rambu) jenis_rambu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$where .= " and pj.id_jenis_rambu like '%$select_jenis%'";
			$by = 'pj.id_pj';
			$order = 'DESC';
			// $dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
			$dataLoc = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		} else {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$by = 'pj.id_pj';
			$order = 'DESC';
			// $dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();	
			$dataLoc = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		}

        $tahun_pj = $this->MasterData->getSelectDataOrder('DISTINCT(thn_pj)',$getTbl,'thn_pj','desc')->result();
        $kode_kecamatan = $this->MasterData->getData('tbl_kecamatan')->result();
        $ruas_jalan = $this->MasterData->getData('tbl_jalan')->result();
        $jenis_lampu = $this->MasterData->getData('tbl_jenis_lampu')->result();
        $jenis_rambu = $this->MasterData->getData('tbl_jenis_rambu')->result();
        // var_dump($dataLoc);exit();
        // ===========================================

		$head = array (
			'head' => $this->head,
			'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			'js_link' => $js_link
		);

		$nav['menu'] = 'laporan';

		$data = array(
			'jenisPj' => $jenisPj,
			'idSelectPj' => $id_jenis_pj,
			'dataPj' => $dataLoc,
			'dataKec' => $dataKec,
			'dataRuasJln' => $dataRuasJln,
			'jenis_lampu' => $jenisLampu,
			'jenis_rambu' => $jenisRambu,
			'thn_pj' => $tahun_pj,
			'kode_kecamatan' => $kode_kecamatan,
			'ruas_jalan'=> $ruas_jalan,
			'select_thn_pj' => $select_thn_pj,
			'select_kode_kecamatan' => $select_kode_kecamatan,
			'select_id_jalan' => $select_id_jalan,
			'select_kondisi_pj' => $select_kondisi_pj,
			'select_jenis' => $select_jenis
		);

		if ($getTbl=='tbl_jenis_lampu') {
			$data['jenis_lampu'] = $jenis_lampu;
		} else if ($getTbl == 'jenis_rambu'){
			$data['jenis_rambu'] = $jenis_rambu;
		}

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/laporan',$data);
		$this->load->view('foot',$foot);
	}


	public function printLaporan($id='',$tahun='',$kec='',$ruas='',$kondisi='',$jenis='all'){
		if ($id == '') {
			$id_jenis_pj = '1';
		} else {
			$id_jenis_pj = decode($id);
		}

		if (decode($tahun)!='all') {
			$select_thn_pj = decode($tahun);
		} else {
			$select_thn_pj = '%';
		}

		if (decode($kec)!='all') {
			$select_kode_kecamatan = decode($kec);
		} else {
			$select_kode_kecamatan = '%';
		}

		if (decode($ruas)!='all') {
			$select_id_jalan = decode($ruas);
		} else {
			$select_id_jalan = '%';
		}

		if (decode($kondisi)!='all') {
			$select_kondisi_pj = decode($kondisi);
		} else {
			$select_kondisi_pj = '%';
		}

		if (decode($jenis)!='all') {
			$select_jenis = decode($jenis);
		} else {
			$select_jenis = '%';
		}

		$table = 'tbl_jenis_pj';
		$where = "id_jenis = '$id_jenis_pj'";
		$pj = $this->MasterData->getDataWhere($table,$where);
		$getTbl = $pj->row()->nama_tbl;
		$data['nama_jenis'] = $pj->row()->nama_jenis;
		$data['id_jenis'] = $pj->row()->id_jenis;

		$where = "
				pj.thn_pj like '%$select_thn_pj%' and
				pj.kode_kecamatan like '%$select_kode_kecamatan%' and 
				pj.id_jalan like '%$select_id_jalan%' and
				pj.kondisi_pj like '%$select_kondisi_pj%'
			";

		if ($getTbl == 'tbl_pj_lampu_jalan') {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_lampu FROM tbl_jenis_lampu jns WHERE jns.id_jenis_lampu = pj.id_jenis_lampu) jenis_lampu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan',
				"(SELECT pln.id_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) id_meteran_listrik",
				"(SELECT pln.nama_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) meteran_listrik"
			);
			$table = "$getTbl pj";
			$where .= " and pj.id_jenis_lampu like '%$select_jenis%'";
			$by = 'pj.thn_pj';
			$order = 'DESC';
			// $dataLoc = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
			$data['laporan'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();

			// $idmtrlistrik =array();
			// foreach ($data['laporan'] as $key) {
			// 	array_push($idmtrlistrik, $key->id_meteran_listrik);
			// }
			// $id_meteran_listrik = array_unique($idmtrlistrik);

			// $data['jaringan_listrik'] = array();
			// $table = array('tbl_pj_pln','tbl_jalan', 'tbl_aset', 'tbl_status_jalan', 'tbl_kecamatan' );
			// foreach ($id_meteran_listrik as $key => $value) {
			// 	// echo $value."<br>";
			// 	$where = "tbl_pj_pln.id_jalan=tbl_jalan.id_jalan and tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and tbl_pj_pln.kode_kecamatan=tbl_kecamatan.kode_kecamatan and tbl_pj_pln.id_pj='$value'";
			// 	$electric = $this->MasterData->getDataWhere($table,$where)->result();
			// 	array_push($data['jaringan_listrik'], $electric);
			// }

			// $table = array('tbl_pj_pln','tbl_jalan', 'tbl_aset', 'tbl_status_jalan', 'tbl_kecamatan' );
			// $where = "tbl_pj_pln.id_jalan=tbl_jalan.id_jalan and tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and tbl_pj_pln.kode_kecamatan=tbl_kecamatan.kode_kecamatan";
			// $data['jaringan_listrik'] = $this->MasterData->getDataWhere($table,$where)->result();

			// $select = array(
			// 	"distinct(SELECT pln.id_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) id_meteran_listrik",
			// 	"(SELECT pln.nama_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) nama_pj",
			// 	"(SELECT pln.no_id_pel FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) id_pel",				
			// 	"(SELECT pln.kwh_meter FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) kwh_meter",
			// 	"(SELECT pln.thn_pj FROM tbl_pj_pln pln WHERE pj.id_listrik = pln.id_pj) thn_pj",
			// );
			$where = "
				tbl_pj_pln.thn_pj like '%$select_thn_pj%' and
				tbl_pj_pln.kode_kecamatan like '%$select_kode_kecamatan%' and 
				tbl_pj_pln.id_jalan like '%$select_id_jalan%' and
				tbl_pj_pln.kondisi_pj like '%$select_kondisi_pj%' and
			";
			$table = array('tbl_pj_pln', 'tbl_jalan', 'tbl_status_jalan', 'tbl_kecamatan');
			$where .= "tbl_pj_pln.id_jalan=tbl_jalan.id_jalan and tbl_jalan.id_status_jalan=tbl_status_jalan.id_status_jalan and tbl_pj_pln.kode_kecamatan=tbl_kecamatan.kode_kecamatan";
			$data['jaringan_listrik'] = $this->MasterData->getDataWhere($table,$where)->result();
			
		} else if ($getTbl == 'tbl_pj_rambu') {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jns.jenis_rambu FROM tbl_jenis_rambu jns WHERE jns.id_jenis_rambu = pj.id_jenis_rambu) jenis_rambu',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$where .= " and pj.id_jenis_rambu like '%$select_jenis%'";
			$by = 'pj.thn_pj';
			$order = 'DESC';
			// $data['laporan'] = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();
			$data['laporan'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		} else {
			$select = array(
				'pj.*',
				'(SELECT kec.nama_kecamatan FROM tbl_kecamatan kec WHERE kec.kode_kecamatan = pj.kode_kecamatan) kecamatan',
				'(SELECT jln.nama_jalan FROM tbl_jalan jln WHERE jln.id_jalan = pj.id_jalan) nama_jalan'
			);
			$table = "$getTbl pj";
			$by = 'pj.thn_pj';
			$order = 'DESC';
			// $data['laporan'] = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();	
			$data['laporan'] = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result();
		}

		$data['date'] = date('d F Y');

		// $y =array();
		// for($x = 'A'; $x <= 'ZZ'; $x++){
		// 	$y[] = array($x);
		// }
		// // print_r($y[1]=>$);
		// exit();

		$this->load->library('PhpExcelNew/PHPExcel');

		if ($getTbl == 'tbl_pj_lampu_jalan') {
			$this->load->view('laporan/printLaporanLampu',$data);
		} else {
			$this->load->view('laporan/printLaporan',$data);
		}
	}

	// =====================================================

	public function dataUser($value='') {

		$select = array(
			'usr.*',
			"(SELECT role.role FROM tbl_role role WHERE usr.id_role = role.id_role) role"
		);
		$table = 'tbl_user usr';
		$by = 'usr.id_user';
		$order = 'DESC';
		$dataUser = $this->MasterData->getSelectDataOrder($select,$table,$by,$order)->result();

		$dataRole = $this->MasterData->getData('tbl_role')->result();

		$this->head[] = "assets/assets/plugins/select2/dist/css/select2.css";
		$this->head[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.css";
		$this->head[] = "assets/assets/plugins/sweetalert/sweetalert.css";
		// $this->head[] = "assets/assets/plugins/dropify/dist/css/dropify.min.css";

		$this->foot[] = "assets/assets/plugins/select2/dist/js/select2.full.min.js";
		$this->foot[] = "assets/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/sweetalert.min.js";
		$this->foot[] = "assets/assets/plugins/sweetalert/jquery.sweet-alert.custom.js";
		$this->foot[] = "assets/assets/plugins/datatables/jquery.dataTables.min.js";
		// $this->foot[] = "assets/assets/plugins/dropify/dist/js/dropify.min.js";

		$script = array(
			"$('#myTable').DataTable();",
			"$('.select2').select2();",
			// "$('.dropify').dropify({
			// 	 messages: {
	  //               default: '<center>Upload foto/gambar disini.</center>',
	  //               error: '<center>Maksimal ukuran file 500 KB.</center>',
	  //           }
			// });"
	        // "$('.selectpicker').selectpicker();"
		);

		$head = array (
			'head' => $this->head,
			// 'css_link' => $css_link
		);
		$foot = array(
			'foot' =>  $this->foot,
			'script' => $script,
			// 'js_link' => $js_link
		);

		$nav['menu'] = 'user';

		$data = array(
			'data_user' => $dataUser,
			'data_role' => $dataRole
		);

		$this->load->view('head',$head);
		$this->load->view('Admin/navigation',$nav);
		$this->load->view('Admin/user',$data);
		$this->load->view('foot',$foot);
	}

	public function tambahDataUser($value='') {
		$post = $this->input->POST();

		if ($post) {
			$data = array();
			foreach ($post as $key => $val) {
				if ($key == 'password') {
					$data[$key] = md5($val);
				} else {
					$data[$key] = $val;
				}
			}

			$no_hp = $post['no_hp'];

			$select = 'no_hp';
			$table = 'tbl_user';
			$where = "no_hp = '$no_hp'";
			$cekNoHp = $this->MasterData->getWhereData($select,$table,$where)->num_rows();

			if ($cekNoHp == 0) {

				$inputData = $this->MasterData->inputData($data,$table);

				if ($inputData) {

					$select = 'role';
					$where = "id_role = '$post[id_role]'";
					$namaRole = $this->MasterData->getWhereData($select,'tbl_role',$where)->row()->role;

					$noTelp = $no_hp;
					$pesan = "Akun LPJU APP Anda\nNama User: ".$post['nama_user']."\nUsername: ".$post['username']."\nPassword: ".$post['password']."\n\nAnda terdaftar sebagai ".strtoupper($namaRole);

			        $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
			        $newID = $cekID->Auto_increment;

			        $data = array(
			            'DestinationNumber' => $noTelp,
			            'TextDecoded' => $pesan,
			            'ID' => $newID,
			            'MultiPart' => 'false',
			            'CreatorID' => 'Siyap'
			        );

			        $table = 'outbox';
			        $input_msg = $this->MasterData->sendMsg($data,$table);

					$sess['alert'] = alert_success('Data user berhasil disimpan.');
					$this->session->set_flashdata($sess);
					redirect(base_url().'Admin/dataUser');
				} else {
					$sess['alert'] = alert_failed('Data user gagal disimpan.');
					$this->session->set_flashdata($sess);
					redirect(base_url().'Admin/dataUser');
				}

			} else {
				$sess['alert'] = alert_failed('Nomor HP sudah terdaftar.');
				$this->session->set_flashdata($sess);
				redirect(base_url().'Admin/dataUser');
			}

		} else {
			$sess['alert'] = alert_failed('Data user gagal disimpan.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/dataUser');
		}
	}

	public function updateDataUser($value='') {
		$post = $this->input->POST();

		if ($post) {
			$data = array();
			$newPass = '';
			foreach ($post as $key => $val) {
				if ($key == 'password') {
					if ($val != '' || $val != null) {
						$data[$key] = md5($val);
						$newPass = $val;
					} else {
						$newPass = 'Tidak berubah';
					}
				} else {
					if ($key != 'id_user') {
						$data[$key] = $val;
					}
				}
			}

			$no_hp = $post['no_hp'];

			$select = 'no_hp';
			$table = 'tbl_user';
			$where = "id_user = '$post[id_user]'";
			$cekNoHpOld = $this->MasterData->getWhereData($select,$table,$where)->row()->no_hp;

			if ($no_hp == $cekNoHpOld) {

				$where = "id_user = '$post[id_user]'";
				$updateData = $this->MasterData->editData($where,$data,$table);

				if ($updateData) {

					$select = 'role';
					$where = "id_role = '$post[id_role]'";
					$namaRole = $this->MasterData->getWhereData($select,'tbl_role',$where)->row()->role;

					$noTelp = $no_hp;
					$pesan = "Akun LPJU APP Anda\nNama User: ".$post['nama_user']."\nUsername: ".$post['username']."\nPassword: ".$newPass."\n\nAnda terdaftar sebagai ".strtoupper($namaRole);

			        $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
			        $newID = $cekID->Auto_increment;

			        $data = array(
			            'DestinationNumber' => $noTelp,
			            'TextDecoded' => $pesan,
			            'ID' => $newID,
			            'MultiPart' => 'false',
			            'CreatorID' => 'Siyap'
			        );

			        $table = 'outbox';
			        $input_msg = $this->MasterData->sendMsg($data,$table);

					$sess['alert'] = alert_success('Data user berhasil diupdate.');
					$this->session->set_flashdata($sess);
					redirect(base_url().'Admin/dataUser');
				} else {
					$sess['alert'] = alert_failed('Data user gagal diupdate.');
					$this->session->set_flashdata($sess);
					redirect(base_url().'Admin/dataUser');
				}
			} else {
				$where = "no_hp = '$no_hp'";
				$cekNoHp = $this->MasterData->getWhereData($select,$table,$where)->num_rows();

				if ($cekNoHp == 0) {

					$where = "id_user = '$post[id_user]'";
					$updateData = $this->MasterData->editData($where,$data,$table);

					if ($updateData) {

						$select = 'role';
						$where = "id_role = '$post[id_role]'";
						$namaRole = $this->MasterData->getWhereData($select,'tbl_role',$where)->row()->role;

						$noTelp = $no_hp;
						$pesan = "Akun LPJU APP Anda\nNama User: ".$post['nama_user']."\nUsername: ".$post['username']."\nPassword: ".$newPass."\n\nAnda terdaftar sebagai ".strtoupper($namaRole);

				        $cekID = $this->sms->query("SHOW TABLE STATUS LIKE 'outbox'")->row();
				        $newID = $cekID->Auto_increment;

				        $data = array(
				            'DestinationNumber' => $noTelp,
				            'TextDecoded' => $pesan,
				            'ID' => $newID,
				            'MultiPart' => 'false',
				            'CreatorID' => 'Siyap'
				        );

				        $table = 'outbox';
				        $input_msg = $this->MasterData->sendMsg($data,$table);

						$sess['alert'] = alert_success('Data user berhasil diupdate.');
						$this->session->set_flashdata($sess);
						redirect(base_url().'Admin/dataUser');
					} else {
						$sess['alert'] = alert_failed('Data user gagal diupdate.');
						$this->session->set_flashdata($sess);
						redirect(base_url().'Admin/dataUser');
					}

				} else {
					$sess['alert'] = alert_failed('Nomor HP sudah terdaftar.');
					$this->session->set_flashdata($sess);
					redirect(base_url().'Admin/dataUser');
				}

				
			}

		} else {
			$sess['alert'] = alert_failed('Data user gagal diupdate.');
			$this->session->set_flashdata($sess);
			redirect(base_url().'Admin/dataUser');
		}
	}

	public function deleteDataUser($value='') {
		$id = $this->input->POST('id');

		$where = "id_user = '$id'";
		$table = 'tbl_user';
		$delete = $this->MasterData->deleteData($where,$table);

		if ($delete) {
			$where = "id_user = '$id'";
			// $table = 'tbl_riwayat_perbaikan';
			// $delRiwayat = $this->MasterData->deleteData($where,$table);

			$table = 'tbl_riwayat_input_pj';
			$dataInputPj = $this->MasterData->getDataWhere($table,$where)->result();

			foreach ($dataInputPj as $key) {
				$idJenis = $key->id_jenis_pj;
				$idPj = $key->id_pj;

				$where = "id_jenis='$idJenis'";
				$table = $this->MasterData->getDataWhere('tbl_jenis_pj',$where)->row()->nama_tbl;

				$where = "id_pj = '$idPj'";
				$delPj = $this->MasterData->deleteData($where,$table);

				$data_pic = $this->MasterData->getDataWhere($table,$where)->row()->foto_pj;
				$data_pic = explode(';', $data_pic);

				foreach ($data_pic as $key) {
					if (file_exists(APPPATH.'../assets/path_foto/'.$key)) {
						unlink(APPPATH.'../assets/path_foto/'.$key);
					}
				}
			}

			$where = "id_user = '$id'";
			$table = 'tbl_riwayat_input_pj';
			$delInputPj = $this->MasterData->deleteData($where,$table);

			if ($delInputPj) {
				echo "Success";
				$sess['alert'] = alert_success('Data user berhasil dihapus.');
				$this->session->set_flashdata($sess);
			} else {
				echo "Failed";
				$sess['alert'] = alert_failed('Data user gagal dihapus.');
				$this->session->set_flashdata($sess);
				// redirect(base_url().'Admin/ruasJalan');
			}
		} else {
			echo "Failed";
			$sess['alert'] = alert_failed('Data user gagal dihapus.');
			$this->session->set_flashdata($sess);
			// redirect(base_url().'Admin/ruasJalan');
		}
	}

	// =========================================================

	public function getTitikRuasJalan($value='') {
		$data = $this->MasterData->getData('tbl_temp_jalan')->result();

		if ($data) {
			$result = array(
				'response' => true,
				'data' => $data
			);
		} else {
			$result = array(
				'response' => false
			);
		}

		echo json_encode($result);
	}

	public function hapusTitikRuasJalan($value='') {
		$id = $this->input->POST('id');

	    $where = "id_temp = '$id'";
	    $delete = $this->MasterData->deleteData($where,'tbl_temp_jalan');

	    if ($delete) {
	        $result = array(
	          'response' => true
	        );
	    } else {
	        $result = array(
	          'response' => false
	        );
	    }

	    echo json_encode($result);
	}
}

