<?php

namespace App\Controllers;


use App\Core\Controller;
use App\Models\AuthorizationModel;
use App\Core\View;
use App\Core\Database;
use \PDO;

class AuthorizationController extends Controller
{

    private $db;
    public $model;
    public $view;

    public function __construct()
	{
		$this->model = new AuthorizationModel();
		$this->view = new View();
        
        // connect to bd
		$this->db = (new Database())->connect();
	}

	function action_index()
	{
        $data = $this->model->get_data();
		$this->view->generate(
            'AuthorizationView.php',
            'template_view.php',
            $data
        );
	}

    

    public function action_hashing() 
    {
        session_start();
        // get data from URL
        $login = $_POST['email'];
        // var_dump($_POST);
        $password = $_POST['password'];
        // $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT email, password FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $login, PDO::PARAM_STR);
        $stmt->execute();
        
        

        

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // $_SESSION['user_id'];
            // $_SESSION['user_email'] = $login;
            // var_dump($_SESSION['user_email']);

            if (password_verify($password, $user['password'])) {
                
                $_SESSION['login_message'] = "You have successfully logged in! Hello " . $login;
                $_SESSION['user_email'] = $login;
                // var_dump($_SESSION['login_message']);
                header("Location:https://vitalyswipe-tinymvc.local/comment ");
                echo "Login successful!";
                exit;
            } else {
                echo "WRONG PASSWORD!!!";
            }
        } else {
            echo "No user found with this login.";
        }
        
        
        
        
        
        // var_dump($_POST);
        // $password = $_POST['password'];
        // $password1 = password_hash($password, PASSWORD_DEFAULT);
        
        // var_dump($password1); 

        // if(password_verify($password, $password1)){
        //     var_dump('true');
        // } else {
        //     var_dump('false');
        // };
    }
}

