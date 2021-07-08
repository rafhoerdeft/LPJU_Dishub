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

    public function show_agenda()
    {
        $tanggal_agenda = $this->input->get('tanggal_agenda');

        $query = $this->db->query("SELECT * FROM agenda WHERE tanggal_agenda = '$tanggal_agenda'")->result();
        echo json_encode($query);
    }


}

