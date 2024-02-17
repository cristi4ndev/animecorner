<?php
require_once 'models/Address.php';


class AddressController {
    public function create() {
        $new_address = new Address();
        $new_address->setAlias($_POST['alias'])->setCountry($_POST['country'])->setProvince($_POST['province'])->setPostalCode(intval($_POST['postal_code']))->setLocality($_POST['locality'])->setAddress($_POST['address'])->setPhone(intval($_POST['phone']))->setUserId(intval($_SESSION['user']['id']));
        $creationResult = $new_address->create();
        if ($creationResult) {
            
            if (isset($_SESSION['error'])) unset($_SESSION['error']);
            header("Location: " . base_url . "user/addresses");
            
        }else {
            $_SESSION['error'] = "Error en la creación de la nueva dirección";
            header("Location: " . base_url . "user/addresses");
        }
    }

    public function getAll(){
        $address_list = new Address();
        $address_list->setUserId($_SESSION['user']['id']);
        $address_list->getAll();
       return $address_list;

    }

    public function update (){
        
        $update_address = new Address();
        $update_address->setId(intval($_POST['id']))->setAlias($_POST['alias'])->setCountry($_POST['country'])->setProvince($_POST['province'])->setPostalCode(intval($_POST['postal_code']))->setLocality($_POST['locality'])->setAddress($_POST['address'])->setPhone(intval($_POST['phone']))->setUserId(intval($_SESSION['user']['id']));
        $updateResult = $update_address->update();
        if ($updateResult) {
            if (isset($_SESSION['error'])) unset($_SESSION['error']);
            header("Location: " . base_url . "user/addresses");
            
        }else {
            $_SESSION['error'] = "Error en la actualización de la dirección";
            header("Location: " . base_url . "user/addresses");
        }
    }
    
    public function delete(){
        
        $delete_address = new Address();
        $delete_address->setId($_POST['id']);
        $delete_address->delete();
        header("Location: " . base_url . "user/addresses");
    }
}