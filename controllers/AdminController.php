<?php
require_once 'utils/Utils.php';
require_once 'models/Admin.php';
require_once 'config/parameters.php';
class AdminController
{
    public function index()
    {   

        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            header("Location: " . base_url . "admin/summary");
        }

        require_once 'views/admin/index.php';
    }
    public function register()
    {
        try {

            $new_user = new Admin();
            $new_user->setDni($_POST['dni'])->setName($_POST['name'])->setSurname($_POST['surname'])->setEmail($_POST['email'])->setPassword($_POST['password']);
            $new_user->save();
            $_SESSION['register'] = 'completed';
            unset($_SESSION['error']);
            $this->login();
        } catch (\Throwable $th) {
            $_SESSION['register'] = 'failed';

            $error = $th->getMessage();
            $_SESSION['error'] = $error;
            header("Location: " . base_url . "admin/");
        }
    }
    public function login()
    {
        $adminTryingToLog = new Admin();
        $adminTryingToLog->setEmail($_POST['email']);
        try {
            $admin = $adminTryingToLog->login();

            if ($admin != false) {
                $pass_verify = ($_POST['password']== $admin['password']);

                if ($pass_verify) {

                    $_SESSION['user'] = $admin;
                    $_SESSION['logged'] = true;
                    unset($_SESSION['login']);
                    unset($_SESSION['error']);
                    header("Location: " . base_url . "admin/summary");
                } else {
                    $_SESSION['login'] = 'failed';
                    $_SESSION['error'] = "Error en la autentificación";

                    header("Location: " . base_url . "admin/");
                }
            } else {
                $_SESSION['login'] = 'failed';
                $_SESSION['error'] = "Error en la autentificación";

                header("Location: " . base_url . "admin/");
            }
        } catch (\Throwable $th) {
            //throw $th;
            $_SESSION['login'] = 'failed';
            $_SESSION['error'] = $th->getMessage();
            header("Location: " . base_url . "admin/");
        }
    }

    public function summary()
    {
        
        require_once 'views/admin/summary.php';
    }

    public function logout()
    {
        
        unset($_SESSION['logged']);

        unset($_SESSION['user']);
        header("Location: " . base_url);
    }
    public function password()
    {
        
        require 'views/admin/password.php';
    }
    public function passwordChange()
    {
        
        unset($_SESSION['error']);
        unset($_SESSION['response']);
        $old_password = $_POST['old-password'];
        $change_password = new Admin();
        $change_password->setId($_SESSION['user']['id']);
        $bd_old_password = $change_password->verifyPassword();
        if ($old_password == $bd_old_password['password']) {
            if ($_POST['new-password'] && $_POST['new-password2'] && $_POST['new-password'] == $_POST['new-password2']) {
                $change_password->setPassword($_POST['new-password']);
                $result = $change_password->changePassword();
                if (!$result) {
                    $_SESSION['error'] = "Error en el cambio de contraseña";
                } else {
                    $_SESSION['response'] = "Contraseña cambiada correctamente";
                }
            } else {
                $_SESSION['error'] = "Las contraseñas no coinciden";
            }
        } else $_SESSION['error'] = "La contraseña introducida no es correcta";
        header("Location: " . base_url . "/admin/password");
    }




    public function addresses()
    {
        
        require_once 'views/user/addresses.php';
    }
}
