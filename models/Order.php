<?php

class Order
{
    private $id;
    private $total;
    private $created_at;
    private $product_id;
    private $user_id;
    private $carrier_id;
    private $vat;
    private $address_id;
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
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

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

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of carrier_id
     */
    public function getCarrierId()
    {
        return $this->carrier_id;
    }

    /**
     * Set the value of carrier_id
     */
    public function setCarrierId($carrier_id): self
    {
        $this->carrier_id = $carrier_id;

        return $this;
    }

    /**
     * Get the value of vat
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set the value of vat
     */
    public function setVat($vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get the value of address_id
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * Set the value of address_id
     */
    public function setAddressId($address_id): self
    {
        $this->address_id = $address_id;

        return $this;
    }


    


    public function getOne()
    {
        $sql = "SELECT * FROM categories WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY name";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }

            return $categories;
        } else {
            return false;
        }
    }



    // CRUD

    public function create()
    {
        $sql = "INSERT INTO orders VALUES (null,'{$this->getName()}','{$this->getParent()}',0)";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    

   

   
}
