<?php

class Database{

    protected $conn;

    public function __construct(){
        $this->connect();
    }

    protected function connect(){

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "db_gym";

        $this->conn = new mysqli($host,$user,$password,$db);

        if($this->conn->connect_error){
            die("Koneksi gagal : ".$this->conn->connect_error);
        }

    }

    public function getConnection(){
        return $this->conn;
    }

}