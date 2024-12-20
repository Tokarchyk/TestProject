<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use \PDO;

class AuthorizationModel extends Model
{
    private $db;
    
	public function __construct() 
    {
        // connect to bd
		$this->db = (new Database())->connect();    
	}

    public function get_data() 
    {
        try{
		$stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    } 
    
}
   