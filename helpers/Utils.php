<?php
class Utils {
    public static function isAdmin (){
        if (!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'  ) {
            header("Location: " . base_url);
        }

    }
    public static function isCustomer (){
        if (!isset($_SESSION['user']) || $_SESSION['user']['role']!='customer' ) {
            header("Location: " . base_url . "user/");
        }

    }

    public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}

    public static function getCategoryName($id) {
        
        $cat_model = new Category();
        $cat_model->setId($id);
        $category = $cat_model->getOne();
        
        
        return $category['name'];
    }
}