<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\RegistrationModel;
use App\Core\View;

class RegistrationController extends Controller
{
    public $model;
    public $view;

    public function __construct()
	{
		$this->model = new RegistrationModel();
		$this->view = new View();		
	}

	function action_index()
	{
        $data = $this->model->get_data();
		$this->view->generate(
            'RegistrationView.php',
            'template_view.php',
            $data
        );
	}

    // get & save email and pass from URL -> save to table 'users'
    public function action_save() 
    {
        
        if (isset($_POST['email']) && isset($_POST['password'])) {
            if (preg_match(
                "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                $_POST['email'])
            ) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                // use this method to add data to DB
                $this->model->SaveRegistration($email, $password);
                
                echo "THE LAST ADD TO DATABASE"  . "<br>";
                echo "Email: " . htmlspecialchars($email) . "<br>";
                echo "Password: " . htmlspecialchars($password);
            } else {
                echo "Required fields are missing.";
            }
        }
    }
}