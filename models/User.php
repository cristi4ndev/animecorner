<?php

class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $role;
    private $dni;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }

    
    /**
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     */
    public function setDni($dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of rol
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     */
    public function setSurname($surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function save (){
        $sql = "INSERT INTO users VALUES(NULL, '{$this->getName()}', '{$this->getSurname()}', '{$this->getEmail()}', '{$this->getPassword()}', 'customer', '{$this->getDni()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
    }   
    
    public function login (){
        $sql = "SELECT * from users where email='{$this->getEmail()}'";
        $result = $this->db->query($sql);
       
        if ($result->num_rows==1) {
            $user=$result->fetch_assoc();

            return $user;
        } else return false;
    }

    public function verifyPassword(){
        $sql= "SELECT password FROM users where id = '{$this->getId()}'";
        $result = $this->db->query($sql);
        $truePass = $result->fetch_assoc();
        return $truePass;
    }

    public function changePassword(){
        $sql = "UPDATE users SET password = '{$this->getPassword()}' WHERE id='{$this->getId()}'";
        $result = $this->db->query($sql);
        return $result;

    }

    public function getUsers(){
        $sql = "SELECT u.*, 
        (SELECT count(o.id) FROM orders o WHERE o.user_id = u.id) AS num_orders, 
        (SELECT sum(o.total) FROM orders o WHERE o.user_id = u.id) AS total 
        FROM users u ORDER BY id DESC;
        ";
        $result = $this->db->query($sql);
       
        if ($result && $result->num_rows > 0) {
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return false;
        }
    }
    
}   

