<?php
class Utils {
    public static function isAdmin (){
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol']!='admin'  ) {
            header("Location: " . base_url);
        }

    }
    public static function isCustomer (){
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol']!='customer' ) {
            header("Location: " . base_url . "user/");
        }

    }
}