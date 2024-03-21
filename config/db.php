<?php

class Database {
    public static function connect() {
        $db = new mysqli('50.31.176.102', 'mxzmwcti_animecorner', 'anime-1234', 'mxzmwcti_animecorner');
		$db->query("SET NAMES 'utf8'");
        
		return $db;
    }
}