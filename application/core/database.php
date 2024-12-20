<?php

namespace App\Core;

use \PDO;

class Database 
{    
    private $host = 'MySQL-8.2'; 
    private $dbname = 'Comments';
    private $user = 'root';
    private $pass = '';
    private $pdo;
    
    public function connect() 
    {
        if ($this->pdo == null) {
            try {           
                // create PDO object to connect to BD
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}",
                $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'Connection sucsses!';  
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
                }
        }
        return $this->pdo; 
    }
}
