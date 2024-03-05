<?php

class Carrier
{
    private $id;
    private $price;
    private $name;
    private $deleted;
    private $db;

    public function __construct()
    {
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
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

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
     * Get the value of deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set the value of deleted
     */
    public function setDeleted($deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    /************** METODOS *************/
    public function getOne()
    {
        $sql = "SELECT * FROM carriers WHERE id={$this->getId()} WHERE deleted=0";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM carriers WHERE deleted=0";


        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $carriers = array();
            while ($row = $result->fetch_assoc()) {
                $carriers[] = $row;
            }

            return $carriers;
        } else {
            return false;
        }
    }

    public function create()
    {
        $sql = "INSERT INTO carriers 
        VALUES (null,'{$this->getPrice()}','{$this->getName()}',0)";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function delete()
    {
        $sql = "UPDATE carriers SET deleted = 1 WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
    public function update()
    {
        $sql = "UPDATE carriers 
        SET price='{$this->getPrice()}', name='{$this->getName()}', deleted='{$this->getDeleted()}' WHERE id={$this->getDeleted()}";
        
          
        $result = $this->db->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}