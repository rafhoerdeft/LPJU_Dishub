<?php

// SELECT surat.id_surat,surat.dari,surat.no_surat,surat.perihal,surat.tanggal_surat,surat.tanggal_diterima, terdisposisi.path_file,surat.jenis,surat.status,surat.id_typesurat,terdisposisi.id_disposisi, terdisposisi.disposisi, terdisposisi.kepada,terdisposisi.waktu as waktu_disposisi,surat.status_kirim_bupati from terdisposisi JOIN surat on terdisposisi.id_surat = surat.id_surat

// CREATE VIEW v_surat_acc as SELECT surat.id_surat,surat.dari,surat.no_surat,surat.perihal,surat.tanggal_surat,surat.tanggal_diterima, terdisposisi.path_file,file_acc.file_path_acc,file_acc.jenis_acc,surat.jenis,surat.status,surat.id_typesurat,terdisposisi.id_disposisi, terdisposisi.disposisi, terdisposisi.kepada,terdisposisi.waktu as waktu_disposisi,surat.status_kirim_bupati from file_acc JOIN surat on file_acc.id_surat = surat.id_surat JOIN terdisposisi on terdisposisi.id_surat = surat.id_surat

// SELECT surat.*, (SELECT COUNT(*) FROM file_acc WHERE surat.id_surat = file_acc.id_surat AND file_acc.jenis_acc = 'TU Asisten') AS status_acc FROM surat WHERE jenis = 'Nota Dinas' ORDER BY tanggal_surat DESC

// SELECT surat.*, (SELECT COUNT(*) FROM file_acc WHERE surat.id_surat = file_acc.id_surat AND file_acc.jenis_acc = 'Asisten Umum') AS status_acc FROM surat WHERE jenis = 'Nota Dinas' ORDER BY tanggal_surat DESC
include_once(APPPATH.'libraries/REST_Controller.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_surat extends MX_Controller {

	function __construct() {

		parent::__construct();

        $this->load->model('MasterData');

	}



    //auth

        public function login($type='post') {

            $password = md5($this->input->post('password'));

            $username = $this->input->post('username');

            $return=0;

            if ($password!=''&&$username!='') {

                $selectUser =  $this->db->get_where('user',  array('username' => $username, 'password' => $password ))->result_array();

                foreach($selectUser as $row){$idTypeUser=$row['idTypeUser'];$idUser=$row['id'];}

                if (isset($idTypeUser)) {

                    if($idTypeUser==1){

                        $return=$idUser;

                    }

                    else {

                        $return=0;

                    }

                }

            } else {

                $return=0;

            }

            

            echo $return;

        }

        // INSERT INTO `surat`(`id`, `dari`, `no_surat`, `perihal`, `tanggal_surat`, `tanggal_diterima`, `no_agenda`, `path_file`, `jenis`, `status`, `idTypeSurat`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])

        // $dataDusun = array('dusun' => $dusun,'idDesa' => $idDesa_db);

        //                             $this->db->insert('dusun', $dataDusun);

    //surat'

//===========================Change Status========================
    public function rubahStatus()
    {
        $id_surat = $this->input->post('id_surat');
        $type = $this->input->post("type");
        $status = 'Dilihat '.$type;

        $response = array();
        if($id_surat != null || $id_surat != "")
        {
            $response = array('response' => 1 );
            $query = $this->db->query("UPDATE surat SET status ='$status' WHERE id_surat = '$id_surat'");
            json_encode($query);    
            echo json_encode($response);
        }
        else
        {
            $response = array('response' => 0 );
            echo json_encode($response);   
        }
        
    }
//==========================For Bupati===========================
    public function readSurat() {

        $id_typesurat = $this->input->get('id_typesurat');
        $id_typeuser_surat = $this->input->get('id_typeuser_surat');
        $letter = $this->db->query("SELECT * FROM surat WHERE id_typesurat = '$id_typesurat' 
        							AND id_typeuser_surat = '$id_typeuser_surat' AND jenis = 'Surat' ORDER BY tanggal_surat DESC")->result();
        echo json_encode($letter);
    }

    public function readNotaDinas() {

        $id_typesurat = $this->input->get('id_typesurat');
        $id_typeuser_surat = $this->input->get('id_typeuser_surat');
        $id_typeuser_tujuan = $this->input->get('id_typeuser_tujuan');
        $letter = $this->db->query("SELECT * FROM v_surat_acc WHERE id_typesurat = '$id_typesurat' AND jenis = 'Nota Dinas' AND
        							id_typeuser_tujuan = '$id_typeuser_tujuan' AND id_typeuser_surat = '$id_typeuser_surat'
        							ORDER BY tanggal_surat DESC")->result();
        echo json_encode($letter);
    }
//======================================================================

//================================for TU===================================
    public function readAcc() {

        $type = $this->input->get('type'); //Type user
        $letter = $this->db->query("SELECT * FROM v_surat_acc WHERE jenis_acc = '$type' ORDER BY tanggal_surat DESC")->result();
        echo json_encode($letter);
    }


    public function readNotaDinas_TU_Asisten() {

        $id_typesurat = $this->input->get('id_typesurat');
        $id_typeuser_surat = $this->input->get('id_typeuser_surat');
        $jenis_acc = $this->input->get('jenis_acc');
        $letter = $this->db->query("SELECT * FROM surat WHERE id_typesurat = '$id_typesurat' 
        							AND id_typeuser_surat = '$id_typeuser_surat' 
        							AND jenis = 'Nota Dinas' ORDER BY tanggal_surat DESC")->result();
        echo json_encode($letter);
    }

    public function readNotaDinas_TU_Sekda() {

        $id_typesurat = $this->input->get('id_typesurat');
        $id_typeuser_surat = $this->input->get('id_typeuser_surat');
        $id_typeuser_tujuan = $this->input->get('id_typeuser_tujuan');
        $letter = $this->db->query("SELECT * FROM v_surat_acc WHERE id_typesurat = '$id_typesurat' 
        							AND id_typeuser_surat = '$id_typeuser_surat' AND id_typeuser_tujuan = '$id_typeuser_tujuan'
        							AND jenis = 'Nota Dinas' ORDER BY tanggal_surat DESC")->result();
        echo json_encode($letter);
    }

// //======================================ACC=======================================================
//     public function readNotaDinas_TU_Acc() {

//         $id_typesurat = $this->input->get('id_typesurat');
//         $id_typeuser_surat = $this->input->get('id_typeuser_surat');
//         $letter = $this->db->query("SELECT * FROM v_surat_acc WHERE id_typeuser_surat = '$id_typeuser_surat' AND 
//         							jenis = 'Nota Dinas' ORDER BY tanggal_surat DESC")->result();
//         echo json_encode($letter);
//     }

//=========================================================Input========================================
    public function inputNotaDinas_TU() {
	
			$date = new DateTime('now');
			$file_path_acc = $this->input->post('file_path_acc');
			$image = "";

			for($a=count(explode(",", $file_path_acc))-2; $a>=0 ;$a--)
			{
				$foto = $date->format('ddMMyyHis').$a.'.jpg'; 
                $image = $image.$foto.",";

			}

			$jenis_acc = $this->input->post('jenis_acc');
			$id_surat = $this->input->post('id_surat');

			$data = array(	
							'file_path_acc' => $image,
							'jenis_acc' => $jenis_acc,
							'id_surat' => $id_surat
						 );

			$insert = $this->db->insert('file_acc',$data);

			$respon = array();

			if($insert)
			{
				json_encode($insert);
				$respon = array('response' => 1 );
					for($a=0; $a<count(explode(",", $image))-1 ;$a++)
						{
							$foto = $date->format('ddMMyyHis').$a.'.jpg'; 
			                file_put_contents('./assets/path_acc/'.$foto,base64_decode(explode(",", $file_path_acc)[$a]));
						}
						
						$acc = 'Acc '.$jenis_acc;
						$query = $this->db->query("UPDATE surat SET status = '$acc' WHERE id_surat = '$id_surat' ");
						json_encode($query);
				echo json_encode($respon);
			}
			else
			{
				$respon = array('response' => 0 );
				echo json_encode($respon);
			}


        }

//=========================================================================
    public function readterdisposisi() {

        $letter = $this->db->query("SELECT * FROM v_disposisi ORDER BY waktu_disposisi DESC")->result();
        echo json_encode($letter);
    }

    //terdisposisi

        public function inputSurat() {
	
			$date = new DateTime('now');
			$path_file = $this->input->post('path_file');
			$image = "";

			// for($a=0; $a<count(explode(",", $path_file))-1 ;$a++)
			// {
			// 	$foto = $date->format('ddMMyyHis').$a.'.jpg'; 
   //              $image = $image.$foto.",";

			// }

			for($a=count(explode(",", $path_file))-2; $a>=0 ;$a--)
			{
				$foto = $date->format('ddMMyyHis').$a.'.jpg'; 
                $image = $image.$foto.",";

			}

			$disposisi = $this->input->post('disposisi');
			
			$kepada = $this->input->post('kepada');
			$waktu = $this->input->post('waktu');
			$id_surat = $this->input->post('id_surat');

			$data = array(	
							'disposisi' => $disposisi,
							'path_file' => $image,
							'kepada' => $kepada,
							'waktu' => $waktu,
							'id_surat' => $id_surat
						 );

			$insert = $this->db->insert('terdisposisi',$data);

			$respon = array();

			if($insert)
			{
				json_encode($insert);
				$respon = array('response' => 1 );
					for($a=0; $a<count(explode(",", $path_file))-1 ;$a++)
						{
							$foto = $date->format('ddMMyyHis').$a.'.jpg'; 
			                file_put_contents('./assets/disposisi/'.$foto,base64_decode(explode(",", $path_file)[$a]));
						}
				$update = $this->db->query("UPDATE surat SET status = 'terdisposisi' WHERE id_surat = '$id_surat'");
				json_encode($update);
				echo json_encode($respon);
			}
			else
			{
				$respon = array('response' => 0 );
				echo json_encode($respon);
			}


        }

        public function cekSuratTerdisposisi()
        {
        	$id_surat = $this->input->post('id_surat');
        	$cekSurat = $this->db->query("SELECT count(*) as jml_surat FROM v_disposisi WHERE id_surat = '$id_surat'")->result();
        	
        	$respon = array();
        	
        	if($cekSurat[0]->jml_surat >= 1)
        	{
        		$respon = array('response' => 1,
        						'keterangan' => 'Sudah Ada Isinya',
        						'jumlah_surat' => $cekSurat[0]->jml_surat
        						);
        		echo json_encode($respon);
        	}
        	else if($cekSurat[0]->jml_surat == 0 || $cekSurat[0]->jml_surat < 1)
        	{

        		$respon = array('response' => 0,
        						'keterangan' => 'Belum Terisi',
        						'jumlah_surat' => 0 
        						);	
                echo json_encode($respon);
        	}
        	else
        	{
        		$respon = array('response' => 2,
        						'keterangan' => 'Gagal',
        						'jumlah_surat' => 0
        						);	
                echo json_encode($respon);	
        	}

        }

        public function cekSuratAndUpdateSurat()
        {
            $id_surat = $this->input->post('id_surat');
            $cekSurat = $this->db->query("SELECT count(*) as jml_surat FROM v_disposisi WHERE id_surat = '$id_surat'")->result();
            
            $respon = array();
            
            if($cekSurat[0]->jml_surat == 1)
            {
                $update = $this->db->query("UPDATE surat set status = 'masuk' WHERE id_surat = '$id_surat'");
                json_encode($update);

                $respon = array('response' => 1,
                                'keterangan' => 'Sudah Ada Isinya',
                                'jumlah_surat' => $cekSurat[0]->jml_surat
                                );
                echo json_encode($respon);
            }
            else if($cekSurat[0]->jml_surat > 1)
            {
                $respon = array('response' => 3,
                                'keterangan' => 'Lebih dari 1 Isinya',
                                'jumlah_surat' => $cekSurat[0]->jml_surat
                                );
                echo json_encode($respon);   
            }
            else if($cekSurat[0]->jml_surat == 0 || $cekSurat[0]->jml_surat < 1)
            {

                $respon = array('response' => 0,
                                'keterangan' => 'Belum Terisi',
                                'jumlah_surat' => 0 
                                );  
                echo json_encode($respon);
            }
            else
            {
                $respon = array('response' => 2,
                                'keterangan' => 'Gagal',
                                'jumlah_surat' => 0
                                );  
                echo json_encode($respon);  
            }

        }

		public function updateStatus()
		{
			$id_surat = $this->input->post('id_surat');
			
        	$respon = array();

			if($id_surat != null || $id_surat != "")
			{
				$update = $this->db->query("UPDATE surat set status = 'terdisposisi' WHERE id_surat = '$id_surat'");
	        	json_encode($update);
				$respon = array('response' => 1 );
				echo json_encode($respon);
			}
			else
			{
				$respon = array('response' => 0 );
				echo json_encode($respon);
			}
                
		}

        public function hapusDisposisi()
        {
        	$id_disposisi = $this->input->post('id_disposisi');

        	$respon = array();

        	if($id_disposisi != null || $id_disposisi !="")
        	{
        		$respon = array('response' => 1 );
        		$tampilDispo = $this->db->query("SELECT * FROM terdisposisi WHERE id_disposisi = '$id_disposisi'")->result();
        		$foto = explode(",", $tampilDispo[0]->path_file);

        		$delete = $this->db->query("DELETE FROM terdisposisi WHERE id_disposisi = '$id_disposisi'");

	        	for ($i=0; $i < count($foto)-1; $i++) { 
	        		unlink('./assets/disposisi/'.$foto[$i]);
	        	}

        		json_encode($delete);
        		echo json_encode($respon);
        	}
        	else
        	{
        		$respon = array('response' => 0 );
        		json_encode($delete);
        		echo json_encode($respon);
        	}

        }



}

