<?php
class DB_Connect {
    protected $koneksi;
 
    // koneksi ke database
    protected function connect() {
        require_once 'class/Config.php';
         
        // koneksi ke mysql database
        $this->koneksi = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         
        // return database handler
        return $this->koneksi;
    }
}
 
?>