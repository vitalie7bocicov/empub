<?php

class DB {
    protected $dbConnection;
    protected $host = '127.0.0.1';
    protected $db = 'empub';
    protected $user = 'root';
    protected $password = '';
    protected $charset = 'utf8';

    function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $opt = [
            // erorile sunt raportate ca exceptii de tip PDOException
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // rezultatele vor fi disponibile in tablouri asociative
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // conexiunea e persistenta
            PDO::ATTR_PERSISTENT 		 => TRUE
        ];

        $this->dbConnection = new PDO($dsn, $this->user, $this->password, $opt);
    }

    public function getConnection() {
        return $this->dbConnection;
    }
  
}