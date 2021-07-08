<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');
require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();


$app->get('/AuthLogin','AuthLogin'); 
// $app->get('/Data_Barang','Data_Barang');
// $app->post('/Input_Barang','Input_Barang');
// $app->get('/Input_Barang2','Input_Barang2');
// $app->get('/Get_Barang_Edit','Get_Barang_Edit');
// $app->post('/Edit_Barang','Edit_Barang');
// $app->get('/Edit_Barang2','Edit_Barang2');
// $app->post('/Delete_Barang','Delete_Barang');
// $app->get('/Delete_Barang2','Delete_Barang2');
$app->run();
 
// function Get_Data($request, $response){
//     // $data = $request->getParsedBody();
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     $where = "";
//     if (isset($_GET['cari'])) {
//         $cari = $_GET['cari'];
//         $where = "WHERE nama_barang like '%$cari%'";
//     }
//     try {         
//         //if($systemToken == $token){
//             $Data_Barang = '';
//             $db = getDB();            
//             $sql = "SELECT * FROM barang $where";
//             $stmt = $db->prepare($sql);
//             $stmt->execute();
//             $Data_Barang = $stmt->fetchAll(PDO::FETCH_OBJ);           
//             $db = null;
//             if($Data_Barang)
//             echo '{"Data_Barangs": ' . json_encode($Data_Barang) . '}';
//             else
//             echo '{"Data_Barangs": ""}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }

function AuthLogin($request, $response){
    // $data = $request->getParsedBody();
    $username = $_GET['username'];
    $password = md5($_GET['password']);
    //$systemToken=apiToken($login);   

    try {         
        //if($systemToken == $token){
            $Data_User = '';
            $db = getDB();            
            $sql = "SELECT usr.*, (SELECT role.role FROM tbl_role role WHERE usr.id_role=role.id_role) role FROM tbl_user usr WHERE  username like '%$username%' AND password = '$password' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $Data_User = $stmt->fetchAll(PDO::FETCH_OBJ);           
            $db = null;
            if($Data_User)
            echo '{"Data_User": ' . json_encode($Data_User) . '}';
            else
            echo '{"Data_User": "error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
 
// function Input_Barang($request, $response){
//     $data = $request->getParsedBody();
//     $nama_barang=$data['nama_barang'];
//     $qty=$data['qty'];
//     $harga=$data['harga'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "INSERT INTO barang(nama_barang, qty, harga) VALUES(:nama_barang ,:qty, :harga)";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
//             $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
//             $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
//             $stmt->execute();        
//             $db = null;
//             if($stmt)
//             echo '{"Input_Barang": "input success"}';
//             else
//             echo '{"Input_Barang": "input error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }

// function Input_Barang2($request, $response){
//     $nama_barang=$_GET['nama'];
//     $qty=$_GET['qty'];
//     $harga=$_GET['harga'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "INSERT INTO barang(nama_barang, qty, harga) VALUES(:nama_barang ,:qty, :harga)";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
//             $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
//             $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
//             $stmt->execute();        
//             $db = null;
//             if($stmt)
//             echo '{"Input_Barang": "input success"}';
//             else
//             echo '{"Input_Barang": "input error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// } 
 
// function Get_Barang_Edit($request, $response){
//     $data = $request->getParsedBody();
//     // $id_barang=$data['id_barang'];
//     $id_barang=$_GET['id'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//       $Get_Barang_Edit = '';
//             $db = getDB();            
//             $sql = "SELECT * FROM barang WHERE id_barang=:id_barang";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("id_barang", $id_barang, PDO::PARAM_STR);
//             $stmt->execute();  
//             $Get_Barang_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);          
//             $db = null;
//             if($Get_Barang_Edit)
//             echo '{"Get_Barang_Edit": ' . json_encode($Get_Barang_Edit) . '}';
//             else
//             echo '{"Get_Barang_Edit": ""}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }
 
// function Edit_Barang($request, $response){
//     $data = $request->getParsedBody();
//     $id_barang=$data['id_barang'];
//     $nama_barang=$data['nama_barang'];
//     $qty=$data['qty'];
//     $harga=$data['harga'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "UPDATE barang SET nama_barang=:nama_barang, qty=:qty, harga=:harga WHERE id_barang=:id_barang";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("id_barang", $id_barang, PDO::PARAM_STR);
//             $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
//             $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
//             $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
//             $stmt->execute();        
//             $db = null;
//             if($stmt)
//             echo '{"Edit_Barang": "Edit success"}';
//             else
//             echo '{"Edit_Barang": "Edit error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }

// function Edit_Barang2($request, $response){
//     // $data = $request->getParsedBody();
//     $id_barang=$_GET['id'];
//     $nama_barang=$_GET['nama'];
//     $qty=$_GET['qty'];
//     $harga=$_GET['harga'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "UPDATE barang SET nama_barang=:nama_barang, qty=:qty, harga=:harga WHERE id_barang=:id_barang";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("id_barang", $id_barang, PDO::PARAM_STR);
//             $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
//             $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
//             $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
//             $stmt->execute();        
//             $db = null;
//             if($stmt)
//             echo '{"Edit_Barang": "Edit success"}';
//             else
//             echo '{"Edit_Barang": "Edit error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }
 
// function Delete_Barang($request, $response){
//     $data = $request->getParsedBody();
//     $id_barang=$data['id_barang'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "DELETE FROM barang WHERE id_barang=:id_barang";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("id_barang", $id_barang, PDO::PARAM_STR);
//             $stmt->execute(); 
//             $db = null;
//             if($stmt)
//             echo '{"Delete_Barang": "Delete success"}';
//             else
//             echo '{"Delete_Barang": "Delete error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }

// function Delete_Barang2($request, $response){
//     $id_barang=$_GET['id'];
//     //$login=$data['login'];
//     //$token=$data['token'];   
//     //$systemToken=apiToken($login);   
//     try {         
//         //if($systemToken == $token){
//             $db = getDB();            
//             $sql = "DELETE FROM barang WHERE id_barang=:id_barang";
//             $stmt = $db->prepare($sql);
//             $stmt->bindParam("id_barang", $id_barang, PDO::PARAM_STR);
//             $stmt->execute(); 
//             $db = null;
//             if($stmt)
//             echo '{"Delete_Barang": "Delete success"}';
//             else
//             echo '{"Delete_Barang": "Delete error"}';
//         //} else{
//         //    echo '{"error":{"text":"No access"}}';
//         //}       
//     } catch(PDOException $e) {
//         echo '{"error":{"text":'. $e->getMessage() .'}}';
//     }
// }