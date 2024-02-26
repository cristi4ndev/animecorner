<?php

require_once 'helpers/Utils.php';
require_once 'models/Admin.php';
require_once 'config/parameters.php';
class AdminController
{
    public function index()
    {

        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && $_SESSION['user']['role'] == 'admin') {
            header("Location: " . base_url . "admin/summary");
        }

        require_once 'views/admin/index.php';
    }
    public function register()
    {
        Utils::isAdmin();
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
        Utils::isAdmin();
        $adminTryingToLog = new Admin();
        $adminTryingToLog->setEmail($_POST['email']);
        try {
            $admin = $adminTryingToLog->login();


            if ($admin != false) {

                if ($_POST['password'] == $admin['password']) {

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
        Utils::isAdmin();
        require_once 'views/admin/summary.php';
    }

    public function logout()
    {
        Utils::isAdmin();
        unset($_SESSION['logged']);

        unset($_SESSION['user']);
        header("Location: " . base_url);
    }
    public function password()
    {
        Utils::isAdmin();
        require 'views/admin/password.php';
        Utils::deleteSession('error');
        Utils::deleteSession('response');
    }
    public function passwordChange()
    {
        Utils::isAdmin();
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
        header("Location: " . base_url . "admin/password");
    }

    public function users()
    {
        Utils::isAdmin();
        $admin = new Admin();

        $user_list = $admin->setId($_SESSION['user']['id'])->getUsers();

        require_once 'views/admin/users.php';
    }
    public function categories()
    {
        Utils::isAdmin();
        require_once 'models/Category.php';
        $category_model = new Category();
        $all_categories = $category_model->getAll();

        $category_list = array_filter($all_categories, function ($array) {
            if (isset($_GET['id'])) {
                $id = ($_GET['id']);
            } else {
                $id = 1;
            }
            return $id == $array['parent'];
        });


        require_once 'views/admin/categories.php';
    }

    public function create()
    {
        Utils::isAdmin();

        if (isset($_POST['entity']) && $_POST['entity'] == 'category') {
            require_once 'models/Category.php';
            $category_model = new Category();
            $parent = "";
            if (isset($_POST['parent']) && $_POST['parent'] != 'ninguna') {
                $parent = $_POST['parent'];
            }
            $category_model->setName($_POST['name'])->setParent($parent);
            $creation = $category_model->createCategory();
            header("Location: " . base_url . "admin/categories&id=" . $_POST['parent']);
        }
        if (isset($_POST['entity']) && $_POST['entity'] == 'saga') {
            require_once 'models/Saga.php';
            $saga_model = new Saga();
            $saga_model->setName($_POST['name']);
            $create_saga = $saga_model->create();
            header("Location: " . base_url . "admin/sagas");
        }
        if (isset($_POST['entity']) && $_POST['entity'] == 'character') {
            require_once 'models/Character.php';
            $character_model = new Character();
            $character_model->setName($_POST['name'])->setSagaId($_POST['saga']);
            $create_char = $character_model->create();
            header("Location: " . base_url . "admin/sagas&id=" . $_POST['saga']);
        }
        if (isset($_POST['entity']) && $_POST['entity'] == 'product') {
            require_once 'models/Product.php';
            require_once 'models/ProductCharacters.php';

            try {
                $product_model = new Product();
                // Guardado de la imagen 
                if (isset($_FILES['image'])) {
                    // Carpeta donde se guardará la imagen
                    $dir = storage . 'uploads/images/products/';

                    // Obtener el nombre y la ubicación temporal del archivo
                    $file_name = $_FILES['image']['name'];
                    $tmp_file = $_FILES['image']['tmp_name'];

                    // Mover el archivo a la carpeta de destino
                    if (move_uploaded_file($tmp_file, $dir . $file_name)) {
                        echo "La imagen se ha guardado correctamente.";
                    } else {
                        echo "Hubo un error al guardar la imagen.";
                    }

                    $product_model->setImage(base_url . 'uploads/images/products/' . $file_name);
                }

                $product_model->setStock($_POST['stock'])->setPrice($_POST['price'])->setName($_POST['name'])->setDescription($_POST['description'])->setCategoryId($_POST['category'])->setSagaId($_POST['saga']);
                $product_creation = $product_model->create();
            
                if (isset($_POST['saga']) && isset($_POST['characters'])){
                   
                    foreach($_POST['characters'] as $character){
                        
                        $prodchar_model = new ProductCharacters();
                        $prodchar_model ->setProductId($product_model->getLastInsertedId())->setCharacterId($character);                 
                              
                        $create_relation = $prodchar_model->create();
                        if ($create_relation) {
                            echo "La relación en la tabla ProductsCharacters se ha realizado correctamente.";
                        } else {
                            echo "Hubo un error al crear la relación de productos y personajes.";
                        }
                    }
                    
                }

                header("Location: " . base_url . "admin/products");
            } catch (\Throwable $th) {
                throw $th;
                header("Location: " . base_url . "admin/new_product");
            }
        }
    }

    public function edit()
    {
        Utils::isAdmin();


        if (isset($_GET['entity']) && $_GET['entity'] == 'category') {
            require_once 'models/Category.php';
            $category_model = new Category();
            $category_model->setId($_GET['id'])->setName($_POST['name'])->setParent($_POST['parent']);
            $result = $category_model->edit();
            if ($result) header("Location: " . base_url . "admin/categories&id=" . $_POST['parent']);

            else $_SESSION['error'] = "Error en la eliminación";
        }
        if (isset($_GET['entity']) && $_GET['entity'] == 'saga') {
            require_once 'models/Saga.php';
            $saga_model = new Saga();
            $saga_model->setId($_GET['id'])->setName($_POST['name']);
            $result = $saga_model->edit();
            if ($result) header("Location: " . base_url . "admin/sagas");

            else $_SESSION['error'] = "Error en la eliminación";
        }
        if (isset($_GET['entity']) && $_GET['entity'] == 'character') {
            require_once 'models/Character.php';
            $character_model = new Character();
            $character_model->setId($_GET['id'])->setName($_POST['name'])->setSagaId($_POST['saga']);

            $result = $character_model->edit();
            if ($result) header("Location: " . base_url . "admin/sagas&id=" . $_POST['saga']);

            else $_SESSION['error'] = "Error en la eliminación";
        }
        if (isset($_GET['entity']) && $_GET['entity'] == 'menu') {
            require_once 'models/Category.php';
            $category_model = new Category();
            if (isset($_GET['id'])) $category_model->setId($_GET['id']);
            else $category_model->setId($_POST['id']);
            $category_model->setMenu($_GET['menu']);
            $result = $category_model->editMenu();
            if ($result) header("Location: " . base_url . "admin/menu");
        } else $_SESSION['error'] = "Error en la eliminación";
    }
    public function delete()
    {
        Utils::isAdmin();


        if (isset($_GET['entity']) && $_GET['entity'] == 'category') {
            require_once 'models/Category.php';
            $category_model = new Category();

            if (Utils::categoryHasChildren($_GET['id'])) {

                $category_model->setParent($_GET['id']);
                $category_model->setParentCategory();
            }
            $category_model->setId($_GET['id']);
            $result = $category_model->delete();
            if ($result) header("Location: " . base_url . "admin/categories&id=" . $_GET['parent']);

            else {
                $_SESSION['error'] = "Error en la eliminación";
                header("Location: " . base_url . "admin/categories&id=" . $_GET['parent']);
            }
        }
        if (isset($_GET['entity']) && $_GET['entity'] == 'saga') {
            require_once 'models/Saga.php';
            $saga_model = new Saga();

            $saga_model->setId($_GET['id']);
            $result = $saga_model->delete();
            if ($result) header("Location: " . base_url . "admin/sagas");

            else {
                $_SESSION['error'] = "Error en la eliminación";
                header("Location: " . base_url . "admin/sagas");
            }
        }
        if (isset($_GET['entity']) && $_GET['entity'] == 'character') {
            require_once 'models/Character.php';
            $character_model = new Character();

            $character_model->setId($_GET['id']);
            $result = $character_model->delete();
            if ($result) header("Location: " . base_url . "admin/sagas&id=" . $_GET['saga']);

            else {
                $_SESSION['error'] = "Error en la eliminación";
                header("Location: " . base_url . "admin/sagas&id=" . $_GET['saga']);
            }
        }
    }

    public function sagas()
    {
        Utils::isAdmin();
        require_once 'models/Saga.php';
        $saga_model = new Saga();
        $all_sagas = $saga_model->getAll();

        if (isset($_GET['id'])) {
            require_once 'models/Character.php';
            $character_model = new Character();
            $all_characters = $character_model->getAll();
            if ($all_characters) {
                $character_list = array_filter($all_characters, function ($array) {

                    return $_GET['id'] == $array['saga_id'];
                });
            } else {
                $character_list = false;
            }

            require_once 'views/admin/characters.php';
        } else {
            require_once 'views/admin/sagas.php';
        }
    }
    public function menu()
    {
        Utils::isAdmin();
        require_once 'models/Category.php';
        $category_model = new Category();
        $all_categories = $category_model->getAll();
        $category_list = array_filter($all_categories, function ($array) {
            return $array['menu'] == 1;
        });
        require_once 'views/admin/menu/index.php';
    }
    public function products()
    {
        Utils::isAdmin();

        require_once 'views/admin/products/index.php';
    }
    public function new_product()
    {
        Utils::isAdmin();

        require_once 'views/admin/products/create.php';
    }
}
