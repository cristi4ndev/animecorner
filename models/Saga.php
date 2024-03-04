<?php
class Saga  {
    private $id;
    private $name;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
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


    public function getOne()
    {
        $sql = "SELECT * FROM sagas WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM sagas ORDER BY name";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $sagas = array();
            while ($row = $result->fetch_assoc()) {
                $sagas[] = $row;
            }

            return $sagas;
        } else {
            return false;
        }
    }
    // Metodo para devolver el listado de productos
    public function getProducts(){
        $sql= "SELECT p.*, cat.name as cat_name, s.name as saga_name FROM products p JOIN categories cat ON p.category_id = cat.id JOIN sagas s ON p.saga_id = s.id where p.saga_id = {$this->getId()} and p.deleted=0";

        if (isset($_GET['character'])) {
            $sql =  "SELECT * FROM products p JOIN product_characters pc ON p.id = pc.product_id where p.saga_id = {$this->getId()} and p.deleted=0 and pc.character_id={$_GET['character']}";
        }
        
        if (isset($_GET['category'])) {
            $sql .=  " and p.category_id={$_GET['category']}";
        }
    
        $sql .=  " ORDER BY p.id DESC";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $products = array();
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            return $products;
        } else {
            return false;
        }

    }
    // Metodo para devolver el listado de categorías base según productos de una saga
    public function getBaseCategories(){
        $sql= "SELECT p.*, cat.name as cat_name, s.name as saga_name FROM products p JOIN categories cat ON p.category_id = cat.id JOIN sagas s ON p.saga_id = s.id where p.saga_id = {$this->getId()} and p.deleted=0";

            
        
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $base_categories = array();
            while ($row = $result->fetch_assoc()) {
                $base_categories[] = $row;
            }

            return $base_categories;
        } else {
            return false;
        }

    }
    


    

    public function create()
    {
        $sql = "INSERT INTO sagas VALUES (null,'{$this->getName()}')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM sagas WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }
    public function edit(){
        $sql = "UPDATE sagas SET name='{$this->getName()}' WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }

    
  
}