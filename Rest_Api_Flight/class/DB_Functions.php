<?php
require_once 'class/DB_Connect.php';

class DB_Functions Extends DB_Connect {
 
    private $conn;
 
    function __construct() {
        $this->conn = $this->connect();
    }
	
	public function authUser($username, $password) {
        
        $stmt = $this->conn->prepare("SELECT usr.*, (SELECT role.role FROM tbl_role role WHERE usr.id_role=role.id_role) role FROM tbl_user usr WHERE  username like '%$username%' AND password = '$password' ");
        // $sql = "SELECT usr.*, (SELECT role.role FROM tbl_role role WHERE usr.id_role=role.id_role) role FROM tbl_user usr WHERE  username like '%$username%' AND password = '$password' ";
        
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
            return $results;
        } else {
            return NULL;
        }
    }

    public function inputDataBarang($data){
    	$nama_barang=$data['nama_barang'];
	    $qty=$data['qty'];
	    $harga=$data['harga'];

    	$stmt = $this->conn->prepare("INSERT INTO barang(nama_barang, qty, harga) VALUES(? ,?, ?)");
    	$stmt->bind_param("sss", $nama_barang, $qty, $harga);
 
        $input = $stmt->execute();
        // $result = $stmt->get_result();
        if ($input) {
            return true;
        } else {
            return false;
        }
    }

    public function getEditBarang($id=''){

    	$stmt = $this->conn->prepare("SELECT * FROM barang WHERE id_barang = ?");
 		$stmt->bind_param("s", $id);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
            return $results;
        } else {
            return NULL;
        }
    }

    public function editDataBarang($data){
    	$id_barang=$data['id_barang'];
    	$nama_barang=$data['nama_barang'];
	    $qty=$data['qty'];
	    $harga=$data['harga'];

    	$stmt = $this->conn->prepare("UPDATE barang SET nama_barang=?, qty=?, harga=? WHERE id_barang=?");
    	$stmt->bind_param("ssss", $nama_barang, $qty, $harga, $id_barang);
 
        $update = $stmt->execute();
        // $result = $stmt->get_result();
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDataBarang($id=''){

    	$stmt = $this->conn->prepare("DELETE FROM barang WHERE id_barang=?");
 		$stmt->bind_param("s", $id);

        $delete = $stmt->execute();
        // $result = $stmt->get_result();
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }
	
}
 
?>