<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use \PDO;

class CommentModel extends Model // change class name Model_Portfolio
{
    private $db;
    
	public function __construct() 
    {
        // connect to bd
		$this->db = (new Database())->connect();    
	}

	// add email & comment to db
    public function insertData($email, $comment)
    {
		try {
            $stmt = $this->db->prepare("INSERT INTO comments (email, comment) VALUES (:email, :comment)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':comment', $comment);
            $stmt->execute();
            header("Location: https://vitalyswipe-tinymvc.local/comment/");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }       
	}

	public function get_data()
	{
        $stmt = $this->db->prepare("SELECT * FROM comments");
        $stmt->execute();
        $usersForm = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $usersForm;		
	}

    public function deleteComment($id) 
    {
        try {
            $sql = "DELETE FROM comments WHERE id = :id";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            // return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            // return false;
        }

        header("Location: https://vitalyswipe-tinymvc.local/comment/");
    }

    public function updateComment($id, $comment)
    {
        try {
            $sql = "UPDATE comments SET comment = :comment WHERE id = :id";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':comment', $comment);
            // $comment = '';
            $stmt->execute();
            // return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            // return false;
        }

        header("Location: https://vitalyswipe-tinymvc.local/comment/");
    }

    
}

