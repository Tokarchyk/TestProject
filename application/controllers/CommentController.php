<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Core\View;

class CommentController extends Controller 
{
    public $model;
    public $view;

    public function __construct()
	{
		$this->model = new CommentModel();
		$this->view = new View();		
	}

    // get & save email and comment from URL -> save to BD
    public function action_store() 
    {var_dump($_POST['email']);
        if (isset($_POST['email']) && isset($_POST['comment'])) {
            if (preg_match(
                "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                $_POST['email'])
            ) {
                $email = $_POST['email'];
                $comment = $_POST['comment'];
                // use this method to add data to DB
                $this->model->insertData($email, $comment);
                
                echo "THE LAST ADD TO DATABASE"  . "<br>";
                echo "Email: " . htmlspecialchars($email) . "<br>";
                echo "Comment: " . htmlspecialchars($comment);
            } else {
                echo "Required fields are missing.";
            }
        }
    }

    public function action_index()
	{
		$data = $this->model->get_data();
		$this->view->generate(
            'portfolio_view.php',
            'template_view.php',
            $data
        );
	}	

    public function action_delete()
    {
        $this->model->deleteComment($_POST['id']);
    }

    public function action_update()
    {
        // var_dump($_POST['id'],$_POST['comment']);
        $this->model->updateComment($_POST['id'],$_POST['comment']);
    }
}
