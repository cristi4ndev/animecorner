<?php

require_once 'models/User.php';
require_once 'config/parameters.php';
class UserController
{
    public function index()
    {
        require_once 'views/user/index.php';
    }
    public function register()
    {
        try {
            
            $new_user = new User();
            $new_user->setDni($_POST['dni'])->setName($_POST['name'])->setSurname($_POST['surname'])->setEmail($_POST['email'])->setPassword($_POST['password']);
            $new_user->save();
            $_SESSION['register']='completed';
            header("Location: base_url/user/account");
        } catch (\Throwable $th) {
            $_SESSION['register']='failed';
            
            $error= $th->getMessage();
            $_SESSION['error']=$error;
            header("Location: localhost/ecommerce/user/");
        }
    }
    public function account()
    {
        require_once 'views/user/account.php';
    }
}
