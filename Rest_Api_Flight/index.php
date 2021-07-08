<?php
error_reporting(0);
//ini_set('display_errors', 0);
require 'flight/Flight.php';
require_once 'class/DB_Functions.php';

Flight::set("key", "2a59c326d271d97d876e0c377bfa812b");

Flight::map('notFound', function(){
    echo "404";
});

Flight::route('GET /authUser/@user/@pass', function($user, $pass){

	if( !function_exists('apache_request_headers') ) {
		function apache_request_headers() {
		  $arh = array();
		  $rx_http = '/\AHTTP_/';
		  foreach($_SERVER as $key => $val) {
		    if( preg_match($rx_http, $key) ) {
		      $arh_key = preg_replace($rx_http, '', $key);
		      $rx_matches = array();
		      // do some nasty string manipulations to restore the original letter case
		      // this should work in most cases
		      $rx_matches = explode('_', $arh_key);
		      if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
		        foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
		        $arh_key = implode('-', $rx_matches);
		      }
		      $arh[$arh_key] = $val;
		    }
		  }
		  return( $arh );
		}
	}

	$header 	= apache_request_headers();
	$key 		= $header['KEY'];
	$valid_key 	= Flight::get('key');
	// var_dump($key);

    if ($key == $valid_key) {
	    $service = new DB_Functions();
		$dataUser = $service->authUser($user, $pass);
		// echo json_encode($dataBarang);
		echo '{"Data User": ' . json_encode($dataUser) . '}';
    }else{
    	header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Illegal Access';
	    exit;
    }
});

Flight::route('POST /Input_Barang', function(){
	$header 	= apache_request_headers();
	$key 		= $header['key'];
	$valid_key 	= Flight::get('key');

    if ($key == $valid_key) {
    	$nama_barang = $_POST['nama_barang'];
	    $qty = $_POST['qty'];
	    $harga = $_POST['harga'];

	    $data = array(
	    	'nama_barang' => $nama_barang,
	    	'qty' => $qty,
	    	'harga' => $harga
	    );

	    $service = new DB_Functions();
		$dataBarang = $service->inputDataBarang($data);
		// echo json_encode($dataBarang);
		if ($dataBarang) {
			echo '{"Input_Barang": "input success"}';
		}else{
			echo '{"Input_Barang": "input error"}';
		}
    }else{
    	header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Illegal Access';
	    exit;
    }
});

Flight::route('POST /Get_Barang_Edit', function(){
	$header 	= apache_request_headers();
	$key 		= $header['key'];
	$valid_key 	= Flight::get('key');

    if ($key == $valid_key) {

    	$id = $_POST['id_barang'];

	    $service = new DB_Functions();
		$dataBarang = $service->getEditBarang($id);
		// echo json_encode($dataBarang);
		echo '{"Get_Barang_Edit": ' . json_encode($dataBarang) . '}';
    }else{
    	header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Illegal Access';
	    exit;
    }
});

Flight::route('POST /Edit_Barang', function(){
	$header 	= apache_request_headers();
	$key 		= $header['key'];
	$valid_key 	= Flight::get('key');

    if ($key == $valid_key) {
    	$id_barang = $_POST['id_barang'];
    	$nama_barang = $_POST['nama_barang'];
	    $qty = $_POST['qty'];
	    $harga = $_POST['harga'];

	    $data = array(
	    	'id_barang' => $id_barang,
	    	'nama_barang' => $nama_barang,
	    	'qty' => $qty,
	    	'harga' => $harga
	    );

	    $service = new DB_Functions();
		$dataBarang = $service->editDataBarang($data);
		// echo json_encode($dataBarang);
		if ($dataBarang) {
			echo '{"Edit_Barang": "Edit success"}';
		}else{
			echo '{"Edit_Barang": "Edit error"}';
		}
    }else{
    	header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Illegal Access';
	    exit;
    }
});

Flight::route('POST /Delete_Barang', function(){
	$header 	= apache_request_headers();
	$key 		= $header['key'];
	$valid_key 	= Flight::get('key');

    if ($key == $valid_key) {

    	$id = $_POST['id_barang'];

	    $service = new DB_Functions();
		$dataBarang = $service->deleteDataBarang($id);
		// echo json_encode($dataBarang);
		if ($dataBarang) {
			echo '{"Delete_Barang": "Delete success"}';
		}else{
			echo '{"Delete_Barang": "Delete error"}';
		}
    }else{
    	header('WWW-Authenticate: Basic realm="My Realm"');
	    header('HTTP/1.0 401 Unauthorized');
	    echo 'Illegal Access';
	    exit;
    }
});


Flight::start();
?>
