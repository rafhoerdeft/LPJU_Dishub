<?php 

	// Panggil class PHPExcel nya
	$excel = new PHPExcel();

	// Settingan awal fil excel
	$excel->getProperties()->setCreator('DISKOMINFO')
							->setLastModifiedBy('Erdeft')
							->setTitle("Cetak Laporan".ucwords($nama_jenis))
							->setSubject(ucwords($nama_jenis))
							->setDescription("Laporan ".ucwords($nama_jenis))
							->setKeywords("Laporan ".ucwords($nama_jenis));

	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	$style_title1 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => false,
	      	'size' => (14)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM // Set text jadi di tengah secara vertical (middle)
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'ffffff')
        )
	);

	$style_body1 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => TRUE,
	      	'size' => (10)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'c7ecfc')
        )
	);

	$style_body2 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (10)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'ffffff')
        )
	);

	$style_body3 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (10)
		),
		'alignment' => array(
			// 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			// 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'ffffff')
        )
	);

	$style_body4 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (10)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			// 'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			// 'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			// 'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			// 'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		// 'fill' => array(
  //           'type' => PHPExcel_Style_Fill::FILL_SOLID,
  //           'color' => array('rgb' => 'ffffff')
  //       )
	);

	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
	$excel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('A3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA");
	$excel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('B3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('C3', "KLASIFIKASI LPJU");
	$excel->setActiveSheetIndex(0)->getStyle('C3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('C3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('D3', "INSTALASI KwH METER");
	$excel->setActiveSheetIndex(0)->getStyle('D3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('D3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('E3', "ID PEL");
	$excel->setActiveSheetIndex(0)->getStyle('E3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('E3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('F3', "DAYA (VA)");
	$excel->setActiveSheetIndex(0)->getStyle('F3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('F3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('G3', "TAHUN");
	$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('H3', "SUMBER DANA");
	$excel->setActiveSheetIndex(0)->getStyle('H3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('H3')->applyFromArray($style_body1);	

	$excel->setActiveSheetIndex(0)->setCellValue('I3', "ASET");
	$excel->setActiveSheetIndex(0)->getStyle('I3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('I3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('J3', "STATUS JALAN");
	$excel->setActiveSheetIndex(0)->getStyle('J3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('J3')->applyFromArray($style_body1);		

	$excel->setActiveSheetIndex(0)->setCellValue('K3', "JENIS LPJU");
	$excel->setActiveSheetIndex(0)->getStyle('K3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('K3')->applyFromArray($style_body1);		

	$excel->setActiveSheetIndex(0)->setCellValue('L3', "KECAMATAN");
	$excel->setActiveSheetIndex(0)->getStyle('L3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('L3')->applyFromArray($style_body1);		

	$excel->setActiveSheetIndex(0)->setCellValue('M3', "RUAS JALAN");
	$excel->setActiveSheetIndex(0)->getStyle('M3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('M3')->applyFromArray($style_body1);	

	$excel->setActiveSheetIndex(0)->setCellValue('N3', "KONDISI");
	$excel->setActiveSheetIndex(0)->getStyle('N3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('N3')->applyFromArray($style_body1);	

	$excel->setActiveSheetIndex(0)->setCellValue('O3', "JENIS LAMPU");
	$excel->setActiveSheetIndex(0)->getStyle('O3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('O3')->applyFromArray($style_body1);		

	$excel->setActiveSheetIndex(0)->setCellValue('P3', "PANJANG TARIKAN (m)");
	$excel->setActiveSheetIndex(0)->getStyle('P3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('P3')->applyFromArray($style_body1);		

	$excel->setActiveSheetIndex(0)->setCellValue('Q3', "KETERANGAN TAMBAHAN");
	$excel->setActiveSheetIndex(0)->getStyle('Q3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('Q3')->applyFromArray($style_body1);		

	// // Set Repeat Header
	$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,3);

	// BARIS BODY / ISI DATA
	$no = 65;
	$row = 5;
	$excel->getActiveSheet()->getStyle('4')->getAlignment()->setWrapText(true);

	foreach ($jaringan_listrik as $key) {
		if ($key->nama_pj!="Abonemen") {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, chr($no++));
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, $key->nama_pj);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$row, 'Meterisasi');
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$row, '');
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$row, $key->no_id_pel);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$row, $key->kwh_meter);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->thn_pj);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $key->sumber_dana);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $key->id_aset);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$row, $key->status_jalan);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$row, '');
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$row, $key->nama_kecamatan);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, $key->nama_jalan);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$row, $key->kondisi_pj);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$row, '');
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$row, $key->panjang_tarikan_meterisasi);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$row, '');

			$excel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($style_body3);
			$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($style_body2);

			$row++;

			$i=1;
			foreach ($laporan as $lap) {
				if ($lap->id_listrik==$key->id_pj) {
					$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $i++);
					$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, $lap->nama_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('C'.$row, 'Meterisasi');
					$excel->setActiveSheetIndex(0)->setCellValue('D'.$row, $key->nama_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('E'.$row, $key->no_id_pel);
					$excel->setActiveSheetIndex(0)->setCellValue('F'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $lap->thn_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $lap->sumber_dana);
					$excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $lap->id_aset);
					$excel->setActiveSheetIndex(0)->setCellValue('J'.$row, $key->status_jalan);
					$excel->setActiveSheetIndex(0)->setCellValue('K'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('L'.$row, $lap->kecamatan);
					$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, $lap->nama_jalan);
					$excel->setActiveSheetIndex(0)->setCellValue('N'.$row, $lap->kondisi_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('O'.$row, $lap->jenis_lampu);
					$excel->setActiveSheetIndex(0)->setCellValue('P'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('Q'.$row, '');


					$excel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($style_body3);
					$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($style_body2);

					$row++;
				}		
			}

			$row++;
		}
	}

	foreach ($jaringan_listrik as $key) {
		if ($key->nama_pj=="Abonemen") {
			$i=1;
			foreach ($laporan as $lap) {
				if ($lap->id_listrik==$key->id_pj) {
					$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $i++);
					$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, $lap->nama_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('C'.$row, 'Abonemen');
					$excel->setActiveSheetIndex(0)->setCellValue('F'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $lap->thn_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $lap->sumber_dana);
					$excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $lap->id_aset);
					$excel->setActiveSheetIndex(0)->setCellValue('J'.$row, $key->status_jalan);
					$excel->setActiveSheetIndex(0)->setCellValue('K'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('L'.$row, $lap->kecamatan);
					$excel->setActiveSheetIndex(0)->setCellValue('M'.$row, $lap->nama_jalan);
					$excel->setActiveSheetIndex(0)->setCellValue('N'.$row, $lap->kondisi_pj);
					$excel->setActiveSheetIndex(0)->setCellValue('O'.$row, $lap->jenis_lampu);
					$excel->setActiveSheetIndex(0)->setCellValue('P'.$row, '');
					$excel->setActiveSheetIndex(0)->setCellValue('Q'.$row, '');


					$excel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($style_body3);
					$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($style_body2);
					$excel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($style_body2);

					$row++;
				}		
			}

			$row++;
		}
	}	

	// // Set width kolom
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(52.71);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(17.57);
	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(52.71);
	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(39);
	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('M')->setWidth(52.71);
	$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);

	$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(27);
	// $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(11.25);
	// $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(3.75);
	// $excel->getActiveSheet()->getRowDimension('8')->setRowHeight(30.75);
	

	// // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	// // $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	// Set orientasi kertas jadi PORTRAIT
	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
	$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

	// Set Footer
	// $excel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Halaman Ke-&P dari &N');
	// $excel->getActiveSheet()->getHeaderFooter()->setEvenFooter('&R Halaman Ke-&P dari &N');

	// Set judul file excel nya
	$excel->getActiveSheet(0)->setTitle("Laporan Perlengkapan Jalan");
	$excel->setActiveSheetIndex(0);
	// Proses file excel
	// ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="Cetak Laporan '.ucwords($nama_jenis).'.xlsx"'); // Set nama file excel nya
	header('Cache-Control: max-age=0');
	ob_end_clean();
	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	$write->save('php://output');

 ?>
