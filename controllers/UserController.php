<?php
require_once 'utils/Utils.php';
require_once 'models/User.php';
require_once 'config/parameters.php';
class UserController
{
    public function index()
    {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            header("Location: " . base_url . "user/account");
        }
        
        require_once 'views/user/index.php';
    }
    public function register()
    {
        try {

            $new_user = new User();
            $new_user->setDni($_POST['dni'])->setName($_POST['name'])->setSurname($_POST['surname'])->setEmail($_POST['email'])->setPassword($_POST['password']);
            $new_user->save();
            $_SESSION['register'] = 'completed';
            unset($_SESSION['error']);
            $this->login();
        } catch (\Throwable $th) {
            $_SESSION['register'] = 'failed';

            $error = $th->getMessage();
            $_SESSION['error'] = $error;
            header("Location: " . base_url . "user/");
        }
    }
    public function login()
    {
        $userTryingToLog = new User();
        $userTryingToLog->setEmail($_POST['email']);
        try {
            $user = $userTryingToLog->login();
            
            if ($user!=false) {
                $pass_verify = password_verify($_POST['password'], $user['password']);
            
                if ($pass_verify) {
    
                    $_SESSION['user'] = $user;
                    $_SESSION['logged'] = true;
                    unset($_SESSION['login']);
                    unset($_SESSION['error']);
                    header("Location: " . base_url . "user/account");
                } else {
                    $_SESSION['login'] = 'failed';
                    $_SESSION['error'] = "Error en la autentificación";
                    
                    header("Location: " . base_url . "user/");
                }
            } else {
                $_SESSION['login'] = 'failed';
                    $_SESSION['error'] = "Error en la autentificación";
                    
                    header("Location: " . base_url . "user/");
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            $_SESSION['login'] = 'failed';
            $_SESSION['error'] = $th->getMessage();
            header("Location: " . base_url . "user/");
        }
    }

    public function account()
    {
        Utils::isCustomer();
        require_once 'views/user/account.php';
    }

    public function logout()
    {
        unset($_SESSION['logged']);

        unset($_SESSION['user']);
        header("Location: " . base_url);
    }

    public function addresses() {
        require_once 'views/user/addresses.php';
    }
}
