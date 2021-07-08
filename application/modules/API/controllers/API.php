<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');
// header('Accept: application/json');
// include_once(APPPATH.'libraries/REST_Controller.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	function __construct() {

		parent::__construct();

	    $this->load->model('MasterData');

	}

    //auth

    public function ApiLogin() {
        if(isset($_GET['username']) && isset($_GET['password'])){
          //$idUser = $_GET['idUser'];
          $username = $_GET['username'];
          $password = md5($_GET['password']);
          $user = $this->db->query("SELECT usr.*, (SELECT role.role FROM tbl_role role WHERE usr.id_role=role.id_role) role FROM tbl_user usr WHERE  username like '$username' AND password = '$password' ")->row();
          if($user != null){
                $result = array(
                  'response' => 1,
                  'id_user' => $user->id_user,
                  'nama_user' => strtoupper($user->nama_user),
                  'username' => $user->username,
                  'id_role' => $user->id_role,
                  'role' => $user->role
                );
          }else{
              $result = array('response' => 0);
          }

          echo '{"Data_User": ' . json_encode(array($result)) . '}';
           
        } 
    }

    public function simpanData($id=1, $idUser=''){

    	if ($this->input->POST()) {

    		$input = $this->input->POST();
	    	// $date = date('Y', strtotime($input['thn_pj']));
	    	$table = 'tbl_jenis_pj';
	    	$where = "id_jenis = $id";
	    	$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

	    	$dataKet = array();
	    	$dataInput = array();
	    	foreach ($input as $key => $val) {
	    		if ($key == 'thn_pj') {
	    			if ($val == '' || $val == 'null') {
	    				$dataInput[$key] = '';
	    			}else{
	    				$dataInput[$key] = date('Y', strtotime($val));
	    			}
	    		} else if ($key == 'ket_riwayat') {
	    			if ($val == '' || $val == 'null') {
	    				$dataKet[$key] = 'Tidak ada keterangan';
	    			}else{
	    				$dataKet[$key] = $val;
	    			}
	    		} else {
		    		$dataInput[$key] = $val;
	    		}
	    	}

	    	$table = $getTbl;
	    	$inputData = $this->MasterData->inputData($dataInput, $table);

	    	if ($inputData) {

	    		$id_pj = $this->db->insert_id();

	    		$dataKet['id_jenis_pj'] = $id;
	    		$dataKet['id_pj'] = $id_pj;
	    		$dataKet['id_user'] = $idUser;
	    		$dataKet['tgl_riwayat'] = date('Y-m-d');

	    		$table = 'tbl_riwayat_perbaikan';
	    		$inputRiwayatPerbaikan = $this->MasterData->inputData($dataKet, $table);

	    		$data = array(
	    			'id_user' => $idUser,
	    			'id_jenis_pj' => $id,
	    			'id_pj' => $id_pj,
	    			'tgl_input' => date('Y-m-d')
	    		);
	    		$table = 'tbl_riwayat_input_pj';
	    		$inputRiwayat = $this->MasterData->inputData($data, $table);

	    		if ($inputRiwayat && $inputRiwayatPerbaikan) {
		    		$data = ['success' => true, 'data' => $input];
	    		} else {
	    			$data = ['success' => false, 'data' => $input];
	    		}

	    	} else {
	    		$data = ['success' => false, 'data' => $input];
	    	}

    	} else {
	    	$data = ['success' => false, 'data' => $id];
    	}
    	echo json_encode($data);
    }

    public function simpanFile($value=''){
      $input = $this->input->POST();

      $config['upload_path']    = './assets/path_foto';
      $config['allowed_types']  = 'jpg|png|jpeg';
      $config['max_size']       = 100000;
      $config['overwrite']      = true;
      // $config['file_name']      = 'Photo';
      // $config['space_remove']      = true;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      // $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
   
      $this->load->library('upload', $config);

      // if ($this->input->POST()) {
        $file_name = null;
        if ($this->upload->do_upload('file')){
          header('Content-type: application/json');

          $data_file = $this->upload->data();
          $file_name = $data_file['file_name'];
          // header('Content-type: application/json');
          $data = ['success' => true, 'message' => 'Upload and move success', 'file_name' => $file_name];
          echo json_encode( $data );

          // $data = array(
          //   'nama_kategori' => $input['nama_kategori'],
          //   'skpd' => $input['skpd'],
          //   'gambar' => $data_file['file_name'],
          //   'tampil' => $input['tampil']
          // );
          // $input_kategori = $this->MasterData->inputData($data,'kategori');

          // if ($input_kategori) {
            
          // }else{
            
          // }
        }else{
          header('Content-type: application/json');

          $data = ['success' => false, 'message' => 'There was an error uploading the file, please try again!', 'file_name' => $file_name];
          echo json_encode( $data );
        }
      // }

    }

    public function getKecamatan($value='') {

    	$table = "tbl_kecamatan";
    	$kecamatan = $this->MasterData->getData($table)->result();
    	if ($kecamatan != null) {
    		$result = array('response' => $kecamatan);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function getSumberDana($value='') {

      $table = "tbl_sumber_dana";
      $sumberDana = $this->MasterData->getData($table)->result();
      if ($sumberDana != null) {
        $result = array('response' => $sumberDana);
      }else{
        $result = array('response' => 0);
      }

      echo json_encode($result);
    }

    public function getAset($value='') {

      $table = "tbl_aset";
      $dataAset = $this->MasterData->getData($table)->result();
      if ($dataAset != null) {
        $result = array('response' => $dataAset);
      }else{
        $result = array('response' => 0);
      }

      echo json_encode($result);
    }

    public function getJenisTiang($value='') {

      $table = "tbl_jenis_tiang";
      $jenisTiang = $this->MasterData->getData($table)->result();
      if ($jenisTiang != null) {
        $result = array('response' => $jenisTiang);
      }else{
        $result = array('response' => 0);
      }

      echo json_encode($result);
    }

    public function getJalan($value='') {

     	if ($this->input->POST('index') != null || $this->input->POST('index') != '') {
     		$index = $this->input->POST('index');
     	}else{
     		$index = 0;
     	}

     	if ($this->input->POST('limit') != null || $this->input->POST('limit') != '') {
     		$limit = $this->input->POST('limit');
     	}else{
     		$limit = 10;
     	}

     	if ($this->input->POST('jalan') != null || $this->input->POST('jalan') != '') {
     		$jalan = $this->input->POST('jalan');
     		$where = "nama_jalan like '%$jalan%'";
     	}else{
     		$where = "";
     	}

    	$table = "tbl_jalan";
    	$select = "*";
    	
    	$order = 'ASC';
  		$by = 'id_jalan';
    	$jalan = $this->MasterData->getWhereDataLimitIndexOrder($select,$table,$where,$index,$limit,$by,$order)->result();
    	// $jmlData = $this->MasterData->getData($table)->num_rows();
    	if ($jalan != null) {
    		$result = array(
    			'response' => 1,
    			// 'jml_data' => $jmlData,
    			'data' => $jalan
    		);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function getListrik($value='') {

      if ($this->input->POST('index') != null || $this->input->POST('index') != '') {
        $index = $this->input->POST('index');
      }else{
        $index = 0;
      }

      if ($this->input->POST('limit') != null || $this->input->POST('limit') != '') {
        $limit = $this->input->POST('limit');
      }else{
        $limit = 10;
      }

      if ($this->input->POST('jaringan') != null || $this->input->POST('jaringan') != '') {
        $jaringan = $this->input->POST('jaringan');
        $where = "nama_pj like '%$jaringan%'";
      }else{
        $where = "nama_pj like '%%%'";
      }

      $table = "tbl_pj_pln";
      $select = "*";
      
      $order = 'ASC';
      $by = 'id_jalan';
      $jalan = $this->MasterData->getWhereDataLimitIndexOrder($select,$table,$where,$index,$limit,$by,$order)->result();
      // $jmlData = $this->MasterData->getData($table)->num_rows();
      if ($jalan != null) {
        $result = array(
          'response' => 1,
          // 'jml_data' => $jmlData,
          'data' => $jalan
        );
      }else{
        $result = array('response' => 0);
      }

      echo json_encode($result);
    }

    public function getJenisRambu($value='') {

    	$table = "tbl_jenis_rambu";
    	$rambu = $this->MasterData->getData($table)->result();
    	if ($rambu != null) {
    		$result = array('response' => $rambu);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function getJenisLampu($value='') {

    	$table = "tbl_jenis_lampu";
    	$lampu = $this->MasterData->getData($table)->result();
    	if ($lampu != null) {
    		$result = array('response' => $lampu);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function getDataList($value='') {
    	$id = $this->input->POST('id');
    	$table = 'tbl_jenis_pj';
  		$where = "id_jenis = '$id'";
  		$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

     	if ($this->input->POST('index') != null || $this->input->POST('index') != '') {
     		$index = $this->input->POST('index');
     	}else{
     		$index = 0;
     	}

     	if ($this->input->POST('limit') != null || $this->input->POST('limit') != '') {
     		$limit = $this->input->POST('limit');
     	}else{
     		$limit = 10;
     	}

     	$id_user = $this->input->POST('id_user');
     	$where = "jln.id_jalan = pj.id_jalan AND pj.id_pj IN (SELECT id_pj FROM tbl_riwayat_input_pj rwt WHERE rwt.id_user = $id_user AND rwt.id_jenis_pj = '$id')";

     	if ($this->input->POST('cari') != null || $this->input->POST('cari') != '') {
     		$cari = $this->input->POST('cari');
     		$where .= " AND pj.nama_pj like '%$cari%'";
     	}
     	// else{
     	// 	$where = "";
     	// }

    	$table = array(
    		'tbl_jalan jln',
    		"$getTbl pj"
    	);
    	$select = "pj.*, jln.nama_jalan, (SELECT DATE_FORMAT(input.tgl_input, '%d-%m-%Y') FROM tbl_riwayat_input_pj input WHERE input.id_jenis_pj = $id AND input.id_pj = pj.id_pj) tgl_input";
    	
    	$order = 'DESC';
  		$by = 'pj.id_pj';
    	$dataList = $this->MasterData->getWhereDataLimitIndexOrder($select,$table,$where,$index,$limit,$by,$order)->result();

    	// SELECT DATE_FORMAT(tgl_input, '%d-%m-%Y') FROM `tbl_riwayat_input_pj` WHERE id_jenis_pj = 1 GROUP BY tgl_input
    	// $jmlData = $this->MasterData->getData($table)->num_rows();
    	if ($dataList != null) {
    		$result = array(
    			'response' => 1,
    			// 'jml_data' => $jmlData,
    			'data' => $dataList
    		);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function deleteDataList($value='') {
    	$id_pj = $this->input->POST('id_pj');
    	$id_jenis_pj = $this->input->POST('id_jenis_pj');

    	$table = 'tbl_jenis_pj';
  		$where = "id_jenis = '$id_jenis_pj'";
  		$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

  		// ================================================================
    	$where = "id_pj = '$id_pj'";
    	$table = $getTbl;
    	$cekData = $this->MasterData->getDataWhere($table,$where);
    	$jmlData = $cekData->num_rows();
    	if ($jmlData > 0) {
  			if ($cekData->row()->foto_pj != '' || $cekData->row()->foto_pj != null) {
  				$files = $cekData->row()->foto_pj;
  				$nameFile = explode(';', $files);

  				foreach ($nameFile as $keyx) {
  					unlink(APPPATH.'../assets/path_foto/'.$keyx);
  				}
  			}
  		}
  		// ===============================================================

    	$table = $getTbl;
    	$where = "id_pj = '$id_pj'";
    	$hapusPj = $this->MasterData->deleteData($where,$table);

    	if ($hapusPj) {
    		$table = 'tbl_riwayat_input_pj';
	    	$where = "id_pj = '$id_pj' AND id_jenis_pj = '$id_jenis_pj'";
	    	$hapusRiwayatPj = $this->MasterData->deleteData($where,$table);

	    	if ($hapusRiwayatPj) {
	    		$table = 'tbl_riwayat_perbaikan';
		    	$hapusRiwayatPerbaikan = $this->MasterData->deleteData($where,$table);

		    	if ($hapusRiwayatPerbaikan) {
		    		$result = array('response' => 1);
		    	} else {
		    		$result = array('response' => 0);
		    	}
	    	} else {
	    		$result = array('response' => 0);
	    	}
    	} else {
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function getEditData($value='') {
    	$id_pj = $this->input->POST('id_pj');
    	$id_jenis_pj = $this->input->POST('id_jenis_pj');

    	$table = 'tbl_jenis_pj';
  		$where = "id_jenis = '$id_jenis_pj'";
  		$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

  		$select = array(
        'pj.*', 
        'jln.nama_jalan'
      );
      if ($id_jenis_pj == 1) {
        $select[] = "(SELECT pln.nama_pj FROM tbl_pj_pln pln WHERE pln.id_pj = pj.id_listrik) jaringan_listrik";
      }
  		$table = array(
  			"$getTbl pj",
  			'tbl_jalan jln'
  		);
  		$where = "pj.id_pj = '$id_pj' AND pj.id_jalan = jln.id_jalan";
  		$dataList = $this->MasterData->getWhereData($select,$table,$where)->row();

     	
    	if ($dataList != null) {
    		$result = array(
    			'response' => 1,
    			'data' => $dataList
    		);
    	}else{
    		$result = array('response' => 0);
    	}

    	echo json_encode($result);
    }

    public function updateData($id_jenis_pj=1, $id_pj='') {

    	if ($this->input->POST()) {

    		$input = $this->input->POST();
	    	// $date = date('Y', strtotime($input['thn_pj']));
	    	$table = 'tbl_jenis_pj';
	    	$where = "id_jenis = $id_jenis_pj";
	    	$getTbl = $this->MasterData->getDataWhere($table,$where)->row()->nama_tbl;

	    	$dataKet = array();
	    	$dataInput = array();
	    	foreach ($input as $key => $val) {
	    		if ($key == 'thn_pj') {
	    			if ( count($val) > 4 ) {
	    				$dataInput[$key] = date('Y', strtotime($val));
	    			} else {
	    				$dataInput[$key] = $val;
	    			}
		    		
	    		} else if ($key == 'ket_riwayat') {
	    			if ($val == '' || $val == 'null') {
	    				$dataKet[$key] = 'Tidak ada keterangan';
	    			}else{
	    				$dataKet[$key] = $val;
	    			}
	    		} else {
	    			if ($key != 'id_pj') {
			    		$dataInput[$key] = $val;
	    			}
	    		}
	    	}

	    	// ================================================================
	    	$oldFile = $this->input->POST('foto_pj');
	    	$oldFiles = explode(';', $oldFile);

	    	$where = "id_pj = '$id_pj'";
	    	$table = $getTbl;
	    	$cekData = $this->MasterData->getDataWhere($table,$where);
	    	$jmlData = $cekData->num_rows();
	    	if ($jmlData > 0) {
				if ($cekData->row()->foto_pj != '' || $cekData->row()->foto_pj != null) {
					$files = $cekData->row()->foto_pj;
					$nameFile = explode(';', $files);

					foreach ($nameFile as $keyx) {
						$cek = 0;
						foreach ($oldFiles as $key) {
							if ($key == $keyx) {
								$cek++;
							}
						}

						if ($cek == 0) {
							unlink(APPPATH.'../assets/path_foto/'.$keyx);
						}
					}
				}
			}
			// ===============================================================

	    	$table = $getTbl;
	    	$data = $dataInput;
	    	$where = "id_pj = '$id_pj'";
	    	$updateData = $this->MasterData->editData($where,$data,$table);

	    	if ($updateData) {
	    		$datas = ['success' => true, 'data' => $input];
	    	} else {
	    		$datas = ['success' => false, 'data' => $input];
	    	}

    	} else {
	    	$datas = ['success' => false, 'data' => $id];
    	}

    	echo json_encode($datas);
    }

    public function getPositionMarker($value='') {
      $id = $this->input->POST('id');

      $table = 'tbl_jenis_pj';
      $where = "id_jenis = '$id'";
      $pj = $this->MasterData->getDataWhere($table,$where);
      $getTbl = $pj->row()->nama_tbl;
      $icon = $pj->row()->icon_jenis;

      $table = "$getTbl";
      $dataLoc = $this->MasterData->getData($table)->result();  

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
              'pic' => $loc->foto_pj
            );
        }

        $result = array(
          'response' => true,
          'data' => $locArr,
          'icon' => $icon
        );
      } else {
        $result = array(
          'response' => false
        );
      }

      echo json_encode($result);
    }

    public function changePassword($value='') {
      $post = $this->input->POST();
      $id_user = $post['id_user'];
      $oldPass = md5($post['oldPass']);
      $newPass = md5($post['newPass']);

      $select = 'password';
      $table = 'tbl_user';
      $where = "id_user = '$id_user'";
      $cekPass = $this->MasterData->getWhereData($select,$table,$where)->row()->password;

      if ($cekPass == $oldPass) {
        
        $data = array(
          'password' => $newPass
        );
        $cp = $this->MasterData->editData($where,$data,$table);

        if ($cp) {
          $result = array(
            'response' => true,
            'data' => 'Password berhasil diubah!'
          );
        } else {
          $result = array(
            'response' => false,
            'data' => 'Gagal ubah password!'
          );
        }
      } else {
        $result = array(
          'response' => false,
          'data' => 'Password lama salah!'
        );
      }

      echo json_encode($result);
    }

    public function getDataInfo($value='') {
      $id = $this->input->POST('id_user');

      $jenisPj = $this->MasterData->getData('tbl_jenis_pj')->result();

      if ($jenisPj) { 

        $dataInfo = array();
        foreach ($jenisPj as $jenis) {
          $table = $jenis->nama_tbl;
          $pj = $this->MasterData->getData($table);

          $where = array(
            'id_user' => $id,
            'id_jenis_pj' => $jenis->id_jenis
          );
          $jmlInput = $this->MasterData->getDataWhere('tbl_riwayat_input_pj', $where)->num_rows();

          $dataInfo[] = array(
            'title' => ucwords($jenis->nama_jenis),
            'img' => $jenis->icon_jenis,
            'jmlAll' => $pj->num_rows(),
            'jml' => $jmlInput
          );
        }

        $result = array(
          'response' => true,
          'data' => $dataInfo
        );

      } else {
        $result = array(
          'response' => false
        );
      }


      echo json_encode($result);
    }

    public function getDataVersionApp($value='') {
      $data = $this->MasterData->getData('tbl_update_app')->result();

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

    public function simpanTempJalan($value='') {
      $data = $this->input->POST();

      if ($data) { 
        $inputTemp = $this->MasterData->inputData($data,'tbl_temp_jalan');

        if ($inputTemp) {
          $result = array(
            'response' => true,
            'data' => 'Titik ruas jalan berhasil disimpan!'
          );
        } else {
          $result = array(
            'response' => false,
            'data' => 'Titik ruas jalan gagal disimpan!'
          );
        }
      } else {
        $result = array(
          'response' => false,
          'data' => 'Titik ruas jalan gagal disimpan!'
        );
      }

      echo json_encode($result);
    }

    public function getDataListTemp($value='') {
      $input = $this->input->POST();

      if ($input) {
        $id_user = $input['id_user'];
        $where = "id_user = '$id_user'";
        $dataList = $this->MasterData->getDataWhere('tbl_temp_jalan',$where)->result();

        if ($dataList) {
          $result = array(
            'response' => true,
            'data' => $dataList
          );
        } else {
          $result = array(
            'response' => false
          );
        }
      } else {
        $result = array(
          'response' => false
        );
      }

      echo json_encode($result);
    }

    public function deleteDataListTemp($value='') {
      $id = $this->input->POST('id_temp');

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

    public function getEditDataJalan($value='') {
      $id = $this->input->POST('id_temp');
      $where = "id_temp = '$id'";
      $data = $this->MasterData->getDataWhere('tbl_temp_jalan',$where)->row();

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

    public function updateTempJalan($value='') {
      $data = $this->input->POST();

      if ($data) { 
        $id_temp = $data['id_temp'];
        $datas = array(
          'nama_temp' => $data['nama_temp'],
          'koordinat_awal' => $data['koordinat_awal'],
          'koordinat_akhir' => $data['koordinat_akhir']
        );
        $where = "id_temp = '$id_temp'";
        $updateTemp = $this->MasterData->editData($where,$datas,'tbl_temp_jalan');

        if ($updateTemp) {
          $result = array(
            'response' => true,
            'data' => 'Titik ruas jalan berhasil disimpan!'
          );
        } else {
          $result = array(
            'response' => false,
            'data' => 'Titik ruas jalan gagal disimpan!'
          );
        }
      } else {
        $result = array(
          'response' => false,
          'data' => 'Titik ruas jalan gagal disimpan!'
        );
      }

      echo json_encode($result);
    }
}

