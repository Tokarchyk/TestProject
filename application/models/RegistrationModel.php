<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use \PDO;

class RegistrationModel extends Model
{
    private $db;
    
	public function __construct() 
    {
        // connect to bd
		$this->db = (new Database())->connect();    
	}

    // add email & password to table 'users'
    public function SaveRegistration($email, $password)
    {
		try {
            $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo 'email & password added!';
            // header("Location: https://vitalyswipe-tinymvc.local/comment/");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }       
	}

    
}