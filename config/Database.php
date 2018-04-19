<?php

class Database 
{
	// db credentials
	private $host = 'localhost';
	private $database = 'studentdb';
	private $username = 'root';
	private $password = '';

	// get set db connection
	public function connection() {
		$conn = null;

		try {
			$conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);
		} catch(PDOException $ex){
			echo 'Connection error: ' . $ex->getMessage();
		}

		return $conn;
	}
}
