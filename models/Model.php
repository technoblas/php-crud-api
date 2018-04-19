<?php

require_once './config/Database.php';

class Model 
{
	public $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connection();
    }
}