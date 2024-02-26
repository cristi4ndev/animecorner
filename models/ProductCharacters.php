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

    /*public function edit()
    {
        $sql = "INSERT INTO product_characters VALUES (null,'{$this->getImage()}','{$this->getStock()}','{$this->getPrice()}',CURRENT_TIMESTAMP(),{$this->getName()}','{$this->getDescription()}','{$this->getCategoryId()},'{$this->getSagaId()}',0')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }*/
}