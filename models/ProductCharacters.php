<?php

class ProductCharacters
{
    private $character_id;
    private $product_id;
    
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
       
    }
     

    /**
     * Get the value of character_id
     */
    public function getCharacterId()
    {
        return $this->character_id;
    }

    /**
     * Set the value of character_id
     */
    public function setCharacterId($character_id): self
    {
        $this->character_id = $character_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function create()
    {
        $sql = "INSERT INTO product_characters VALUES ('{$this->getCharacterId()}','{$this->getProductID()}')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    //Borra los personajes asociados a los productos
    public function delete()
    {
        $sql = "DELETE FROM product_characters WHERE product_id ='{$this->getProductID()}'";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getCharsByProduct()
    {
        $sql = "SELECT * FROM product_characters WHERE product_id = {$this->getProductId()}";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $characters = array();
            while ($row = $result->fetch_assoc()) {
                $characters[] = $row;
            }

            return $characters;
        } else {
            return false;
        }
    }



    
}