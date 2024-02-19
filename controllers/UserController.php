<?php
require_once 'helpers/Utils.php';
require_once 'models/User.php';
require_once 'config/parameters.php';
class UserController
{
    public function index()
    {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && $_SESSION['user']['role']=='customer') {
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

            if ($user != false) {
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
        Utils::isCustomer();
        unset($_SESSION['logged']);

        unset($_SESSION['user']);
        header("Location: " . base_url);
    }
    public function password()
    {
        Utils::isCustomer();
        require 'views/user/password.php';
        Utils::deleteSession('error');
        Utils::deleteSession('response');
    }
    public function passwordChange()
    {
        Utils::isCustomer();
        unset($_SESSION['error']);
        unset($_SESSION['response']);
        $old_password = $_POST['old-password'];
        $change_password = new User();
        $change_password->setId($_SESSION['user']['id']);
        $bd_old_password = $change_password->verifyPassword();
        if (password_verify($old_password, $bd_old_password['password'])) {
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
        header("Location: " . base_url . "user/password");
    }




    public function addresses()
    {
        Utils::isCustomer();
        require_once 'views/user/addresses.php';
    }
}
