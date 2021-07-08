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

	// $style_title2 = array(
	// 	'font' => array(
	// 		'name'  => 'Times New Roman',
	//       	'bold' => FALSE,
	//       	'size' => (12)
	// 	),
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'fill' => array(
 //            'type' => PHPExcel_Style_Fill::FILL_SOLID,
 //            'color' => array('rgb' => 'ffffff')
 //        )
	// );

	// $style_title3 = array(
	// 	'font' => array(
	// 		'name'  => 'Calibri',
	//       	'bold' => true,
	//       	'size' => (11),
	//       	'underline' => TRUE
	// 	),
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	)
	// );

	// $style_line1 = array(
	// 		'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'borders' => array(
	// 		// 'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		// 'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THICK), // Set border bottom dengan garis tipis
	// 		// 'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	)
	// );

	// $style_line2 = array(
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'borders' => array(
	// 		// 'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		// 'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		// 'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	)
	// );

	// $style_header1 = array(
	// 	'font' => array(
	// 		'name'  => 'Calibri',
	//       	'bold' => TRUE,
	//       	'size' => (11)
	// 	),
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		// 'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THICK), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	),
	// 	'fill' => array(
 //            'type' => PHPExcel_Style_Fill::FILL_SOLID,
 //            'color' => array('rgb' => '91cef2')
 //        )
	// );
	// $style_header2 = array(
	// 	'font' => array(
	// 		'name'  => 'Calibri',
	//       	'bold' => TRUE,
	//       	'size' => (11)
	// 	),
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THICK), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	),
	// 	'fill' => array(
 //            'type' => PHPExcel_Style_Fill::FILL_SOLID,
 //            'color' => array('rgb' => '91cef2')
 //        )
	// );

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

	

	// $style_body3 = array(
	// 	'font' => array(
	// 		'name'  => 'Arial',
	//       	'bold' => FALSE,
	//       	'size' => (8)
	// 	),
	// 	'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	),
	// 	'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	),
	// 	'fill' => array(
 //            'type' => PHPExcel_Style_Fill::FILL_SOLID,
 //            'color' => array('rgb' => 'ffffff')
 //        )
	// );



	// $objDrawing = new PHPExcel_Worksheet_Drawing();
	// $objDrawing->setName('Mitragemilang');
	// $objDrawing->setDescription('Mitragemilang Logo');
	// $objDrawing->setPath('assets/assets/images/logo-icon.png');
	// // $excel->getActiveSheet()->mergeCells('A1:B3');
	// $objDrawing->setCoordinates('A1');                      
	// //setOffsetX works properly
	// $objDrawing->setOffsetX(15); 
	// $objDrawing->setOffsetY(10);                
	// //set width, height
	// $objDrawing->setWidth(70); 
	// $objDrawing->setHeight(70); 
	// $objDrawing->setWorksheet($excel->getActiveSheet());
	
	

	// $excel->getActiveSheet()->mergeCells('A2:E2');
	// $excel->setActiveSheetIndex(0)->setCellValue('A2', "Pucang Karang No. 10, Pojok, Pucang");
	// $excel->setActiveSheetIndex(0)->getStyle('A2')->getAlignment()->setWrapText(true);

	// // $first = date('d-m-Y',strtotime($tgl_awal));
	// // $last = date('d-m-Y',strtotime($tgl_akhir));

	// $excel->getActiveSheet()->mergeCells('A3:E3');
	// $excel->setActiveSheetIndex(0)->setCellValue('A3', "Secang, Magelang, Jawa Tengah, 56195");
	// $excel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setWrapText(true);

	// $excel->getActiveSheet()->mergeCells('C3:D3');
	// $excel->setActiveSheetIndex(0)->setCellValue('C3', "Tanggal: ".$first." s/d ".$last);
	// $excel->setActiveSheetIndex(0)->getStyle('C3')->getAlignment()->setWrapText(true);
	
	// SET LINE
	// $excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray($style_line1);
	// $excel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($style_line2);

	// // BARIS HEADER
	// $excel->getActiveSheet()->mergeCells('A6:E6');
	// $excel->setActiveSheetIndex(0)->setCellValue('A6', 'LAPORAN STOK BARANG');

	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
	$excel->setActiveSheetIndex(0)->getStyle('A3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('A3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA");
	$excel->setActiveSheetIndex(0)->getStyle('B3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('B3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('C3', "TAHUN");
	$excel->setActiveSheetIndex(0)->getStyle('C3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('C3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('D3', "KECAMATAN");
	$excel->setActiveSheetIndex(0)->getStyle('D3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('D3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('E3', "RUAS JALAN");
	$excel->setActiveSheetIndex(0)->getStyle('E3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('E3')->applyFromArray($style_body1);

	$excel->setActiveSheetIndex(0)->setCellValue('F3', "KONDISI");
	$excel->setActiveSheetIndex(0)->getStyle('F3')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('F3')->applyFromArray($style_body1);

	if ($id_jenis=='1') {
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "JENIS LAMPU");
		$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);

		$excel->setActiveSheetIndex(0)->setCellValue('H3', "METERAN LISTRIK");
		$excel->setActiveSheetIndex(0)->getStyle('H3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('H3')->applyFromArray($style_body1);	

		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ABONEMEN");
		$excel->setActiveSheetIndex(0)->getStyle('I3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('I3')->applyFromArray($style_body1);			
	} else if ($id_jenis=='3') {
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "JENIS RAMBU");
		$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);		
	} else if ($id_jenis=='4') {
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "PANJANG (M)");
		$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);		
	} else if ($id_jenis=='5') {
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "LEBAR JALAN");
		$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);		
	} else if ($id_jenis=='7') {
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "KWH Meter");
		$excel->setActiveSheetIndex(0)->getStyle('G3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('G3')->applyFromArray($style_body1);	

		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Pelanggan");
		$excel->setActiveSheetIndex(0)->getStyle('H3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('H3')->applyFromArray($style_body1);	

		$excel->setActiveSheetIndex(0)->setCellValue('I3', "Tarikan");
		$excel->setActiveSheetIndex(0)->getStyle('I3')->getAlignment()->setWrapText(true);
		$excel->setActiveSheetIndex()->getStyle('I3')->applyFromArray($style_body1);		
	}

	// // Set Repeat Header
	$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,3);

	// BARIS BODY / ISI DATA
	$no = 1;
	$row = 4;
	$excel->getActiveSheet()->getStyle('4')->getAlignment()->setWrapText(true);
	
	foreach ($laporan as $key) {
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$row, $no++);
		// $excel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setIndent(1);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$row, $key->nama_pj);
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$row, $key->thn_pj);
		$excel->setActiveSheetIndex(0)->setCellValue('D'.$row, $key->kecamatan);
		$excel->setActiveSheetIndex(0)->setCellValue('E'.$row, $key->nama_jalan);
		$excel->setActiveSheetIndex(0)->setCellValue('F'.$row, $key->kondisi_pj);

		if ($id_jenis=='1') {
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->jenis_lampu);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $key->meteran_listrik);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $key->abonemen);
		} else if ($id_jenis=='3') {
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->jenis_rambu);
		} else if ($id_jenis=='4') {
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->pjg_guardrail);
		} else if ($id_jenis=='5') {
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->lebar_jalan);
		} else if ($id_jenis=='7') {
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$row, $key->kwh_meter);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$row, $key->no_id_pel);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$row, $key->panjang_tarikan_meterisasi);
		}

		// 	// Apply style
		$excel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($style_body2);
		$excel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($style_body3);
		$excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_body2);
		$excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_body2);
		$excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_body2);
		$excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_body2);
		
		if ($id_jenis=='1') {
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($style_body2);
		} else if ($id_jenis=='3') {
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
		} else if ($id_jenis=='4') {
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
		} else if ($id_jenis=='5') {
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
		} else if ($id_jenis=='7') {
			$excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_body2);
			$excel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($style_body2);
		}		
		
		$row++;
	}

	$row = $row + 2;

	$nama_bulan = array(
		'01'=>'Januari', 
		'02'=>'Februari', 
		'03'=>'Maret', 
		'04'=>'April', 
		'05'=>'Mei', 
		'06'=>'Juni', 
		'07'=>'Juli', 
		'08'=>'Agustus', 
		'09'=>'September', 
		'10'=>'Oktober', 
		'11'=>'November', 
		'12'=>'Desember'
	);

	$tgl = date('d');
	$bulan = date('m');
	foreach ($nama_bulan as $key => $value) {
		if ($key==$bulan) {
			$bln = $value;
		}
	}
	$thn = date('Y');

	$lastCell1= 'F';
	$lastCell2= 'G';
	if ($id_jenis=='1') {
		$lastCell1= 'F';
		$lastCell2= 'I';
	} else if ($id_jenis=='2') {
		$lastCell1= 'E';
		$lastCell2= 'F';
	} else if ($id_jenis=='6') {
		$lastCell1= 'E';
		$lastCell2= 'F';
	} else if ($id_jenis=='7') {
		$lastCell1= 'F';
		$lastCell2= 'I';
	}		

	// TITLE
	$excel->getActiveSheet()->mergeCells('A1:'.$lastCell2.'1');
	$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN ".strtoupper($nama_jenis));
	$excel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle('A1:'.$lastCell2.'1')->applyFromArray($style_title1);

	//================= ttd =================
	$excel->getActiveSheet()->mergeCells($lastCell1.$row.':'.$lastCell2.$row);
	$excel->setActiveSheetIndex(0)->setCellValue($lastCell1.$row, "Magelang, ".$tgl.' '.$bln.' '.$thn);
	$excel->setActiveSheetIndex(0)->getStyle($lastCell1.$row)->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle($lastCell1.$row.':'.$lastCell2.$row)->applyFromArray($style_body4);

	$row = $row + 4;
	$excel->getActiveSheet()->mergeCells($lastCell1.$row.':'.$lastCell2.$row);
	$excel->setActiveSheetIndex(0)->setCellValue($lastCell1.$row, "Albert Einstein");
	$excel->setActiveSheetIndex(0)->getStyle($lastCell1.$row)->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle($lastCell1.$row.':'.$lastCell2.$row)->applyFromArray($style_body4);

	$row = $row + 1;
	$excel->getActiveSheet()->mergeCells($lastCell1.$row.':'.$lastCell2.$row);
	$excel->setActiveSheetIndex(0)->setCellValue($lastCell1.$row, "NIP. 2342323423");
	$excel->setActiveSheetIndex(0)->getStyle($lastCell1.$row)->getAlignment()->setWrapText(true);
	$excel->setActiveSheetIndex()->getStyle($lastCell1.$row.':'.$lastCell2.$row)->applyFromArray($style_body4);
	//================= ttd =================

	// // Set width kolom
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(46);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(39);
	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

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